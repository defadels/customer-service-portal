<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected string $apiKey;
    protected string $model;
    protected string $baseUrl;

    public function __construct()
    {
        $config = config('ai.gemini');
        $this->apiKey = (string) ($config['api_key'] ?? '');
        $this->model = (string) ($config['model'] ?? 'gemini-1.5-flash');
        $this->baseUrl = rtrim((string) ($config['base_url'] ?? 'https://generativelanguage.googleapis.com/v1beta'), '/');
    }

    public function generateChatResponse(string $message, array $context = []): array
    {
        try {
            if (!$this->apiKey) {
                Log::error('Gemini API key not configured');
                return $this->getFallbackResponse($message);
            }

            // Build content payload with basic system instruction and context
            $contents = [];
            $contents[] = [
                'role' => 'user',
                'parts' => [['text' => $this->getSystemPrompt()]],
            ];

            if (isset($context['previous_messages']) && is_iterable($context['previous_messages'])) {
                foreach ($context['previous_messages'] as $msg) {
                    $role = $this->mapSenderTypeToRole($msg->sender_type ?? 'Customer');
                    if ($role) {
                        $contents[] = [
                            'role' => $role,
                            'parts' => [['text' => (string) $msg->message]],
                        ];
                    }
                }
            }

            $contents[] = [
                'role' => 'user',
                'parts' => [['text' => $message]],
            ];

            $endpoint = $this->baseUrl . "/models/{$this->model}:generateContent?key={$this->apiKey}";

            $response = Http::timeout(20)->post($endpoint, [
                'contents' => $contents,
                'generationConfig' => [
                    'temperature' => 0.7,
                    'maxOutputTokens' => 512,
                ],
            ]);

            if (!$response->ok()) {
                Log::error('Gemini API error: ' . $response->status() . ' ' . $response->body());
                return $this->getFallbackResponse($message);
            }

            $data = $response->json();
            $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
            if (!$text) {
                return $this->getFallbackResponse($message);
            }

            // Minimal local analysis to match schema
            $analysis = $this->analyzeLocally($message);

            return [
                'response' => $text,
                'intent' => $analysis['intent'],
                'sentiment_score' => $analysis['sentiment_score'],
                'confidence' => $analysis['confidence'],
                'language_detected' => 'id',
                'ai_category' => $analysis['category'],
            ];
        } catch (\Throwable $e) {
            Log::error('Gemini exception: ' . $e->getMessage());
            return $this->getFallbackResponse($message);
        }
    }

    protected function mapSenderTypeToRole(string $senderType): ?string
    {
        return match ($senderType) {
            'Customer' => 'user',
            'AI Bot', 'Agent' => 'model',
            default => null,
        };
    }

    protected function getSystemPrompt(): string
    {
        return "You are an AI assistant for customer service. Answer briefly, politely, and in Indonesian when appropriate.";
    }

    protected function analyzeLocally(string $message): array
    {
        $lower = mb_strtolower($message);
        $intent = 'general';
        if (str_contains($lower, 'billing') || str_contains($lower, 'tagihan') || str_contains($lower, 'bayar')) {
            $intent = 'billing';
        } elseif (str_contains($lower, 'reset') || str_contains($lower, 'password') || str_contains($lower, 'akun')) {
            $intent = 'technical';
        } elseif (str_contains($lower, 'komplain') || str_contains($lower, 'complaint')) {
            $intent = 'complaint';
        }
        return [
            'intent' => $intent,
            'sentiment_score' => 0.1,
            'confidence' => 0.85,
            'category' => $intent,
        ];
    }

    protected function getFallbackResponse(string $message): array
    {
        return [
            'response' => 'Saat ini saya mengalami kendala menghubungi layanan AI. Namun saya tetap bisa membantu: mohon jelaskan detail masalah Anda.',
            'intent' => 'general',
            'sentiment_score' => 0.0,
            'confidence' => 0.6,
            'language_detected' => 'id',
            'ai_category' => 'general',
        ];
    }
}
