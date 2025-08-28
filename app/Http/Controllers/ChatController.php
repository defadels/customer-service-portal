<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\Ticket;
use App\Models\Customer;
use App\Services\AIService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ChatController extends Controller
{
    protected AIService $aiService;

    public function __construct(AIService $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * Get chat messages for a specific chat
     */
    public function index(Request $request): JsonResponse
    {
        $chatId = $request->get('chat_id');
        $messages = ChatMessage::where('chat_id', $chatId)
            ->orderBy('created_at', 'asc')
            ->get();
        
        return response()->json($messages);
    }

    /**
     * Send a new message
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'chat_id' => 'required|string',
                'ticket_id' => 'nullable|exists:tickets,id',
                'customer_id' => 'nullable|exists:customers,id',
                'agent_id' => 'nullable|exists:agents,id',
                'message' => 'required|string',
                'message_type' => 'nullable|in:Text,Image,File,Link'
            ]);

            // Create customer message
            $message = ChatMessage::create([
                'chat_id' => $validated['chat_id'],
                'ticket_id' => $validated['ticket_id'],
                'customer_id' => $validated['customer_id'],
                'agent_id' => $validated['agent_id'],
                'message' => $validated['message'],
                'message_type' => $validated['message_type'] ?? 'Text',
                'sender_type' => $validated['agent_id'] ? 'Agent' : 'Customer'
            ]);

            // If this is a customer message, generate AI response
            if (!$validated['agent_id'] && $validated['customer_id']) {
                $this->generateAIResponse($validated['message'], $validated['chat_id'], $validated['ticket_id']);
            }

            return response()->json($message, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    /**
     * Generate AI response
     */
    private function generateAIResponse(string $customerMessage, string $chatId, ?int $ticketId): void
    {
        try {
            $aiResult = $this->aiService->generateChatResponse($customerMessage);
            
            // Create AI response message
            ChatMessage::create([
                'chat_id' => $chatId,
                'ticket_id' => $ticketId,
                'message' => $aiResult['response'],
                'message_type' => 'Text',
                'sender_type' => 'AI Bot',
                'ai_confidence_score' => $aiResult['confidence'],
                'intent_classification' => $aiResult['intent'],
                'sentiment_score' => $aiResult['sentiment_score'],
                'language_detected' => $aiResult['language_detected'] ?? 'id'
            ]);

            // If AI determines human agent is needed, create or update ticket
            if ($this->needsHumanAgent($aiResult['intent'], $aiResult['sentiment_score'])) {
                $this->escalateToHuman($chatId, $ticketId, $aiResult);
            }
        } catch (\Exception $e) {
            // Log error and create fallback message
            \Log::error('AI Response Error: ' . $e->getMessage());
            
            ChatMessage::create([
                'chat_id' => $chatId,
                'ticket_id' => $ticketId,
                'message' => 'Maaf, saya sedang mengalami gangguan teknis. Silakan hubungi agent kami untuk bantuan lebih lanjut.',
                'message_type' => 'Text',
                'sender_type' => 'AI Bot',
                'ai_confidence_score' => 0.0,
                'intent_classification' => 'error',
                'sentiment_score' => 0.0,
                'language_detected' => 'id'
            ]);
        }
    }

    /**
     * Check if human agent is needed
     */
    private function needsHumanAgent(string $intent, float $sentimentScore): bool
    {
        // Escalate if sentiment is very negative or intent is complex
        return $sentimentScore < -0.5 || in_array($intent, ['complaint', 'error', 'escalation']);
    }

    /**
     * Escalate to human agent
     */
    private function escalateToHuman(string $chatId, ?int $ticketId, array $aiResult): void
    {
        try {
            // Create escalation message
            ChatMessage::create([
                'chat_id' => $chatId,
                'ticket_id' => $ticketId,
                'message' => 'Percakapan ini telah di-escalate ke agent manusia. Agent akan membantu Anda segera.',
                'message_type' => 'System',
                'sender_type' => 'System',
            ]);

            // Update ticket if it exists
            if ($ticketId) {
                $ticket = Ticket::find($ticketId);
                if ($ticket) {
                    $ticket->update([
                        'status' => 'needs_agent',
                        'escalated_at' => now(),
                        'escalation_reason' => 'AI escalation: ' . $aiResult['intent']
                    ]);
                }
            } else {
                // Create new ticket if none exists
                $customerId = ChatMessage::where('chat_id', $chatId)
                    ->where('sender_type', 'Customer')
                    ->first()?->customer_id;
                
                if ($customerId) {
                    Ticket::create([
                        'customer_id' => $customerId,
                        'subject' => 'AI Escalated: ' . $aiResult['intent'],
                        'description' => 'Ticket escalated by AI due to complexity or negative sentiment',
                        'priority' => $aiResult['sentiment_score'] < -0.3 ? 'High' : 'Medium',
                        'status' => 'Open',
                        'category' => $aiResult['ai_category'] ?? 'general',
                        'source' => 'Chat'
                    ]);
                }
            }
        } catch (\Exception $e) {
            \Log::error('Escalation Error: ' . $e->getMessage());
        }
    }

    /**
     * Mark message as read
     */
    public function markAsRead(ChatMessage $message): JsonResponse
    {
        $message->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }

    /**
     * Get chat statistics
     */
    public function getStats(Request $request): JsonResponse
    {
        $chatId = $request->get('chat_id');
        
        $stats = [
            'total_messages' => ChatMessage::where('chat_id', $chatId)->count(),
            'customer_messages' => ChatMessage::where('chat_id', $chatId)->where('sender_type', 'Customer')->count(),
            'ai_messages' => ChatMessage::where('chat_id', $chatId)->where('sender_type', 'AI Bot')->count(),
            'agent_messages' => ChatMessage::where('chat_id', $chatId)->where('sender_type', 'Agent')->count(),
            'average_response_time' => $this->calculateAverageResponseTime($chatId),
            'escalation_rate' => $this->calculateEscalationRate($chatId)
        ];
        
        return response()->json($stats);
    }

    private function calculateAverageResponseTime(string $chatId): float
    {
        $messages = ChatMessage::where('chat_id', $chatId)
            ->whereIn('sender_type', ['AI Bot', 'Agent'])
            ->orderBy('created_at', 'asc')
            ->get();
        
        $totalTime = 0;
        $responseCount = 0;
        
        foreach ($messages as $message) {
            $previousMessage = ChatMessage::where('chat_id', $chatId)
                ->where('sender_type', 'Customer')
                ->where('created_at', '<', $message->created_at)
                ->orderBy('created_at', 'desc')
                ->first();
            
            if ($previousMessage) {
                $totalTime += $message->created_at->diffInSeconds($previousMessage->created_at);
                $responseCount++;
            }
        }
        
        return $responseCount > 0 ? round($totalTime / $responseCount, 2) : 0;
    }

    private function calculateEscalationRate(string $chatId): float
    {
        $totalMessages = ChatMessage::where('chat_id', $chatId)->count();
        $escalationMessages = ChatMessage::where('chat_id', $chatId)
            ->where('sender_type', 'System')
            ->where('message', 'like', '%escalate%')
            ->count();
        
        return $totalMessages > 0 ? round(($escalationMessages / $totalMessages) * 100, 2) : 0;
    }
}
