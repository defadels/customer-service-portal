<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;

class AgentWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Agent::with(['assignedTickets', 'subordinates']);

        // Search functionality
        if ($request->has('q') && $request->q) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Filter by role
        if ($request->has('role') && $request->role) {
            $query->where('role', $request->role);
        }

        // Filter by department
        if ($request->has('department') && $request->department) {
            $query->where('department', $request->department);
        }

        $agents = $query->orderBy('name')->paginate(15);

        return view('agents.index', compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $supervisors = Agent::where('role', 'supervisor')->get();
        return view('agents.create', compact('supervisors'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $agent = Agent::with(['assignedTickets', 'subordinates', 'supervisor'])->findOrFail($id);
        
        // Calculate performance metrics
        $performance = $this->calculateAgentPerformance($agent);
        
        return view('agents.show', compact('agent', 'performance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agent = Agent::findOrFail($id);
        $supervisors = Agent::where('role', 'supervisor')->where('id', '!=', $id)->get();
        return view('agents.edit', compact('agent', 'supervisors'));
    }

    /**
     * Calculate agent performance metrics
     */
    private function calculateAgentPerformance($agent)
    {
        $totalTickets = $agent->assignedTickets()->count();
        $resolvedTickets = $agent->assignedTickets()->where('status', 'Resolved')->count();
        $openTickets = $agent->assignedTickets()->where('status', 'Open')->count();
        $escalatedTickets = $agent->assignedTickets()->where('escalation_level', '>', 0)->count();

        $resolutionRate = $totalTickets > 0 ? ($resolvedTickets / $totalTickets) * 100 : 0;
        $escalationRate = $totalTickets > 0 ? ($escalatedTickets / $totalTickets) * 100 : 0;

        return [
            'total_tickets' => $totalTickets,
            'resolved_tickets' => $resolvedTickets,
            'open_tickets' => $openTickets,
            'escalated_tickets' => $escalatedTickets,
            'resolution_rate' => round($resolutionRate, 2),
            'escalation_rate' => round($escalationRate, 2)
        ];
    }
}
