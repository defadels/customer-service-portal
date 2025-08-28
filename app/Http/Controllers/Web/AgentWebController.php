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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:agents,email',
            'role' => 'required|in:agent,supervisor,admin',
            'department' => 'nullable|string|max:100',
            'status' => 'nullable|in:Active,Inactive',
            'supervisor_id' => 'nullable|exists:agents,id',
        ]);

        $agent = Agent::create($validated);

        return redirect()->route('agents.show', $agent->id)
            ->with('status', 'Agent created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $agent = Agent::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:agents,email,' . $agent->id,
            'role' => 'required|in:agent,supervisor,admin',
            'department' => 'nullable|string|max:100',
            'status' => 'nullable|in:Active,Inactive',
            'supervisor_id' => 'nullable|exists:agents,id',
        ]);

        $agent->update($validated);

        return redirect()->route('agents.show', $agent->id)
            ->with('status', 'Agent updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $agent = Agent::findOrFail($id);
        $agent->delete();

        return redirect()->route('agents.index')
            ->with('status', 'Agent deleted successfully');
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
