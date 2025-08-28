@extends('layouts.app')

@section('title', 'Customers - Customer Service Portal')

@section('content')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-tachometer-alt text-blue-600 mr-3"></i>
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">
                                Welcome back, {{ Auth::user()->name }}! 👋
                            </h3>
                            <p class="text-gray-600">
                                You are logged in as a <span class="font-semibold text-blue-600">{{ ucfirst(Auth::user()->role) }}</span>
                                @if(Auth::user()->department)
                                    in the <span class="font-semibold text-green-600">{{ Auth::user()->department }}</span> department
                                @endif
                            </p>
                        </div>
                        <div class="text-right">
                            <div class="text-sm text-gray-500">Last login</div>
                            <div class="text-lg font-semibold text-gray-900">{{ now()->format('M d, Y H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-users text-blue-600 text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Total Customers</div>
                                <div class="text-2xl font-semibold text-gray-900" id="total-customers">-</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-ticket-alt text-green-600 text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Open Tickets</div>
                                <div class="text-2xl font-semibold text-gray-900" id="open-tickets">-</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-yellow-600 text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Resolved Today</div>
                                <div class="text-2xl font-semibold text-gray-900" id="resolved-today">-</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-user-tie text-purple-600 text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Active Agents</div>
                                <div class="text-2xl font-semibold text-gray-900" id="active-agents">-</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- AI Performance Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        <i class="fas fa-robot text-blue-600 mr-2"></i>
                        AI Performance Metrics
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-blue-600" id="ai-accuracy">-</div>
                            <div class="text-sm text-gray-500">Accuracy Rate</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-green-600" id="auto-resolution">-</div>
                            <div class="text-sm text-gray-500">Auto-Resolution</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-yellow-600" id="response-time">-</div>
                            <div class="text-sm text-gray-500">Avg Response (s)</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        <i class="fas fa-bolt text-yellow-600 mr-2"></i>
                        Quick Actions
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="{{ route('customers.create') }}" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                            <i class="fas fa-user-plus text-blue-600 text-xl mr-3"></i>
                            <span class="font-medium text-blue-900">Add Customer</span>
                        </a>

                        <a href="{{ route('tickets.create') }}" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                            <i class="fas fa-plus text-green-600 text-xl mr-3"></i>
                            <span class="font-medium text-green-900">Create Ticket</span>
                        </a>

                        <a href="{{ route('chat.index') }}" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                            <i class="fas fa-comments text-purple-600 text-xl mr-3"></i>
                            <span class="font-medium text-purple-900">Open Chat</span>
                        </a>

                        @if(auth()->user()->canManageAgents())
                        <a href="{{ route('agents.create') }}" class="flex items-center p-4 bg-orange-50 rounded-lg hover:bg-orange-100 transition-colors">
                            <i class="fas fa-user-tie text-orange-600 text-xl mr-3"></i>
                            <span class="font-medium text-orange-900">Add Agent</span>
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        <i class="fas fa-history text-gray-600 mr-2"></i>
                        Recent Activity
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-circle text-green-500 text-xs mr-3"></i>
                            <span>System initialized successfully</span>
                            <span class="ml-auto text-xs text-gray-400">{{ now()->format('M d, H:i') }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-circle text-blue-500 text-xs mr-3"></i>
                            <span>Database seeded with sample data</span>
                            <span class="ml-auto text-xs text-gray-400">{{ now()->subMinutes(5)->format('M d, H:i') }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-circle text-purple-500 text-xs mr-3"></i>
                            <span>AI service activated</span>
                            <span class="ml-auto text-xs text-gray-400">{{ now()->subMinutes(10)->format('M d, H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Load dashboard stats
        document.addEventListener('DOMContentLoaded', function() {
            loadDashboardStats();
            loadAIStats();
        });

        function loadDashboardStats() {
            fetch('/api/dashboard/stats')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('total-customers').textContent = data.total_customers || 0;
                    document.getElementById('open-tickets').textContent = data.open_tickets || 0;
                    document.getElementById('resolved-today').textContent = data.resolved_today || 0;
                    document.getElementById('active-agents').textContent = data.active_agents || 0;
                })
                .catch(error => {
                    console.error('Error loading dashboard stats:', error);
                });
        }

        function loadAIStats() {
            fetch('/api/ai/stats')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('ai-accuracy').textContent = (data.accuracy || 0) + '%';
                    document.getElementById('auto-resolution').textContent = (data.auto_resolution_rate || 0) + '%';
                    document.getElementById('response-time').textContent = (data.average_response_time || 0).toFixed(1);
                })
                .catch(error => {
                    console.error('Error loading AI stats:', error);
                });
        }
    </script>
    @endpush
@endsection
