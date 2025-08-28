@extends('layouts.app')

@section('title', 'Ticket Details - Customer Service Portal')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Page Header -->
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">
                    <i class="fas fa-ticket-alt text-blue-600 mr-3"></i>
                    Ticket Details
                </h2>
                <p class="text-gray-600">View and manage ticket information.</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('tickets.edit', $id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Ticket
                </a>
                <a href="{{ route('tickets.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to List
                </a>
            </div>
        </div>
    </div>

    <!-- Ticket Information -->
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Ticket Information</h3>
        <div id="ticket-info" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Loading state -->
            <div class="col-span-2 text-center py-8">
                <i class="fas fa-spinner fa-spin text-2xl text-blue-600 mb-4"></i>
                <p class="text-gray-600">Loading ticket information...</p>
            </div>
        </div>
    </div>

    <!-- Ticket History -->
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Ticket History</h3>
        <div id="ticket-history">
            <!-- Loading state -->
            <div class="text-center py-8">
                <i class="fas fa-spinner fa-spin text-2xl text-blue-600 mb-4"></i>
                <p class="text-gray-600">Loading ticket history...</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadTicketInfo();
    loadTicketHistory();
});

function loadTicketInfo() {
    const ticketId = window.location.pathname.split('/').pop();
    
    fetch(`/api/tickets/${ticketId}`)
        .then(response => response.json())
        .then(ticket => {
            const ticketInfo = document.getElementById('ticket-info');
            ticketInfo.innerHTML = `
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ticket Number</label>
                    <p class="text-lg font-mono text-gray-900">#${ticket.ticket_number}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                        ticket.status === 'Open' ? 'bg-blue-100 text-blue-800' :
                        ticket.status === 'In Progress' ? 'bg-yellow-100 text-yellow-800' :
                        ticket.status === 'Resolved' ? 'bg-green-100 text-green-800' :
                        'bg-gray-100 text-gray-800'
                    }">
                        ${ticket.status}
                    </span>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Priority</label>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                        ticket.priority === 'High' || ticket.priority === 'Urgent' || ticket.priority === 'Critical' 
                        ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800'
                    }">
                        ${ticket.priority}
                    </span>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <p class="text-lg text-gray-900">${ticket.category || 'Not specified'}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                    <p class="text-lg text-gray-900">${ticket.subject}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Customer</label>
                    <p class="text-lg text-gray-900">${ticket.customer ? ticket.customer.name : 'Unknown'}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Assigned Agent</label>
                    <p class="text-lg text-gray-900">${ticket.assigned_agent ? ticket.assigned_agent.name : 'Unassigned'}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Source</label>
                    <p class="text-lg text-gray-900">${ticket.source}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Created</label>
                    <p class="text-lg text-gray-900">${new Date(ticket.created_at).toLocaleString()}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Updated</label>
                    <p class="text-lg text-gray-900">${new Date(ticket.updated_at).toLocaleString()}</p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <p class="text-lg text-gray-900">${ticket.description}</p>
                </div>
                ${ticket.sla_deadline ? `
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">SLA Deadline</label>
                    <p class="text-lg text-gray-900">${new Date(ticket.sla_deadline).toLocaleString()}</p>
                </div>
                ` : ''}
            `;
        })
        .catch(error => {
            console.error('Error loading ticket info:', error);
            document.getElementById('ticket-info').innerHTML = `
                <div class="col-span-2 text-center py-8">
                    <i class="fas fa-exclamation-triangle text-2xl text-red-600 mb-4"></i>
                    <p class="text-red-600">Failed to load ticket information</p>
                </div>
            `;
        });
}

function loadTicketHistory() {
    const ticketId = window.location.pathname.split('/').pop();
    
    fetch(`/api/tickets/${ticketId}/history`)
        .then(response => response.json())
        .then(history => {
            if (history.length === 0) {
                document.getElementById('ticket-history').innerHTML = `
                    <div class="text-center py-8">
                        <i class="fas fa-history text-2xl text-gray-400 mb-4"></i>
                        <p class="text-gray-600">No history available for this ticket</p>
                    </div>
                `;
                return;
            }

            const historyHtml = history.map(entry => `
                <div class="border-l-4 border-blue-500 pl-4 py-3 mb-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-circle text-blue-500 text-xs mr-3"></i>
                            <span class="font-medium text-gray-900">${entry.action}</span>
                        </div>
                        <span class="text-sm text-gray-500">${new Date(entry.created_at).toLocaleString()}</span>
                    </div>
                    ${entry.description ? `<p class="text-gray-600 mt-2 ml-6">${entry.description}</p>` : ''}
                    ${entry.user ? `<p class="text-sm text-gray-500 mt-1 ml-6">By: ${entry.user.name}</p>` : ''}
                </div>
            `).join('');

            document.getElementById('ticket-history').innerHTML = historyHtml;
        })
        .catch(error => {
            console.error('Error loading ticket history:', error);
            document.getElementById('ticket-history').innerHTML = `
                <div class="text-center py-8">
                    <i class="fas fa-exclamation-triangle text-2xl text-red-600 mb-4"></i>
                    <p class="text-red-600">Failed to load ticket history</p>
                </div>
            `;
        });
}
</script>
@endpush
@endsection
