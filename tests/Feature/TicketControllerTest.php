<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class TicketControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create(['role' => 'agent']);
    }

    public function test_can_list_tickets()
    {
        $this->actingAs($this->user);

        Ticket::factory()->count(5)->create();

        $response = $this->getJson('/api/tickets');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id',
                            'title',
                            'description',
                            'status',
                            'priority'
                        ]
                    ]
                ]);
    }

    public function test_can_create_ticket()
    {
        $this->actingAs($this->user);

        $ticketData = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'priority' => 'high',
            'customer_id' => User::factory()->create(['role' => 'customer'])->id
        ];

        $response = $this->postJson('/api/tickets', $ticketData);

        $response->assertStatus(201)
                ->assertJsonStructure([
                    'id',
                    'title',
                    'description',
                    'status',
                    'priority'
                ]);
    }
}
