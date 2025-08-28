<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agent extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'department', 'role',
        'skills', 'languages', 'shift_schedule',
        'supervisor_id', 'status', 'hire_date'
    ];

    protected $casts = [
        'hire_date' => 'date',
    ];

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Agent::class, 'supervisor_id');
    }

    public function subordinates(): HasMany
    {
        return $this->hasMany(Agent::class, 'supervisor_id');
    }

    public function assignedTickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'assigned_agent_id');
    }

    public function chatMessages(): HasMany
    {
        return $this->hasMany(ChatMessage::class);
    }
}
