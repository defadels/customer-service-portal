<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenAIService;
use App\Models\ChatMessage;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class AIController extends Controller
{
    protected $aiService;

    public function __construct(OpenAIService $aiService)
    {
        $this->aiService = $aiService;
    }

    public function generateResponse(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'message' => 'required|string',
                'context' => 'required|array',
                'context.chat_id' => 'required|string'
            ]);

            // Get response from OpenAI
            $response = $this->aiService->generateChatResponse(
                $validated['message'],
                $validated['context']
            );

            // Record the customer message
            $customerMessage = ChatMessage::create([
                'chat_id' => $validated['context']['chat_id'],
                'message' => $validated['message'],
                'message_type' => 'Text',
                'sender_type' => 'Customer',
                'is_read' => true,
                'intent_classification' => $response['intent'] ?? 'general',
                'sentiment_score' => $response['sentiment'] ?? 0,
                'ai_confidence_score' => $response['confidence'] ?? 1.0
            ]);

            // Record the AI response
            $aiMessage = ChatMessage::create([
                'chat_id' => $validated['context']['chat_id'],
                'message' => $response['response'],
                'message_type' => 'Text',
                'sender_type' => 'AI Bot',
                'is_read' => false,
                'intent_classification' => $response['intent'] ?? 'general',
                'sentiment_score' => $response['sentiment'] ?? 0,
                'ai_confidence_score' => $response['confidence'] ?? 1.0
            ]);

            // Check if we need to escalate to human agent
            $needsHumanAgent = $this->checkIfNeedsEscalation($response);
            if ($needsHumanAgent) {
                $this->createEscalationTicket($customerMessage, $response);
            }

            return response()->json([
                'response' => $response['response'],
                'needs_human_agent' => $needsHumanAgent,
                'message_id' => $aiMessage->id
            ]);

        } catch (\Exception $e) {
            Log::error('AI Response Error: ' . $e->getMessage());

            return response()->json([
                'error' => 'An error occurred while processing your request.',
                'response' => 'I apologize, but I encountered an error. Please try again or contact support.',
                'needs_human_agent' => true
            ], 500);
        }
    }

    public function getStats(): JsonResponse
    {
        try {
            $totalMessages = ChatMessage::count();
            $aiResponses = ChatMessage::where('sender_type', 'AI Bot')->count();
            $customerMessages = ChatMessage::where('sender_type', 'Customer')->count();

            // Calculate average sentiment
            $avgSentiment = ChatMessage::where('sender_type', 'Customer')
                ->whereNotNull('sentiment_score')
                ->avg('sentiment_score') ?? 0;

            // Calculate average confidence
            $avgConfidence = ChatMessage::where('sender_type', 'AI Bot')
                ->whereNotNull('ai_confidence_score')
                ->avg('ai_confidence_score') ?? 0;

            return response()->json([
                'total_messages' => $totalMessages,
                'ai_responses' => $aiResponses,
                'customer_messages' => $customerMessages,
                'average_sentiment' => round($avgSentiment, 2),
                'average_confidence' => round($avgConfidence, 2),
                'response_time' => '0.5s'
            ]);

        } catch (\Exception $e) {
            Log::error('AI Stats Error: ' . $e->getMessage());

            return response()->json([
                'error' => 'Failed to retrieve AI statistics'
            ], 500);
        }
    }

    protected function checkIfNeedsEscalation(array $response): bool
    {
        // Escalate if:
        // 1. Confidence is low (< 0.7)
        // 2. Sentiment is very negative (< -0.5)
        // 3. Intent is specifically requesting human agent
        return ($response['confidence'] ?? 1) < 0.7 ||
               ($response['sentiment'] ?? 0) < -0.5 ||
               ($response['intent'] ?? '') === 'request_human';
    }

    protected function createEscalationTicket(ChatMessage $message, array $aiResponse): void
    {
        try {
            Ticket::create([
                'chat_id' => $message->chat_id,
                'subject' => 'AI Escalation: ' . substr($message->message, 0, 50),
                'description' => $message->message,
                'priority' => ($aiResponse['sentiment'] ?? 0) < -0.5 ? 'High' : 'Medium',
                'status' => 'Open',
                'category' => $aiResponse['intent'] ?? 'general',
                'source' => 'Chat'
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create escalation ticket: ' . $e->getMessage());
        }
    }
}
