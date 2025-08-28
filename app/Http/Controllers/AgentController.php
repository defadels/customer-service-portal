<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request): JsonResponse
    // {
    //     $query = Agent::with(['assignedTickets', 'subordinates']);

    //     // Search functionality
    //     if ($request->has('q') && $request->q) {
    //         $search = $request->q;
    //         $query->where(function($q) use ($search) {
    //             $q->where('name', 'like', "%{$search}%")
    //               ->orWhere('email', 'like', "%{$search}%")
    //               ->orWhere('department', 'like', "%{$search}%");
    //         });
    //     }

    //     // Filter by status
    //     if ($request->has('status') && $request->status) {
    //         $query->where('status', $request->status);
    //     }

    //     // Filter by role
    //     if ($request->has('role') && $request->role) {
    //         $query->where('role', $request->role);
    //     }

    //     // Filter by department
    //     if ($request->has('department') && $request->department) {
    //         $query->where('department', $request->department);
    //     }

    //     $agents = $query->orderBy('name')->paginate(15);

    //     return response()->json($agents);
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:agents,email',
                'phone' => 'nullable|string|max:20',
                'department' => 'required|string|max:100',
                'role' => 'required|string|max:100',
                'skills' => 'nullable|string',
                'languages' => 'nullable|string',
                'shift_schedule' => 'nullable|string',
                'supervisor_id' => 'nullable|exists:agents,id',
                'status' => 'required|in:Active,On Leave,Terminated'
            ]);

            $agent = Agent::create($validated);

            return response()->json([
                'message' => 'Agent created successfully',
                'agent' => $agent
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create agent',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $agent = Agent::with(['assignedTickets', 'subordinates', 'supervisor'])
                         ->findOrFail($id);

            // Calculate performance metrics
            $performance = $this->calculateAgentPerformance($agent);

            return response()->json([
                'agent' => $agent,
                'performance' => $performance
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Agent not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $agent = Agent::findOrFail($id);

            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|email|unique:agents,email,' . $id,
                'phone' => 'sometimes|nullable|string|max:20',
                'department' => 'sometimes|string|max:100',
                'role' => 'sometimes|string|max:100',
                'skills' => 'sometimes|nullable|string',
                'languages' => 'sometimes|nullable|string',
                'shift_schedule' => 'sometimes|nullable|string',
                'supervisor_id' => 'sometimes|nullable|exists:agents,id',
                'status' => 'sometimes|in:Active,On Leave,Terminated'
            ]);

            $agent->update($validated);

            return response()->json([
                'message' => 'Agent updated successfully',
                'agent' => $agent->fresh()
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update agent',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $agent = Agent::findOrFail($id);

            // Check if agent has active tickets
            $activeTickets = $agent->assignedTickets()
                                 ->whereIn('status', ['Open', 'In Progress'])
                                 ->count();

            if ($activeTickets > 0) {
                return response()->json([
                    'message' => 'Cannot delete agent with active tickets',
                    'active_tickets' => $activeTickets
                ], 422);
            }

            $agent->delete();

            return response()->json([
                'message' => 'Agent deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete agent',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get available agents for ticket assignment
     */
    public function getAvailableAgents(): JsonResponse
    {
        try {
            $agents = Agent::where('status', 'Active')
                          ->withCount(['assignedTickets' => function($q) {
                              $q->whereIn('status', ['Open', 'In Progress']);
                          }])
                          ->orderBy('assigned_tickets_count')
                          ->get();

            return response()->json([
                'agents' => $agents
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to get available agents',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get agent performance metrics
     */
    public function getPerformance(string $id): JsonResponse
    {
        try {
            $agent = Agent::findOrFail($id);
            $performance = $this->calculateAgentPerformance($agent);

            return response()->json([
                'agent' => $agent,
                'performance' => $performance
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to get agent performance',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Calculate agent performance metrics
     */
    private function calculateAgentPerformance(Agent $agent): array
    {
        $tickets = $agent->assignedTickets();
        
        $totalTickets = $tickets->count();
        $resolvedTickets = $tickets->where('status', 'Resolved')->count();
        $openTickets = $tickets->where('status', 'Open')->count();
        $inProgressTickets = $tickets->where('status', 'In Progress')->count();

        // Calculate resolution rate
        $resolutionRate = $totalTickets > 0 ? round(($resolvedTickets / $totalTickets) * 100, 2) : 0;

        // Calculate average resolution time
        $avgResolutionTime = $this->calculateAverageResolutionTime($agent);

        // Calculate customer satisfaction (mock data for demo)
        $customerSatisfaction = $this->calculateCustomerSatisfaction($agent);

        // Calculate workload score
        $workloadScore = $this->calculateWorkloadScore($agent);

        return [
            'total_tickets' => $totalTickets,
            'resolved_tickets' => $resolvedTickets,
            'open_tickets' => $openTickets,
            'in_progress_tickets' => $inProgressTickets,
            'resolution_rate' => $resolutionRate,
            'avg_resolution_time_hours' => $avgResolutionTime,
            'customer_satisfaction' => $customerSatisfaction,
            'workload_score' => $workloadScore,
            'performance_grade' => $this->getPerformanceGrade($resolutionRate, $customerSatisfaction, $workloadScore)
        ];
    }

    /**
     * Calculate average resolution time for agent
     */
    private function calculateAverageResolutionTime(Agent $agent): ?float
    {
        $resolvedTickets = $agent->assignedTickets()
                                ->where('status', 'Resolved')
                                ->whereNotNull('resolved_at')
                                ->whereNotNull('created_at')
                                ->get();

        if ($resolvedTickets->isEmpty()) {
            return null;
        }

        $totalTime = $resolvedTickets->sum(function($ticket) {
            return $ticket->created_at->diffInHours($ticket->resolved_at);
        });

        return round($totalTime / $resolvedTickets->count(), 2);
    }

    /**
     * Calculate customer satisfaction (mock implementation)
     */
    private function calculateCustomerSatisfaction(Agent $agent): float
    {
        // Mock calculation based on agent role and experience
        $baseScore = 4.0;
        
        if ($agent->role === 'Senior Agent') {
            $baseScore += 0.3;
        } elseif ($agent->role === 'Supervisor') {
            $baseScore += 0.5;
        }

        // Add some randomness for demo
        $randomFactor = (rand(-20, 20) / 100);
        
        return round($baseScore + $randomFactor, 1);
    }

    /**
     * Calculate workload score
     */
    private function calculateWorkloadScore(Agent $agent): float
    {
        $activeTickets = $agent->assignedTickets()
                              ->whereIn('status', ['Open', 'In Progress'])
                              ->count();

        // Lower score = better (less workload)
        if ($activeTickets <= 3) {
            return 5.0; // Excellent
        } elseif ($activeTickets <= 5) {
            return 4.0; // Good
        } elseif ($activeTickets <= 8) {
            return 3.0; // Average
        } elseif ($activeTickets <= 12) {
            return 2.0; // High
        } else {
            return 1.0; // Very High
        }
    }

    /**
     * Get overall performance grade
     */
    private function getPerformanceGrade(float $resolutionRate, float $satisfaction, float $workload): string
    {
        $score = ($resolutionRate * 0.4) + ($satisfaction * 0.4) + ($workload * 0.2);
        
        if ($score >= 4.5) return 'A+';
        if ($score >= 4.0) return 'A';
        if ($score >= 3.5) return 'B+';
        if ($score >= 3.0) return 'B';
        if ($score >= 2.5) return 'C+';
        if ($score >= 2.0) return 'C';
        return 'D';
    }

    /**
     * Get agent statistics
     */
    public function getStats(): JsonResponse
    {
        $stats = [
            'total_agents' => Agent::count(),
            'active_agents' => Agent::where('status', 'Active')->count(),
            'agents_by_department' => $this->getAgentsByDepartment(),
            'agents_by_role' => $this->getAgentsByRole(),
            'performance_summary' => $this->getPerformanceSummary()
        ];

        return response()->json($stats);
    }

    /**
     * Get agents count by department
     */
    private function getAgentsByDepartment(): array
    {
        return Agent::selectRaw('department, COUNT(*) as count')
                   ->groupBy('department')
                   ->pluck('count', 'department')
                   ->toArray();
    }

    /**
     * Get agents count by role
     */
    private function getAgentsByRole(): array
    {
        return Agent::selectRaw('role, COUNT(*) as count')
                   ->groupBy('role')
                   ->pluck('count', 'role')
                   ->toArray();
    }

    /**
     * Get performance summary
     */
    private function getPerformanceSummary(): array
    {
        $agents = Agent::where('status', 'Active')->get();
        
        $totalSatisfaction = 0;
        $totalResolutionRate = 0;
        $activeCount = 0;

        foreach ($agents as $agent) {
            $performance = $this->calculateAgentPerformance($agent);
            $totalSatisfaction += $performance['customer_satisfaction'];
            $totalResolutionRate += $performance['resolution_rate'];
            $activeCount++;
        }

        return [
            'avg_satisfaction' => $activeCount > 0 ? round($totalSatisfaction / $activeCount, 2) : 0,
            'avg_resolution_rate' => $activeCount > 0 ? round($totalResolutionRate / $activeCount, 2) : 0,
            'top_performers' => $this->getTopPerformers()
        ];
    }

    /**
     * Get top performing agents
     */
    private function getTopPerformers(): array
    {
        return Agent::where('status', 'Active')
                   ->withCount(['assignedTickets' => function($q) {
                       $q->where('status', 'Resolved');
                   }])
                   ->orderByDesc('assigned_tickets_count')
                   ->limit(5)
                   ->get(['id', 'name', 'role', 'department'])
                   ->toArray();
    }
}
