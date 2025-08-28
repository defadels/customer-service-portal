<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatMessage extends Model
{
    protected $fillable = [
        'chat_id', 'ticket_id', 'customer_id', 'agent_id',
        'message', 'message_type', 'sender_type',
        'ai_confidence_score', 'intent_classification',
        'sentiment_score', 'language_detected', 'is_read'
    ];

    protected $casts = [
        'ai_confidence_score' => 'decimal:2',
        'sentiment_score' => 'decimal:2',
        'is_read' => 'boolean',
    ];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }
}
