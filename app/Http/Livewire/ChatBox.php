<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ChatMessage;
use App\Services\AIService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatBox extends Component
{
    public $chatId;
    public $messages = [];
    public $newMessage = '';
    public $ticketId;
    public $customerId;
    public $agentId;
    public $isTyping = false;
    public $error = null;
    public $provider = null; // optional override: 'openai' or 'gemini'

    protected $listeners = [
        'refreshMessages' => 'loadMessages',
        'echo:chat.{chatId},MessageSent' => 'notifyNewMessage',
    ];

    public function render()
    {
        return view('livewire.chat-box');
    }

    public function mount($chatId, $ticketId = null, $customerId = null, $agentId = null, $provider = null)
    {
        $this->chatId = $chatId;
        $this->ticketId = $ticketId;
        $this->customerId = $customerId;
        $this->agentId = $agentId;
        $this->provider = $provider ?: request()->get('provider');
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->messages = ChatMessage::where('chat_id', $this->chatId)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function sendMessage()
    {
        if (trim($this->newMessage) === '') return;

        try {
            // Create customer message
            $message = ChatMessage::create([
                'chat_id' => $this->chatId,
                'ticket_id' => $this->ticketId,
                'customer_id' => $this->customerId,
                'agent_id' => $this->agentId,
                'message' => $this->newMessage,
                'message_type' => 'Text',
                'sender_type' => $this->agentId ? 'Agent' : 'Customer'
            ]);

            // Clear input
            $this->newMessage = '';
            
            // Reload messages
            $this->loadMessages();
            
            // Emit event for real-time updates
            $this->emit('messageSent', $message);
            $this->dispatch('chatUpdated');

            // If customer, generate AI response
            if (!$this->agentId && $this->customerId) {
                $this->generateAIResponse($message->message);
            }

        } catch (\Exception $e) {
            Log::error('Error sending message: ' . $e->getMessage());
            $this->error = 'Gagal mengirim pesan. Silakan coba lagi.';
            $this->dispatch('showError');
        }
    }

    public function generateAIResponse($customerMessage)
    {
        try {
            $this->isTyping = true;
            $this->dispatch('chatUpdated');

            // Resolve AI provider
            if ($this->provider === 'gemini') {
                $aiService = app(\App\Services\GeminiService::class);
            } elseif ($this->provider === 'openai') {
                $aiService = app(\App\Services\OpenAIService::class);
            } else {
                $aiService = app(AIService::class);
            }

            // Get previous messages for context
            $previousMessages = $this->messages->take(-5); // Last 5 messages for context

            $aiResult = $aiService->generateChatResponse($customerMessage, [
                'previous_messages' => $previousMessages
            ]);

            // Create AI response message
            $message = ChatMessage::create([
                'chat_id' => $this->chatId,
                'ticket_id' => $this->ticketId,
                'message' => $aiResult['response'],
                'message_type' => 'Text',
                'sender_type' => 'AI Bot',
                'ai_confidence_score' => $aiResult['confidence'],
                'intent_classification' => $aiResult['intent'],
                'sentiment_score' => $aiResult['sentiment_score'],
                'language_detected' => $aiResult['language_detected'] ?? 'id'
            ]);

            // Check if escalation is needed
            if ($aiResult['confidence'] < 0.5 || $aiResult['intent'] === 'error') {
                $this->escalateToHumanAgent($message->id);
            }

            // Reload messages and emit events
            $this->loadMessages();
            $this->emit('aiResponseGenerated', $message);
            $this->dispatch('chatUpdated');

        } catch (\Exception $e) {
            Log::error('AI Response Error: ' . $e->getMessage());
            $this->error = 'Maaf, terjadi kesalahan. Silakan coba lagi atau hubungi agent kami.';
            $this->dispatch('showError');
        } finally {
            $this->isTyping = false;
            $this->dispatch('chatUpdated');
        }
    }

    public function notifyNewMessage($event)
    {
        $this->loadMessages();
        $this->dispatch('chatUpdated');
    }

    public function getListeners()
    {
        return [
            "echo-private:chat.{$this->chatId},MessageSent" => 'notifyNewMessage',
            'refreshMessages' => 'loadMessages',
            'messageSent' => 'loadMessages',
            'aiResponseGenerated' => 'loadMessages'
        ];
    }

    public function dehydrate()
    {
        $this->dispatch('chatUpdated');
    }

    protected function escalateToHumanAgent($messageId)
    {
        try {
            $message = ChatMessage::create([
                'chat_id' => $this->chatId,
                'ticket_id' => $this->ticketId,
                'message' => 'Percakapan ini telah di-escalate ke agent manusia. Agent akan membantu Anda segera.',
                'message_type' => 'System',
                'sender_type' => 'System',
            ]);

            // TODO: Implement notification to available agents
            // For now, we'll just update the ticket status if it exists
            if ($this->ticketId) {
                $ticket = \App\Models\Ticket::find($this->ticketId);
                if ($ticket) {
                    $ticket->update([
                        'status' => 'needs_agent',
                        'escalated_at' => now(),
                        'escalation_reason' => 'AI confidence low or error detected'
                    ]);
                }
            }

            $this->loadMessages();
            $this->dispatch('chatUpdated');
        } catch (\Exception $e) {
            Log::error('Escalation Error: ' . $e->getMessage());
        }
    }
}
