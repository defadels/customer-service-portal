<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Customer;
use App\Models\Agent;
use App\Services\AIService;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class TicketController extends Controller
{
    protected $aiService;

    public function __construct(AIService $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request): JsonResponse
    // {
    //     $query = Ticket::with(['customer', 'assignedAgent']);

    //     // Search functionality
    //     if ($request->has('q') && $request->q) {
    //         $search = $request->q;
    //         $query->where(function($q) use ($search) {
    //             $q->where('subject', 'like', "%{$search}%")
    //               ->orWhere('ticket_number', 'like', "%{$search}%")
    //               ->orWhereHas('customer', function($q) use ($search) {
    //                   $q->where('name', 'like', "%{$search}%")
    //                     ->orWhere('email', 'like', "%{$search}%");
    //               });
    //         });
    //     }

    //     // Filter by status
    //     if ($request->has('status') && $request->status) {
    //         $query->where('status', $request->status);
    //     }

    //     // Filter by priority
    //     if ($request->has('priority') && $request->priority) {
    //         $query->where('priority', $request->priority);
    //     }

    //     // Filter by category
    //     if ($request->has('category') && $request->category) {
    //         $query->where('category', $request->category);
    //     }

    //     $tickets = $query->orderBy('created_at', 'desc')->paginate(15);

    //     return response()->json($tickets);
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'customer_id' => 'required|exists:customers,id',
                'subject' => 'required|string|max:255',
                'description' => 'required|string',
                'priority' => 'required|in:Low,Medium,High,Urgent,Critical',
                'category' => 'nullable|string|max:100',
                'subcategory' => 'nullable|string|max:100',
                'source' => 'required|in:Chat,Email,Phone,Social Media'
            ]);

            // Generate ticket number
            $ticket = new Ticket($validated);
            $ticket->status = 'Open';
            $ticket->escalation_level = 0;
            $ticket->save();

            // Analyze with AI for auto-categorization and sentiment
            $aiAnalysis = $this->aiService->generateResponse($validated['description']);
            
            $ticket->update([
                'sentiment_score' => $aiAnalysis['sentiment'],
                'ai_category' => $aiAnalysis['ai_category']
            ]);

            // Auto-assign agent based on category and availability
            $this->autoAssignAgent($ticket);

            return response()->json([
                'message' => 'Ticket created successfully',
                'ticket' => $ticket->load(['customer', 'assignedAgent'])
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create ticket',
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
            $ticket = Ticket::with(['customer', 'assignedAgent', 'chatMessages'])
                           ->findOrFail($id);

            return response()->json([
                'ticket' => $ticket
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ticket not found',
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
            $ticket = Ticket::findOrFail($id);

            $validated = $request->validate([
                'subject' => 'sometimes|string|max:255',
                'description' => 'sometimes|string',
                'priority' => 'sometimes|in:Low,Medium,High,Urgent,Critical',
                'status' => 'sometimes|in:Open,In Progress,Pending,Resolved,Closed',
                'category' => 'sometimes|string|max:100',
                'subcategory' => 'sometimes|string|max:100',
                'assigned_agent_id' => 'sometimes|nullable|exists:agents,id'
            ]);

            $ticket->update($validated);

            // Update resolved_at if status is Resolved
            if (isset($validated['status']) && $validated['status'] === 'Resolved') {
                $ticket->update(['resolved_at' => now()]);
            }

            return response()->json([
                'message' => 'Ticket updated successfully',
                'ticket' => $ticket->load(['customer', 'assignedAgent'])
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update ticket',
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
            $ticket = Ticket::findOrFail($id);
            $ticket->delete();

            return response()->json([
                'message' => 'Ticket deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete ticket',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update ticket status
     */
    public function updateStatus(Request $request, Ticket $ticket): JsonResponse
    {
        try {
            $validated = $request->validate([
                'status' => 'required|in:Open,In Progress,Pending,Resolved,Closed'
            ]);

            $ticket->update($validated);

            if ($validated['status'] === 'Resolved') {
                $ticket->update(['resolved_at' => now()]);
            }

            return response()->json([
                'message' => 'Ticket status updated successfully',
                'ticket' => $ticket->load(['customer', 'assignedAgent'])
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Assign agent to ticket
     */
    public function assignAgent(Request $request, Ticket $ticket): JsonResponse
    {
        try {
            $validated = $request->validate([
                'agent_id' => 'required|exists:agents,id'
            ]);

            $ticket->update([
                'assigned_agent_id' => $validated['agent_id'],
                'status' => 'In Progress'
            ]);

            return response()->json([
                'message' => 'Agent assigned successfully',
                'ticket' => $ticket->load(['customer', 'assignedAgent'])
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Auto-assign agent based on category and availability
     */
    private function autoAssignAgent(Ticket $ticket): void
    {
        $query = Agent::where('status', 'Active');

        // Match agent by department if category is available
        if ($ticket->category) {
            if (str_contains(strtolower($ticket->category), 'technical')) {
                $query->where('department', 'Technical Support');
            } elseif (str_contains(strtolower($ticket->category), 'billing')) {
                $query->where('department', 'Billing Support');
            } else {
                $query->where('department', 'Customer Support');
            }
        }

        // Get agent with least active tickets
        $agent = $query->withCount(['assignedTickets' => function($q) {
            $q->whereIn('status', ['Open', 'In Progress']);
        }])
        ->orderBy('assigned_tickets_count')
        ->first();

        if ($agent) {
            $ticket->update(['assigned_agent_id' => $agent->id]);
        }
    }

    /**
     * Get ticket statistics
     */
    public function getStats(): JsonResponse
    {
        $stats = [
            'total_tickets' => Ticket::count(),
            'open_tickets' => Ticket::where('status', 'Open')->count(),
            'in_progress_tickets' => Ticket::where('status', 'In Progress')->count(),
            'resolved_tickets' => Ticket::where('status', 'Resolved')->count(),
            'urgent_tickets' => Ticket::where('priority', 'Urgent')->count(),
            'critical_tickets' => Ticket::where('priority', 'Critical')->count(),
            'avg_resolution_time' => $this->calculateAverageResolutionTime(),
            'tickets_by_category' => $this->getTicketsByCategory(),
            'tickets_by_priority' => $this->getTicketsByPriority()
        ];

        return response()->json($stats);
    }

    /**
     * Calculate average resolution time
     */
    private function calculateAverageResolutionTime(): ?float
    {
        $resolvedTickets = Ticket::whereNotNull('resolved_at')
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
     * Get tickets count by category
     */
    private function getTicketsByCategory(): array
    {
        return Ticket::selectRaw('category, COUNT(*) as count')
                    ->whereNotNull('category')
                    ->groupBy('category')
                    ->pluck('count', 'category')
                    ->toArray();
    }

    /**
     * Get tickets count by priority
     */
    private function getTicketsByPriority(): array
    {
        return Ticket::selectRaw('priority, COUNT(*) as count')
                    ->groupBy('priority')
                    ->pluck('count', 'priority')
                    ->toArray();
    }
}
