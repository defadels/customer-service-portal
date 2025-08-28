@extends('layouts.app')

@section('title', 'Customer Details - Customer Service Portal')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Page Header -->
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">
                    <i class="fas fa-user text-blue-600 mr-3"></i>
                    Customer Details
                </h2>
                <p class="text-gray-600">View customer information and history.</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('customers.edit', $id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Customer
                </a>
                <a href="{{ route('customers.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to List
                </a>
            </div>
        </div>
    </div>

    <!-- Customer Information -->
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Customer Information</h3>
        <div id="customer-info" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Loading state -->
            <div class="col-span-2 text-center py-8">
                <i class="fas fa-spinner fa-spin text-2xl text-blue-600 mb-4"></i>
                <p class="text-gray-600">Loading customer information...</p>
            </div>
        </div>
    </div>

    <!-- Customer Tickets -->
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Customer Tickets</h3>
        <div id="customer-tickets">
            <!-- Loading state -->
            <div class="text-center py-8">
                <i class="fas fa-spinner fa-spin text-2xl text-blue-600 mb-4"></i>
                <p class="text-gray-600">Loading tickets...</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadCustomerInfo();
    loadCustomerTickets();
});

function loadCustomerInfo() {
    fetch(`/api/customers/${customerId}`)
        .then(response => response.json())
        .then(customer => {
            const customerInfo = document.getElementById('customer-info');
            customerInfo.innerHTML = `
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <p class="text-lg text-gray-900">${customer.name}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <p class="text-lg text-gray-900">${customer.email}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <p class="text-lg text-gray-900">${customer.phone || 'Not provided'}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Customer Type</label>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        ${customer.customer_type}
                    </span>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                        customer.status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                    }">
                        ${customer.status}
                    </span>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                    <p class="text-lg text-gray-900">${customer.date_of_birth || 'Not provided'}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                    <p class="text-lg text-gray-900">${customer.gender || 'Not specified'}</p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <p class="text-lg text-gray-900">${customer.address || 'Not provided'}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                    <p class="text-lg text-gray-900">${customer.city || 'Not provided'}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">State/Province</label>
                    <p class="text-lg text-gray-900">${customer.state || 'Not provided'}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Postal Code</label>
                    <p class="text-lg text-gray-900">${customer.postal_code || 'Not provided'}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                    <p class="text-lg text-gray-900">${customer.country || 'Not provided'}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Communication Preference</label>
                    <p class="text-lg text-gray-900">${customer.communication_preference || 'Not specified'}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Language Preference</label>
                    <p class="text-lg text-gray-900">${customer.language_preference || 'Not specified'}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Timezone</label>
                    <p class="text-lg text-gray-900">${customer.timezone || 'Not specified'}</p>
                </div>
            `;
        })
        .catch(error => {
            console.error('Error loading customer info:', error);
            document.getElementById('customer-info').innerHTML = `
                <div class="col-span-2 text-center py-8">
                    <i class="fas fa-exclamation-triangle text-2xl text-red-600 mb-4"></i>
                    <p class="text-red-600">Failed to load customer information</p>
                </div>
            `;
        });
}

function loadCustomerTickets() {
    fetch(`/api/customers/${customerId}/tickets`)
        .then(response => response.json())
        .then(tickets => {
            if (tickets.length === 0) {
                document.getElementById('customer-tickets').innerHTML = `
                    <div class="text-center py-8">
                        <i class="fas fa-ticket-alt text-2xl text-gray-400 mb-4"></i>
                        <p class="text-gray-600">No tickets found for this customer</p>
                    </div>
                `;
                return;
            }

            const ticketsHtml = tickets.map(ticket => `
                <div class="border border-gray-200 rounded-lg p-4 mb-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-lg font-medium text-gray-900">${ticket.subject}</h4>
                            <p class="text-sm text-gray-600">Ticket #${ticket.ticket_number}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                                ticket.priority === 'High' || ticket.priority === 'Urgent' || ticket.priority === 'Critical' 
                                ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800'
                            }">
                                ${ticket.priority}
                            </span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                                ticket.status === 'Open' ? 'bg-blue-100 text-blue-800' :
                                ticket.status === 'In Progress' ? 'bg-yellow-100 text-yellow-800' :
                                ticket.status === 'Resolved' ? 'bg-green-100 text-green-800' :
                                'bg-gray-100 text-gray-800'
                            }">
                                ${ticket.status}
                            </span>
                        </div>
                    </div>
                    <p class="text-gray-700 mt-2">${ticket.description}</p>
                    <div class="mt-3 text-sm text-gray-500">
                        Created: ${new Date(ticket.created_at).toLocaleDateString()}
                        ${ticket.assigned_agent ? `| Assigned to: ${ticket.assigned_agent.name}` : ''}
                    </div>
                </div>
            `).join('');

            document.getElementById('customer-tickets').innerHTML = ticketsHtml;
        })
        .catch(error => {
            console.error('Error loading tickets:', error);
            document.getElementById('customer-tickets').innerHTML = `
                <div class="text-center py-8">
                    <i class="fas fa-exclamation-triangle text-2xl text-red-600 mb-4"></i>
                    <p class="text-red-600">Failed to load tickets</p>
                </div>
            `;
        });
}

// Get customer ID from URL
const customerId = window.location.pathname.split('/').pop();
</script>
@endpush
@endsection
