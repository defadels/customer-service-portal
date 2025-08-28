@extends('layouts.app')

@section('title', 'Our Services - Corisindo AI')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-900 py-32">
    <!-- Animated Background -->
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-600/20 to-pink-600/20"></div>
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-20 left-10 w-72 h-72 bg-indigo-500/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute top-40 right-20 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute bottom-20 left-1/3 w-80 h-80 bg-pink-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
        </div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="animate-fade-in-up">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">
                Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-pink-400">Services</span>
            </h1>
            <p class="text-xl md:text-2xl text-indigo-100 max-w-3xl mx-auto leading-relaxed">
                Comprehensive AI-powered solutions designed to revolutionize your customer service operations
            </p>
        </div>
    </div>
</div>

<!-- Main Services Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 animate-fade-in-up">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Core Services</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Discover how our AI-powered platform can transform your customer service experience
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- AI Chat Assistant -->
            <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.1s;">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-robot text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">AI Chat Assistant</h3>
                <p class="text-gray-600 mb-4">
                    24/7 intelligent chatbot that understands customer intent, provides instant responses, 
                    and escalates complex issues to human agents.
                </p>
                <ul class="text-sm text-gray-500 space-y-2 mb-6">
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Natural Language Processing</li>
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Multi-language Support</li>
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Context Awareness</li>
                </ul>
                <div class="text-blue-600 font-semibold group-hover:text-blue-700 transition-colors">
                    Learn More <i class="fas fa-arrow-right ml-1 group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>
            
            <!-- Intelligent Ticket Routing -->
            <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-route text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Smart Ticket Routing</h3>
                <p class="text-gray-600 mb-4">
                    AI-powered system that automatically categorizes, prioritizes, and routes tickets 
                    to the most qualified agents based on skills and workload.
                </p>
                <ul class="text-sm text-gray-500 space-y-2 mb-6">
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Automatic Categorization</li>
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Priority Detection</li>
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Load Balancing</li>
                </ul>
                <div class="text-purple-600 font-semibold group-hover:text-purple-700 transition-colors">
                    Learn More <i class="fas fa-arrow-right ml-1 group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>
            
            <!-- Sentiment Analysis -->
            <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.3s;">
                <div class="w-16 h-16 bg-gradient-to-r from-pink-500 to-pink-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-heart text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Sentiment Analysis</h3>
                <p class="text-gray-600 mb-4">
                    Real-time emotion detection and sentiment tracking to understand customer mood 
                    and provide appropriate responses and escalation.
                </p>
                <ul class="text-sm text-gray-500 space-y-2 mb-6">
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Emotion Detection</li>
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Mood Tracking</li>
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Proactive Alerts</li>
                </ul>
                <div class="text-pink-600 font-semibold group-hover:text-pink-700 transition-colors">
                    Learn More <i class="fas fa-arrow-right ml-1 group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>
            
            <!-- Performance Analytics -->
            <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.4s;">
                <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-chart-line text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Performance Analytics</h3>
                <p class="text-gray-600 mb-4">
                    Comprehensive dashboards and reports providing insights into team performance, 
                    customer satisfaction, and operational efficiency.
                </p>
                <ul class="text-sm text-gray-500 space-y-2 mb-6">
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Real-time Metrics</li>
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Trend Analysis</li>
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Custom Reports</li>
                </ul>
                <div class="text-green-600 font-semibold group-hover:text-green-700 transition-colors">
                    Learn More <i class="fas fa-arrow-right ml-1 group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>
            
            <!-- Predictive Insights -->
            <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.5s;">
                <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-crystal-ball text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Predictive Insights</h3>
                <p class="text-gray-600 mb-4">
                    Machine learning algorithms that predict customer behavior, ticket volume, 
                    and resource requirements to optimize operations.
                </p>
                <ul class="text-sm text-gray-500 space-y-2 mb-6">
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Volume Forecasting</li>
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Behavior Prediction</li>
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Resource Planning</li>
                </ul>
                <div class="text-indigo-600 font-semibold group-hover:text-indigo-700 transition-colors">
                    Learn More <i class="fas fa-arrow-right ml-1 group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>
            
            <!-- Integration Services -->
            <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.6s;">
                <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-plug text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Seamless Integration</h3>
                <p class="text-gray-600 mb-4">
                    Easy integration with your existing CRM, helpdesk, and communication tools 
                    through our comprehensive API and webhook system.
                </p>
                <ul class="text-sm text-gray-500 space-y-2 mb-6">
                    <li><i class="fas fa-check text-green-500 mr-2"></i>REST API</li>
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Webhook Support</li>
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Custom Connectors</li>
                </ul>
                <div class="text-orange-600 font-semibold group-hover:text-orange-700 transition-colors">
                    Learn More <i class="fas fa-arrow-right ml-1 group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 animate-fade-in-up">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Simple, Transparent Pricing</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Choose the plan that best fits your business needs. All plans include our core AI features.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Starter Plan -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Starter</h3>
                    <div class="text-4xl font-bold text-blue-600 mb-2">$49</div>
                    <div class="text-gray-600">per month</div>
                </div>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i>Up to 1,000 tickets/month</li>
                    <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i>AI Chat Assistant</li>
                    <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i>Basic Analytics</li>
                    <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i>Email Support</li>
                </ul>
                <button class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition-colors">
                    Get Started
                </button>
            </div>
            
            <!-- Professional Plan -->
            <div class="bg-white rounded-2xl p-8 shadow-xl border-2 border-blue-500 transform scale-105 animate-fade-in-up" style="animation-delay: 0.4s;">
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                    <span class="bg-blue-500 text-white px-4 py-2 rounded-full text-sm font-medium">Most Popular</span>
                </div>
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Professional</h3>
                    <div class="text-4xl font-bold text-blue-600 mb-2">$99</div>
                    <div class="text-gray-600">per month</div>
                </div>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i>Up to 10,000 tickets/month</li>
                    <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i>All Starter Features</li>
                    <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i>Advanced Analytics</li>
                    <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i>Priority Support</li>
                    <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i>Custom Integrations</li>
                </ul>
                <button class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition-colors">
                    Get Started
                </button>
            </div>
            
            <!-- Enterprise Plan -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.6s;">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Enterprise</h3>
                    <div class="text-4xl font-bold text-blue-600 mb-2">Custom</div>
                    <div class="text-gray-600">contact sales</div>
                </div>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i>Unlimited tickets</li>
                    <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i>All Professional Features</li>
                    <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i>Custom AI Models</li>
                    <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i>Dedicated Support</li>
                    <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i>SLA Guarantees</li>
                </ul>
                <button class="w-full bg-gray-600 text-white py-3 rounded-xl font-semibold hover:bg-gray-700 transition-colors">
                    Contact Sales
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Features Comparison -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 animate-fade-in-up">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Feature Comparison</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                See how our different plans stack up against each other
            </p>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="border-b-2 border-gray-200">
                        <th class="text-left py-4 px-6 font-semibold text-gray-900">Feature</th>
                        <th class="text-center py-4 px-6 font-semibold text-gray-900">Starter</th>
                        <th class="text-center py-4 px-6 font-semibold text-blue-600">Professional</th>
                        <th class="text-center py-4 px-6 font-semibold text-gray-900">Enterprise</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 font-medium text-gray-900">AI Chat Assistant</td>
                        <td class="py-4 px-6 text-center"><i class="fas fa-check text-green-500"></i></td>
                        <td class="py-4 px-6 text-center"><i class="fas fa-check text-green-500"></i></td>
                        <td class="py-4 px-6 text-center"><i class="fas fa-check text-green-500"></i></td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 font-medium text-gray-900">Smart Routing</td>
                        <td class="py-4 px-6 text-center"><i class="fas fa-check text-green-500"></i></td>
                        <td class="py-4 px-6 text-center"><i class="fas fa-check text-green-500"></i></td>
                        <td class="py-4 px-6 text-center"><i class="fas fa-check text-green-500"></i></td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 font-medium text-gray-900">Sentiment Analysis</td>
                        <td class="py-4 px-6 text-center"><i class="fas fa-times text-red-500"></i></td>
                        <td class="py-4 px-6 text-center"><i class="fas fa-check text-green-500"></i></td>
                        <td class="py-4 px-6 text-center"><i class="fas fa-check text-green-500"></i></td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 font-medium text-gray-900">Advanced Analytics</td>
                        <td class="py-4 px-6 text-center"><i class="fas fa-times text-red-500"></i></td>
                        <td class="py-4 px-6 text-center"><i class="fas fa-check text-green-500"></i></td>
                        <td class="py-4 px-6 text-center"><i class="fas fa-check text-green-500"></i></td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 font-medium text-gray-900">Custom AI Models</td>
                        <td class="py-4 px-6 text-center"><i class="fas fa-times text-red-500"></i></td>
                        <td class="py-4 px-6 text-center"><i class="fas fa-times text-red-500"></i></td>
                        <td class="py-4 px-6 text-center"><i class="fas fa-check text-green-500"></i></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-in-up">
            <h2 class="text-4xl font-bold text-white mb-6">
                Ready to Get Started?
            </h2>
            <p class="text-xl text-indigo-100 mb-8">
                Join thousands of businesses already using Corisindo AI to transform their customer service.
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('register') }}" class="bg-white text-indigo-600 px-8 py-4 rounded-xl text-lg font-semibold hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-rocket mr-2"></i>
                    Start Free Trial
                </a>
                <a href="{{ route('contact') }}" class="border-2 border-white text-white px-8 py-4 rounded-xl text-lg font-semibold hover:bg-white hover:text-indigo-600 transition-all duration-300">
                    <i class="fas fa-phone mr-2"></i>
                    Schedule Demo
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out forwards;
    }
    
    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }
    
    .group:hover .group-hover\:translate-x-1 {
        transform: translateX(0.25rem);
    }
</style>
@endpush
