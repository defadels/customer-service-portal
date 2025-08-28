@extends('layouts.app')

@section('title', 'Create Ticket - Customer Service Portal')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Page Header -->
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">
                    <i class="fas fa-plus text-green-600 mr-3"></i>
                    Create New Ticket
                </h2>
                <p class="text-gray-600">Create a new support ticket for customer service.</p>
            </div>
            <a href="{{ route('tickets.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to List
            </a>
        </div>
    </div>

    <!-- Ticket Form -->
    <div class="bg-white shadow rounded-lg p-6">
        <form id="ticket-form" class="space-y-6">
            @csrf
            
            <!-- Customer Selection -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4">Customer Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="customer_id" class="block text-sm font-medium text-gray-700 mb-2">Customer *</label>
                        <select 
                            id="customer_id" 
                            name="customer_id" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                            <option value="">Select Customer</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-2">Customer Email</label>
                        <input 
                            type="email" 
                            id="customer_email" 
                            readonly
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-500"
                            placeholder="Will be auto-filled"
                        >
                    </div>
                </div>
            </div>

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
                            <option value="">Auto-assign (Recommended)</option>
                        </select>
                        <p class="text-sm text-gray-500 mt-1">Leave empty for AI auto-assignment</p>
                    </div>
                    
                    <div>
                        <label for="sla_deadline" class="block text-sm font-medium text-gray-700 mb-2">SLA Deadline</label>
                        <input 
                            type="datetime-local" 
                            id="sla_deadline" 
                            name="sla_deadline" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                        <p class="text-sm text-gray-500 mt-1">Optional custom deadline</p>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <button 
                    type="button" 
                    onclick="window.location.href='{{ route('tickets.index') }}'"
                    class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors"
                >
                    Cancel
                </button>
                <button 
                    type="submit"
                    class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors"
                >
                    <i class="fas fa-plus mr-2"></i>
                    Create Ticket
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadCustomers();
    loadAgents();
    
    const form = document.getElementById('ticket-form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        createTicket();
    });
    
    // Auto-fill customer email when customer is selected
    document.getElementById('customer_id').addEventListener('change', function() {
        const customerId = this.value;
        if (customerId) {
            const customer = customers.find(c => c.id == customerId);
            if (customer) {
                document.getElementById('customer_email').value = customer.email;
            }
        } else {
            document.getElementById('customer_email').value = '';
        }
    });
});

let customers = [];
let agents = [];

function loadCustomers() {
    fetch('/api/customers')
        .then(response => response.json())
        .then(data => {
            customers = data.data || data;
            const select = document.getElementById('customer_id');
            
            customers.forEach(customer => {
                const option = document.createElement('option');
                option.value = customer.id;
                option.textContent = `${customer.name} (${customer.email})`;
                select.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error loading customers:', error);
        });
}

function loadAgents() {
    fetch('/api/agents')
        .then(response => response.json())
        .then(data => {
            agents = data.data || data;
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

function createTicket() {
    const form = document.getElementById('ticket-form');
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
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating...';
    submitBtn.disabled = true;
    
    fetch('/api/tickets', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.message) {
            showNotification('Ticket created successfully!', 'success');
            
            // Redirect to ticket list
            setTimeout(() => {
                window.location.href = '/tickets';
            }, 1500);
        } else {
            throw new Error('Failed to create ticket');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Failed to create ticket. Please try again.', 'error');
        
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
