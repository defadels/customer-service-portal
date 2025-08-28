<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\ChatMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class AIControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_can_generate_ai_response()
    {
        $chatId = $this->faker->uuid;

        $response = $this->postJson('/api/ai/generate-response', [
            'message' => 'Hello, I need help',
            'context' => [
                'chat_id' => $chatId
            ]
        ]);

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'response',
                    'needs_human_agent',
                    'message_id'
                ]);
    }

    public function test_can_get_ai_stats()
    {
        $response = $this->getJson('/api/ai/stats');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'total_messages',
                    'ai_responses',
                    'customer_messages',
                    'average_sentiment',
                    'average_confidence'
                ]);
    }
}
