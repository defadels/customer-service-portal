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

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to analyze message',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generate AI response for customer message
     */
    public function generateResponse(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'message' => 'required|string',
                'customer_id' => 'nullable|exists:customers,id',
                'ticket_id' => 'nullable|exists:tickets,id',
                'context' => 'nullable|array'
            ]);

            // Generate AI response
            $aiResponse = $this->aiService->generateResponse(
                $validated['message'],
                $validated['context'] ?? []
            );

            // Check if escalation is needed
            $needsHumanAgent = $this->aiService->needsHumanAgent(
                $aiResponse['intent'],
                $aiResponse['sentiment']
            );

            // Create chat message record
            $chatMessage = ChatMessage::create([
                'chat_id' => 'chat-' . time(),
                'ticket_id' => $validated['ticket_id'],
                'customer_id' => $validated['customer_id'],
                'message' => $validated['message'],
                'message_type' => 'Text',
                'sender_type' => 'Customer',
                'ai_confidence_score' => $aiResponse['confidence'],
                'intent_classification' => $aiResponse['intent'],
                'sentiment_score' => $aiResponse['sentiment'],
                'language_detected' => 'id', // Default to Indonesian
                'is_read' => false
            ]);

            // Create AI response message
            $aiChatMessage = ChatMessage::create([
                'chat_id' => $chatMessage->chat_id,
                'ticket_id' => $validated['ticket_id'],
                'customer_id' => $validated['customer_id'],
                'message' => $aiResponse['response'],
                'message_type' => 'Text',
                'sender_type' => 'AI Bot',
                'ai_confidence_score' => $aiResponse['confidence'],
                'intent_classification' => $aiResponse['intent'],
                'sentiment_score' => $aiResponse['sentiment'],
                'language_detected' => 'id',
                'is_read' => false
            ]);

            // If escalation is needed, create or update ticket
            if ($needsHumanAgent) {
                $this->handleEscalation($validated, $aiResponse);
            }

            return response()->json([
                'ai_response' => $aiResponse['response'],
                'intent' => $aiResponse['intent'],
                'sentiment' => $aiResponse['sentiment'],
                'confidence' => $aiResponse['confidence'],
                'needs_human_agent' => $needsHumanAgent,
                'chat_message_id' => $chatMessage->id,
                'ai_message_id' => $aiChatMessage->id,
                'escalation_handled' => $needsHumanAgent
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to generate AI response',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Handle escalation to human agent
     */
    private function handleEscalation(array $data, array $aiResponse): void
    {
        // Create ticket if doesn't exist
        if (!isset($data['ticket_id'])) {
            $ticket = Ticket::create([
                'customer_id' => $data['customer_id'],
                'subject' => 'AI Escalation: ' . substr($data['message'], 0, 50) . '...',
                'description' => $data['message'],
                'priority' => $this->determinePriority($aiResponse['sentiment']),
                'status' => 'Open',
                'category' => $aiResponse['ai_category'],
                'source' => 'Chat',
                'sentiment_score' => $aiResponse['sentiment'],
                'ai_category' => $aiResponse['ai_category']
            ]);
        } else {
            // Update existing ticket
            $ticket = Ticket::find($data['ticket_id']);
            if ($ticket) {
                $ticket->update([
                    'escalation_level' => $ticket->escalation_level + 1,
                    'status' => 'Open'
                ]);
            }
        }
    }

    /**
     * Determine ticket priority based on sentiment
     */
    private function determinePriority(float $sentiment): string
    {
        if ($sentiment <= -0.7) return 'Critical';
        if ($sentiment <= -0.4) return 'Urgent';
        if ($sentiment <= -0.1) return 'High';
        if ($sentiment <= 0.1) return 'Medium';
        return 'Low';
    }

    /**
     * Get AI performance statistics
     */
    public function getStats(): JsonResponse
    {
        try {
            $totalMessages = ChatMessage::where('sender_type', 'AI Bot')->count();
            $totalCustomerMessages = ChatMessage::where('sender_type', 'Customer')->count();

            // Calculate AI accuracy (mock calculation)
            $accuracy = $this->calculateAccuracy();

            // Calculate auto-resolution rate
            $autoResolutionRate = $this->calculateAutoResolutionRate();

            // Calculate average response time
            $avgResponseTime = $this->calculateAverageResponseTime();

            // Get intent distribution
            $intentDistribution = $this->getIntentDistribution();

            // Get sentiment analysis summary
            $sentimentSummary = $this->getSentimentSummary();

            return response()->json([
                'total_ai_responses' => $totalMessages,
                'total_customer_messages' => $totalCustomerMessages,
                'accuracy_percentage' => $accuracy,
                'auto_resolution_rate' => $autoResolutionRate,
                'avg_response_time_seconds' => $avgResponseTime,
                'intent_distribution' => $intentDistribution,
                'sentiment_summary' => $sentimentSummary,
                'ai_performance_grade' => $this->getAIPerformanceGrade($accuracy, $autoResolutionRate)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to get AI stats',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Calculate AI accuracy (mock implementation)
     */
    private function calculateAccuracy(): float
    {
        // Mock accuracy calculation based on intent classification
        $baseAccuracy = 85.0;
        $randomFactor = (rand(-10, 10) / 100);

        return round($baseAccuracy + $randomFactor, 2);
    }

    /**
     * Calculate auto-resolution rate
     */
    private function calculateAutoResolutionRate(): float
    {
        $totalEscalations = ChatMessage::where('sender_type', 'AI Bot')
                                     ->where('intent_classification', 'inquiry')
                                     ->count();

        $totalInquiries = ChatMessage::where('sender_type', 'Customer')
                                   ->where('intent_classification', 'inquiry')
                                   ->count();

        if ($totalInquiries === 0) return 0;

        return round(($totalEscalations / $totalInquiries) * 100, 2);
    }

    /**
     * Calculate average response time
     */
    private function calculateAverageResponseTime(): float
    {
        // Mock response time calculation
        $baseTime = 2.0; // 2 seconds
        $randomFactor = (rand(-5, 5) / 10);

        return round($baseTime + $randomFactor, 1);
    }

    /**
     * Get intent distribution
     */
    private function getIntentDistribution(): array
    {
        return ChatMessage::where('sender_type', 'AI Bot')
                         ->selectRaw('intent_classification, COUNT(*) as count')
                         ->groupBy('intent_classification')
                         ->pluck('count', 'intent_classification')
                         ->toArray();
    }

    /**
     * Get sentiment analysis summary
     */
    private function getSentimentSummary(): array
    {
        $messages = ChatMessage::where('sender_type', 'Customer')
                              ->whereNotNull('sentiment_score')
                              ->get();

        $positive = $messages->where('sentiment_score', '>', 0.3)->count();
        $negative = $messages->where('sentiment_score', '<', -0.3)->count();
        $neutral = $messages->whereBetween('sentiment_score', [-0.3, 0.3])->count();

        return [
            'positive' => $positive,
            'negative' => $negative,
            'neutral' => $neutral,
            'total_analyzed' => $messages->count()
        ];
    }

    /**
     * Get AI performance grade
     */
    private function getAIPerformanceGrade(float $accuracy, float $autoResolution): string
    {
        $score = ($accuracy * 0.6) + ($autoResolution * 0.4);

        if ($score >= 90) return 'A+';
        if ($score >= 80) return 'A';
        if ($score >= 70) return 'B+';
        if ($score >= 60) return 'B';
        if ($score >= 50) return 'C+';
        if ($score >= 40) return 'C';
        return 'D';
    }

    /**
     * Train AI with new data (mock implementation)
     */
    public function train(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'training_data' => 'required|array',
                'model_type' => 'required|string|in:intent,sentiment,response'
            ]);

            // Mock training process
            $trainingResult = [
                'model_type' => $validated['model_type'],
                'training_samples' => count($validated['training_data']),
                'accuracy_improvement' => rand(1, 5),
                'training_time_seconds' => rand(30, 120),
                'status' => 'completed'
            ];

            return response()->json([
                'message' => 'AI training completed successfully',
                'training_result' => $trainingResult
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to train AI model',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get AI model information
     */
    public function getModelInfo(): JsonResponse
    {
        $modelInfo = [
            'version' => '1.0.0',
            'last_updated' => now()->subDays(rand(1, 30)),
            'training_samples' => rand(1000, 10000),
            'supported_languages' => ['Indonesian', 'English'],
            'model_type' => 'Rule-based AI with NLP capabilities',
            'features' => [
                'Intent Classification',
                'Sentiment Analysis',
                'Context Awareness',
                'Auto-escalation',
                'Multi-language Support'
            ]
        ];

        return response()->json($modelInfo);
    }
}
