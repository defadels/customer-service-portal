<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'department',
        'skills',
        'status',
        'supervisor_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'skills' => 'array',
        ];
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is agent
     */
    public function isAgent(): bool
    {
        return $this->role === 'agent';
    }

    /**
     * Check if user is supervisor
     */
    public function isSupervisor(): bool
    {
        return $this->role === 'supervisor';
    }

    /**
     * Check if user can manage agents
     */
    public function canManageAgents(): bool
    {
        return in_array($this->role, ['admin', 'supervisor']);
    }

    /**
     * Check if user can manage customers
     */
    public function canManageCustomers(): bool
    {
        return in_array($this->role, ['admin', 'supervisor', 'agent']);
    }

    /**
     * Check if user can manage tickets
     */
    public function canManageTickets(): bool
    {
        return in_array($this->role, ['admin', 'supervisor', 'agent']);
    }

    /**
     * Supervisor relationship
     */
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    /**
     * Subordinates relationship
     */
    public function subordinates()
    {
        return $this->hasMany(User::class, 'supervisor_id');
    }

    /**
     * Assigned tickets relationship
     */
    public function assignedTickets()
    {
        return $this->hasMany(Ticket::class, 'assigned_agent_id');
    }

    /**
     * Chat messages relationship
     */
    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class, 'agent_id');
    }


    // public function canManageAgents()
    // {
    //     return in_array($this->role, ['admin', 'supervisor']);
    // }
}
