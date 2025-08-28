<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\OpenAIService;

class TestOpenAI extends Command
{
    protected $signature = 'test:openai';
    protected $description = 'Test OpenAI integration';

    public function handle(OpenAIService $openai)
    {
        $this->info('Testing OpenAI Integration...');

        try {
            $this->info('Sending test message to OpenAI...');

            $response = $openai->generateChatResponse(
                "Hello, this is a test message. Please respond with a short greeting.",
                ['chat_id' => 'test-'.time()]
            );

            $this->info('Response received successfully!');
            $this->info('AI Response: ' . $response['response']);
            $this->info('Intent: ' . $response['intent']);
            $this->info('Sentiment: ' . $response['sentiment']);
            $this->info('Confidence: ' . $response['confidence']);

            $this->info('✅ OpenAI integration is working correctly!');

        } catch (\Exception $e) {
            $this->error('❌ Error testing OpenAI:');
            $this->error($e->getMessage());

            if (str_contains($e->getMessage(), 'api_key')) {
                $this->warn('Please check your OPENAI_API_KEY in .env file');
            }
            if (str_contains($e->getMessage(), 'organization')) {
                $this->warn('Please check your OPENAI_ORGANIZATION in .env file');
            }
        }
    }
}
