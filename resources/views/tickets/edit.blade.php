@extends('layouts.app')

@section('title', 'Edit Ticket - Customer Service Portal')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Page Header -->
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">
                    <i class="fas fa-edit text-blue-600 mr-3"></i>
                    Edit Ticket
                </h2>
                <p class="text-gray-600">Update ticket information and status.</p>
            </div>
            <a href="{{ route('tickets.show', $id) }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Details
            </a>
        </div>
    </div>

    <!-- Ticket Edit Form -->
    <div class="bg-white shadow rounded-lg p-6">
        <form id="ticket-edit-form" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Ticket Details -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4">Ticket Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject *</label>
                        <input 
                            type="text" 
                            id="subject" 
                            name="subject" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Brief description of the issue"
                        >
                    </div>
                    
                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Priority *</label>
                        <select 
                            id="priority" 
                            name="priority" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                            <option value="">Select Priority</option>
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                            <option value="Urgent">Urgent</option>
                            <option value="Critical">Critical</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select 
                            id="status" 
                            name="status" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                            <option value="">Select Status</option>
                            <option value="Open">Open</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Waiting for Customer">Waiting for Customer</option>
                            <option value="Resolved">Resolved</option>
                            <option value="Closed">Closed</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <select 
                            id="category" 
                            name="category" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                            <option value="">Select Category</option>
                            <option value="Technical Support">Technical Support</option>
                            <option value="Billing Issue">Billing Issue</option>
                            <option value="General Inquiry">General Inquiry</option>
                            <option value="Feature Request">Feature Request</option>
                            <option value="Bug Report">Bug Report</option>
                            <option value="Account Management">Account Management</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="subcategory" class="block text-sm font-medium text-gray-700 mb-2">Subcategory</label>
                        <input 
                            type="text" 
                            id="subcategory" 
                            name="subcategory" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Optional subcategory"
                        >
                    </div>
                    
                    <div>
                        <label for="source" class="block text-sm font-medium text-gray-700 mb-2">Source</label>
                        <select 
                            id="source" 
                            name="source" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                            <option value="Chat">Chat</option>
                            <option value="Email">Email</option>
                            <option value="Phone">Phone</option>
                            <option value="Social Media">Social Media</option>
                        </select>
                    </div>
                </div>
                
                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="5"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Detailed description of the issue or request..."
                    ></textarea>
                </div>
            </div>

            <!-- Assignment -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4">Assignment</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="assigned_agent_id" class="block text-sm font-medium text-gray-700 mb-2">Assign Agent</label>
                        <select 
                            id="assigned_agent_id" 
                            name="assigned_agent_id" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                            <option value="">Select Agent</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="sla_deadline" class="block text-sm font-medium text-gray-700 mb-2">SLA Deadline</label>
                        <input 
                            type="datetime-local" 
                            id="sla_deadline" 
                            name="sla_deadline" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                    </div>
                </div>
            </div>

            <!-- Resolution -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4">Resolution</h3>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="resolution_notes" class="block text-sm font-medium text-gray-700 mb-2">Resolution Notes</label>
                        <textarea 
                            id="resolution_notes" 
                            name="resolution_notes" 
                            rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Add notes about how the issue was resolved..."
                        ></textarea>
                    </div>
                    
                    <div>
                        <label for="resolution_time" class="block text-sm font-medium text-gray-700 mb-2">Resolution Time (minutes)</label>
                        <input 
                            type="number" 
                            id="resolution_time" 
                            name="resolution_time" 
                            min="0"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Time taken to resolve in minutes"
                        >
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <button 
                    type="button" 
                    onclick="window.location.href='{{ route('tickets.show', $id) }}'"
                    class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors"
                >
                    Cancel
                </button>
                <button 
                    type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors"
                >
                    <i class="fas fa-save mr-2"></i>
                    Update Ticket
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadTicketData();
    loadAgents();
    
    const form = document.getElementById('ticket-edit-form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        updateTicket();
    });
});

function loadTicketData() {
    const ticketId = window.location.pathname.split('/')[2];
    
    fetch(`/api/tickets/${ticketId}`)
        .then(response => response.json())
        .then(ticket => {
            // Populate form fields
            document.getElementById('subject').value = ticket.subject || '';
            document.getElementById('priority').value = ticket.priority || '';
            document.getElementById('status').value = ticket.status || '';
            document.getElementById('category').value = ticket.category || '';
            document.getElementById('subcategory').value = ticket.subcategory || '';
            document.getElementById('source').value = ticket.source || '';
            document.getElementById('description').value = ticket.description || '';
            document.getElementById('assigned_agent_id').value = ticket.assigned_agent_id || '';
            document.getElementById('resolution_notes').value = ticket.resolution_notes || '';
            document.getElementById('resolution_time').value = ticket.resolution_time || '';
            
            // Format datetime for input
            if (ticket.sla_deadline) {
                const deadline = new Date(ticket.sla_deadline);
                const formatted = deadline.toISOString().slice(0, 16);
                document.getElementById('sla_deadline').value = formatted;
            }
        })
        .catch(error => {
            console.error('Error loading ticket data:', error);
            showNotification('Failed to load ticket data. Please try again.', 'error');
        });
}

function loadAgents() {
    fetch('/api/agents')
        .then(response => response.json())
        .then(data => {
            const agents = data.data || data;
            const select = document.getElementById('assigned_agent_id');
            
            agents.forEach(agent => {
                const option = document.createElement('option');
                option.value = agent.id;
                option.textContent = `${agent.name} - ${agent.department}`;
                select.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error loading agents:', error);
        });
}

function updateTicket() {
    const ticketId = window.location.pathname.split('/')[2];
    const form = document.getElementById('ticket-edit-form');
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());
    
    // Remove empty values
    Object.keys(data).forEach(key => {
        if (data[key] === '') {
            delete data[key];
        }
    });
    
    // Show loading state
    const submitBtn = document.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Updating...';
    submitBtn.disabled = true;
    
    fetch(`/api/tickets/${ticketId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.message) {
            showNotification('Ticket updated successfully!', 'success');
            
            // Redirect to ticket details
            setTimeout(() => {
                window.location.href = `/tickets/${ticketId}`;
            }, 1500);
        } else {
            throw new Error('Failed to update ticket');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Failed to update ticket. Please try again.', 'error');
        
        // Reset button state
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
}

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
        type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    }`;
    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-2"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
</script>
@endpush
@endsection
