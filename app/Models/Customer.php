<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'city', 'state', 
        'postal_code', 'country', 'date_of_birth', 'gender', 
        'customer_type', 'status', 'communication_preference', 
        'language_preference', 'timezone'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function chatMessages(): HasMany
    {
        return $this->hasMany(ChatMessage::class);
    }
}
