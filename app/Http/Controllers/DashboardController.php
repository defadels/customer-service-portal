<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function stats()
    {
        return response()->json([
            'total_customers' => Customer::count(),
            'open_tickets' => Ticket::where('status', 'open')->count(),
            'resolved_today' => Ticket::where('status', 'resolved')
                ->whereDate('updated_at', today())
                ->count(),
            'active_agents' => Agent::where('is_active', true)->count()
        ]);
    }

    public function aiStats()
    {
        // Simulasi data AI untuk demo
        return response()->json([
            'accuracy' => 95,
            'auto_resolution_rate' => 75,
            'average_response_time' => 1.2
        ]);
    }
}
