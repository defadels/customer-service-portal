@extends('layouts.app')

@section('title', 'Agent Details - Customer Service Portal')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Page Header -->
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">
                    <i class="fas fa-user-tie text-blue-600 mr-3"></i>
                    Agent Details
                </h2>
                <p class="text-gray-600">View agent information and performance metrics.</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('agents.edit', $id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Agent
                </a>
                <a href="{{ route('agents.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to List
                </a>
            </div>
        </div>
    </div>

    <!-- Agent Information -->
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Agent Information</h3>
        <div id="agent-info" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Loading state -->
            <div class="col-span-2 text-center py-8">
                <i class="fas fa-spinner fa-spin text-2xl text-blue-600 mb-4"></i>
                <p class="text-gray-600">Loading agent information...</p>
            </div>
        </div>
    </div>

    <!-- Performance Metrics -->
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Performance Metrics</h3>
        <div id="agent-metrics" class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Loading state -->
            <div class="col-span-3 text-center py-8">
                <i class="fas fa-spinner fa-spin text-2xl text-blue-600 mb-4"></i>
                <p class="text-gray-600">Loading performance metrics...</p>
            </div>
        </div>
    </div>

    <!-- Assigned Tickets -->
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Assigned Tickets</h3>
        <div id="agent-tickets">
            <!-- Loading state -->
            <div class="text-center py-8">
                <i class="fas fa-spinner fa-spin text-2xl text-blue-600 mb-4"></i>
                <p class="text-gray-600">Loading assigned tickets...</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadAgentInfo();
    loadAgentMetrics();
    loadAgentTickets();
});

function loadAgentInfo() {
    const agentId = window.location.pathname.split('/').pop();
    
    fetch(`/api/agents/${agentId}`)
        .then(response => response.json())
        .then(agent => {
            const agentInfo = document.getElementById('agent-info');
            agentInfo.innerHTML = `
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <p class="text-lg text-gray-900">${agent.name}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <p class="text-lg text-gray-900">${agent.email}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <p class="text-lg text-gray-900">${agent.phone || 'Not provided'}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        ${agent.department}
                    </span>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                        agent.status === 'Active' ? 'bg-green-100 text-green-800' : 
                        agent.status === 'Training' ? 'bg-yellow-100 text-yellow-800' :
                        agent.status === 'On Leave' ? 'bg-orange-100 text-orange-800' :
                        'bg-red-100 text-red-800'
                    }">
                        ${agent.status}
                    </span>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Expertise Level</label>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                        agent.expertise_level === 'Expert' ? 'bg-purple-100 text-purple-800' :
                        agent.expertise_level === 'Senior' ? 'bg-blue-100 text-blue-800' :
                        agent.expertise_level === 'Intermediate' ? 'bg-green-100 text-green-800' :
                        'bg-gray-100 text-gray-800'
                    }">
                        ${agent.expertise_level}
                    </span>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Max Concurrent Tickets</label>
                    <p class="text-lg text-gray-900">${agent.max_tickets || 'Not set'}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">SLA Target</label>
                    <p class="text-lg text-gray-900">${agent.sla_target || 'Not set'} hours</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Availability</label>
                    <p class="text-lg text-gray-900">${agent.availability || 'Not specified'}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Created</label>
                    <p class="text-lg text-gray-900">${new Date(agent.created_at).toLocaleDateString()}</p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Skills</label>
                    <div class="flex flex-wrap gap-2">
                        ${agent.skills && agent.skills.length > 0 ? 
                            agent.skills.map(skill => 
                                `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">${skill}</span>`
                            ).join('') : 
                            '<span class="text-gray-500">No skills specified</span>'
                        }
                    </div>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Languages</label>
                    <div class="flex flex-wrap gap-2">
                        ${agent.languages && agent.languages.length > 0 ? 
                            agent.languages.map(lang => 
                                `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">${lang}</span>`
                            ).join('') : 
                            '<span class="text-gray-500">No languages specified</span>'
                        }
                    </div>
                </div>
            `;
        })
        .catch(error => {
            console.error('Error loading agent info:', error);
            document.getElementById('agent-info').innerHTML = `
                <div class="col-span-2 text-center py-8">
                    <i class="fas fa-exclamation-triangle text-2xl text-red-600 mb-4"></i>
                    <p class="text-red-600">Failed to load agent information</p>
                </div>
            `;
        });
}

function loadAgentMetrics() {
    const agentId = window.location.pathname.split('/').pop();
    
    fetch(`/api/agents/${agentId}/metrics`)
        .then(response => response.json())
        .then(metrics => {
            const metricsDiv = document.getElementById('agent-metrics');
            metricsDiv.innerHTML = `
                <div class="text-center p-6 bg-blue-50 rounded-lg">
                    <div class="text-3xl font-bold text-blue-600 mb-2">${metrics.total_tickets || 0}</div>
                    <div class="text-sm text-gray-600">Total Tickets</div>
                </div>
                <div class="text-center p-6 bg-green-50 rounded-lg">
                    <div class="text-3xl font-bold text-green-600 mb-2">${metrics.resolved_tickets || 0}</div>
                    <div class="text-sm text-gray-600">Resolved Tickets</div>
                </div>
                <div class="text-center p-6 bg-purple-50 rounded-lg">
                    <div class="text-3xl font-bold text-purple-600 mb-2">${metrics.avg_resolution_time || 0}h</div>
                    <div class="text-sm text-gray-600">Avg Resolution Time</div>
                </div>
                <div class="text-center p-6 bg-yellow-50 rounded-lg">
                    <div class="text-3xl font-bold text-yellow-600 mb-2">${metrics.customer_satisfaction || 0}%</div>
                    <div class="text-sm text-gray-600">Customer Satisfaction</div>
                </div>
                <div class="text-center p-6 bg-indigo-50 rounded-lg">
                    <div class="text-3xl font-bold text-indigo-600 mb-2">${metrics.active_tickets || 0}</div>
                    <div class="text-sm text-gray-600">Active Tickets</div>
                </div>
                <div class="text-center p-6 bg-red-50 rounded-lg">
                    <div class="text-3xl font-bold text-red-600 mb-2">${metrics.overdue_tickets || 0}</div>
                    <div class="text-sm text-gray-600">Overdue Tickets</div>
                </div>
            `;
        })
        .catch(error => {
            console.error('Error loading agent metrics:', error);
            document.getElementById('agent-metrics').innerHTML = `
                <div class="col-span-3 text-center py-8">
                    <i class="fas fa-exclamation-triangle text-2xl text-red-600 mb-4"></i>
                    <p class="text-red-600">Failed to load performance metrics</p>
                </div>
            `;
        });
}

function loadAgentTickets() {
    const agentId = window.location.pathname.split('/').pop();
    
    fetch(`/api/agents/${agentId}/tickets`)
        .then(response => response.json())
        .then(tickets => {
            if (tickets.length === 0) {
                document.getElementById('agent-tickets').innerHTML = `
                    <div class="text-center py-8">
                        <i class="fas fa-ticket-alt text-2xl text-gray-400 mb-4"></i>
                        <p class="text-gray-600">No tickets assigned to this agent</p>
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
                        Customer: ${ticket.customer ? ticket.customer.name : 'Unknown'} | 
                        Created: ${new Date(ticket.created_at).toLocaleDateString()}
                    </div>
                </div>
            `).join('');

            document.getElementById('agent-tickets').innerHTML = ticketsHtml;
        })
        .catch(error => {
            console.error('Error loading agent tickets:', error);
            document.getElementById('agent-tickets').innerHTML = `
                <div class="text-center py-8">
                    <i class="fas fa-exclamation-triangle text-2xl text-red-600 mb-4"></i>
                    <p class="text-red-600">Failed to load assigned tickets</p>
                </div>
            `;
        });
}
</script>
@endpush
@endsection
