<?php

namespace App\Services;

use OpenAI\Client;
use Illuminate\Support\Facades\Log;
use OpenAI;

class OpenAIService
{
    protected $client;
    protected $model;

    public function __construct()
    {
        $apiKey = config('services.openai.api_key');
        $organizationId = config('services.openai.organization');

        if (!$apiKey) {
            Log::error('OpenAI API key not configured');
            $this->client = null;
        } else {
            try {
                $this->client = OpenAI::client($apiKey, $organizationId);
            } catch (\Exception $e) {
                Log::error('Failed to initialize OpenAI client: ' . $e->getMessage());
                $this->client = null;
            }
        }
        
        $this->model = config('services.openai.model', 'gpt-4-turbo-preview');
    }

    public function generateResponse(string $message, array $context = []): array
    {
        try {
            if (!$this->client) {
                Log::error('OpenAI client not initialized. Check API key and organization ID.');
                return $this->getIntelligentFallbackResponse($message);
            }

            // Build conversation history from context
            $messages = $this->buildConversationHistory($context);
            $messages[] = ['role' => 'user', 'content' => $message];

            $response = $this->client->chat()->create([
                'model' => $this->model,
                'messages' => $messages,
                'temperature' => 0.7,
                'max_tokens' => 500,
                'presence_penalty' => 0.6,
                'frequency_penalty' => 0.5,
            ]);

            // Analyze the response for metadata
            $analysis = $this->analyzeResponse($message);

            return [
                'response' => $response->choices[0]->message->content,
                'intent' => $analysis['intent'] ?? 'general',
                'sentiment_score' => $analysis['sentiment'] ?? 0,
                'confidence' => $analysis['confidence'] ?? 0.9,
                'language_detected' => $this->detectLanguage($message),
                'ai_category' => $analysis['category'] ?? 'general'
            ];

        } catch (\Exception $e) {
            Log::error('OpenAI Error: ' . $e->getMessage());
            return $this->getIntelligentFallbackResponse($message);
        }
    }

    /**
     * Generate chat response specifically for chat interface
     */
    public function generateChatResponse(string $message, array $context = []): array
    {
        try {
            if (!$this->client) {
                Log::error('OpenAI client not initialized. Check API key and organization ID.');
                return $this->getIntelligentFallbackResponse($message);
            }

            // Build conversation history from context
            $messages = $this->buildConversationHistory($context);
            $messages[] = ['role' => 'user', 'content' => $message];

            // Try with retry logic for rate limiting
            $maxRetries = 3;
            $retryDelay = 1; // seconds
            
            for ($attempt = 1; $attempt <= $maxRetries; $attempt++) {
                try {
                    $response = $this->client->chat()->create([
                        'model' => $this->model,
                        'messages' => $messages,
                        'temperature' => 0.7,
                        'max_tokens' => 500,
                        'presence_penalty' => 0.6,
                        'frequency_penalty' => 0.5,
                    ]);

                    // Analyze the response for metadata
                    $analysis = $this->analyzeResponse($message);

                    return [
                        'response' => $response->choices[0]->message->content,
                        'intent' => $analysis['intent'] ?? 'general',
                        'sentiment_score' => $analysis['sentiment'] ?? 0,
                        'confidence' => $analysis['confidence'] ?? 0.9,
                        'language_detected' => $this->detectLanguage($message),
                        'ai_category' => $analysis['category'] ?? 'general'
                    ];

                } catch (\Exception $e) {
                    $errorMessage = $e->getMessage();
                    
                    // Check if it's a rate limit error
                    if (str_contains($errorMessage, 'rate limit') || str_contains($errorMessage, '429')) {
                        if ($attempt < $maxRetries) {
                            Log::warning("OpenAI rate limit hit, retrying in {$retryDelay} seconds... (Attempt {$attempt}/{$maxRetries})");
                            sleep($retryDelay);
                            $retryDelay *= 2; // Exponential backoff
                            continue;
                        } else {
                            Log::error('OpenAI rate limit exceeded after all retries');
                            return $this->getIntelligentFallbackResponse($message);
                        }
                    } else {
                        // Non-rate-limit error, don't retry
                        throw $e;
                    }
                }
            }

            // If we get here, all retries failed
            return $this->getIntelligentFallbackResponse($message);

        } catch (\Exception $e) {
            Log::error('OpenAI Chat Error: ' . $e->getMessage());
            return $this->getIntelligentFallbackResponse($message);
        }
    }

    protected function buildConversationHistory(array $context): array
    {
        $messages = [];
        
        // Add system prompt
        $messages[] = [
            'role' => 'system',
            'content' => $this->getSystemPrompt()
        ];

        // Add previous messages if available
        if (isset($context['previous_messages']) && is_array($context['previous_messages'])) {
            foreach ($context['previous_messages'] as $msg) {
                $role = $this->mapSenderTypeToRole($msg->sender_type ?? 'Customer');
                if ($role !== null) {
                    $messages[] = [
                        'role' => $role,
                        'content' => $msg->message
                    ];
                }
            }
        }
        
        return $messages;
    }

    protected function mapSenderTypeToRole(string $senderType): ?string
    {
        return match ($senderType) {
            'Customer' => 'user',
            'AI Bot' => 'assistant',
            'Agent' => 'assistant',
            default => null
        };
    }

    protected function getSystemPrompt(): string
    {
        return "You are a professional customer service AI assistant for our company. " .
               "Your role is to provide helpful, accurate, and friendly support to our customers. " .
               "Some important guidelines:\n" .
               "1. Be concise but thorough\n" .
               "2. Always be polite and professional\n" .
               "3. Use appropriate emojis sparingly to add warmth\n" .
               "4. If you're not sure about something, acknowledge it and offer to escalate\n" .
               "5. Keep responses focused and relevant\n" .
               "6. For technical issues or complex problems, suggest escalation to a human agent\n" .
               "7. Use formal Indonesian (avoid slang/informal language)\n" .
               "8. Show empathy when customers express frustration";
    }

    protected function analyzeResponse(string $message): array
    {
        try {
            if (!$this->client) {
                return $this->getFallbackAnalysis();
            }

            $response = $this->client->chat()->create([
                'model' => $this->model,
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Analyze the following message and return JSON with intent, sentiment (score from -1 to 1), confidence, and category.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $message
                    ]
                ],
                'response_format' => ['type' => 'json_object']
            ]);

            return json_decode($response->choices[0]->message->content, true);
        } catch (\Exception $e) {
            Log::error('Analysis Error: ' . $e->getMessage());
            return $this->getFallbackAnalysis();
        }
    }

    protected function getIntelligentFallbackResponse(string $message): array
    {
        // Provide intelligent fallback responses based on message content
        $message = strtolower($message);
        
        // Greeting responses
        if (str_contains($message, 'halo') || str_contains($message, 'hello') || str_contains($message, 'hi')) {
            return [
                'response' => "Halo! Senang bertemu dengan Anda. Saya adalah asisten AI yang siap membantu. Ada yang bisa saya bantu hari ini? 😊",
                'intent' => 'greeting',
                'sentiment_score' => 0.8,
                'confidence' => 0.9,
                'ai_category' => 'greeting'
            ];
        }
        
        // Billing/help responses
        if (str_contains($message, 'billing') || str_contains($message, 'tagihan') || str_contains($message, 'bayar') || str_contains($message, 'harga')) {
            return [
                'response' => "Untuk masalah billing dan pembayaran, saya dapat membantu Anda. Mohon berikan detail lebih lanjut tentang masalah yang Anda hadapi, atau saya bisa menghubungkan Anda dengan tim billing kami.",
                'intent' => 'billing',
                'sentiment_score' => 0.0,
                'confidence' => 0.8,
                'ai_category' => 'billing'
            ];
        }
        
        // Technical support responses
        if (str_contains($message, 'technical') || str_contains($message, 'reset') || str_contains($message, 'password') || str_contains($message, 'account') || str_contains($message, 'working')) {
            return [
                'response' => "Untuk masalah teknis, saya akan membantu Anda menyelesaikannya. Mohon berikan detail spesifik tentang masalah yang Anda alami, atau saya bisa mengescalate ke tim technical support kami.",
                'intent' => 'technical',
                'sentiment_score' => 0.0,
                'confidence' => 0.8,
                'ai_category' => 'technical'
            ];
        }
        
        // Complaint responses
        if (str_contains($message, 'complaint') || str_contains($message, 'komplain') || str_contains($message, 'kecewa') || str_contains($message, 'marah')) {
            return [
                'response' => "Saya mengerti kekesalan Anda dan mohon maaf atas ketidaknyamanannya. Saya akan membantu menyelesaikan masalah ini. Mohon berikan detail lengkap tentang keluhan Anda agar saya bisa memberikan solusi yang tepat.",
                'intent' => 'complaint',
                'sentiment_score' => -0.5,
                'confidence' => 0.9,
                'ai_category' => 'complaint'
            ];
        }
        
        // General help responses
        if (str_contains($message, 'help') || str_contains($message, 'bantuan') || str_contains($message, 'tolong') || str_contains($message, 'services')) {
            return [
                'response' => "Saya siap membantu Anda! Kami menyediakan berbagai layanan termasuk technical support, billing assistance, dan customer service. Apa yang spesifik yang Anda butuhkan bantuan?",
                'intent' => 'help',
                'sentiment_score' => 0.5,
                'confidence' => 0.8,
                'ai_category' => 'general'
            ];
        }
        
        // Default fallback response
        return [
            'response' => "Terima kasih atas pesan Anda. Saat ini saya sedang mengalami gangguan teknis ringan, tetapi saya tetap siap membantu. Mohon coba lagi dalam beberapa saat, atau beri tahu saya apa yang bisa saya bantu.",
            'intent' => 'general',
            'sentiment_score' => 0.0,
            'confidence' => 0.7,
            'ai_category' => 'general'
        ];
    }

    protected function getFallbackAnalysis(): array
    {
        return [
            'intent' => 'unknown',
            'sentiment' => 0,
            'confidence' => 0.5,
            'category' => 'general'
        ];
    }

    protected function detectLanguage(string $text): string
    {
        try {
            if (!$this->client) {
                return 'id'; // Default to Indonesian
            }

            $response = $this->client->chat()->create([
                'model' => $this->model,
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a language detector. Return ONLY the ISO 639-1 language code (2 letters) of the input text. Example: "en" for English, "id" for Indonesian.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $text
                    ]
                ],
                'max_tokens' => 5,
                'temperature' => 0
            ]);

            $langCode = trim($response->choices[0]->message->content);
            return preg_match('/^[a-z]{2}$/', $langCode) ? $langCode : 'id';
        } catch (\Exception $e) {
            Log::error('Language detection error: ' . $e->getMessage());
            return 'id'; // Default to Indonesian
        }
    }
}
