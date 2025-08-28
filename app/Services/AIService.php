<?php

namespace App\Services;

class AIService
{
    protected OpenAIService|GeminiService $provider;

    public function __construct()
    {
        $provider = config('ai.provider', 'openai');
        $this->provider = $provider === 'gemini'
            ? app(GeminiService::class)
            : app(OpenAIService::class);
    }

    public function generateResponse(string $message, array $context = []): array
    {
        // For backward compatibility, delegate to chat response
        return $this->provider->generateChatResponse($message, $context);
    }

    public function generateChatResponse(string $message, array $context = []): array
    {
        return $this->provider->generateChatResponse($message, $context);
    }
}
