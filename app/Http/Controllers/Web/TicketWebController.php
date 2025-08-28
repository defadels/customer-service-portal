<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Customer;
use App\Models\Agent;
use Illuminate\Http\Request;

class TicketWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Ticket::with(['customer', 'assignedAgent']);

        // Search functionality
        if ($request->has('q') && $request->q) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('subject', 'like', "%{$search}%")
                  ->orWhere('ticket_number', 'like', "%{$search}%")
                  ->orWhereHas('customer', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Filter by priority
        if ($request->has('priority') && $request->priority) {
            $query->where('priority', $request->priority);
        }

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        $tickets = $query->orderBy('created_at', 'desc')->paginate(15);
        $customers = Customer::all();
        $agents = Agent::all();

        return view('tickets.index', compact('tickets', 'customers', 'agents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $agents = Agent::all();
        return view('tickets.create', compact('customers', 'agents'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = Ticket::with(['customer', 'assignedAgent', 'chatMessages'])->findOrFail($id);
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ticket = Ticket::with(['customer', 'assignedAgent'])->findOrFail($id);
        $customers = Customer::all();
        $agents = Agent::all();
        return view('tickets.edit', compact('ticket', 'customers', 'agents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'subject' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Open,In Progress,Resolved,Closed',
            'category' => 'nullable|string|max:100',
            'assigned_agent_id' => 'nullable|exists:agents,id',
        ]);

        $validated['ticket_number'] = 'TKT-' . now()->format('Y') . '-' . str_pad((string) (Ticket::max('id') + 1), 6, '0', STR_PAD_LEFT);

        $ticket = Ticket::create($validated);

        return redirect()->route('tickets.show', $ticket->id)
            ->with('status', 'Ticket created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ticket = Ticket::findOrFail($id);

        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'subject' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Open,In Progress,Resolved,Closed',
            'category' => 'nullable|string|max:100',
            'assigned_agent_id' => 'nullable|exists:agents,id',
        ]);

        $ticket->update($validated);

        return redirect()->route('tickets.show', $ticket->id)
            ->with('status', 'Ticket updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('tickets.index')
            ->with('status', 'Ticket deleted successfully');
    }
}
