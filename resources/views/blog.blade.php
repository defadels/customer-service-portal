@extends('layouts.app')

@section('title', 'Blog & News - Corisindo AI')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-orange-900 via-red-900 to-pink-900 py-32">
    <!-- Animated Background -->
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-r from-orange-600/20 to-red-600/20"></div>
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-20 left-10 w-72 h-72 bg-orange-500/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute top-40 right-20 w-96 h-96 bg-red-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute bottom-20 left-1/3 w-80 h-80 bg-pink-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
        </div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="animate-fade-in-up">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">
                Blog & <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-red-400">News</span>
            </h1>
            <p class="text-xl md:text-2xl text-orange-100 max-w-3xl mx-auto leading-relaxed">
                Stay updated with the latest insights, trends, and innovations in AI-powered customer service
            </p>
        </div>
    </div>
</div>

<!-- Featured Article Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 animate-fade-in-up">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Featured Article</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Our latest insights on AI and customer service innovation
            </p>
        </div>
        
        <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-3xl p-8 md:p-12 shadow-2xl animate-fade-in-up" style="animation-delay: 0.2s;">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="inline-flex items-center px-4 py-2 bg-orange-100 text-orange-800 rounded-full text-sm font-medium mb-6">
                        <i class="fas fa-star mr-2"></i>
                        Featured
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-4">
                        The Future of Customer Service: How AI is Revolutionizing Support Operations
                    </h3>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                        Discover how artificial intelligence is transforming traditional customer service models, 
                        from automated responses to predictive analytics that anticipate customer needs before they arise.
                    </p>
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="flex items-center">
                            <img src="https://ui-avatars.com/api/?name=Sarah+Johnson&background=EA580C&color=fff&size=100" alt="Sarah Johnson" class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <div class="font-medium text-gray-900">Sarah Johnson</div>
                                <div class="text-sm text-gray-500">AI Research Lead</div>
                            </div>
                        </div>
                        <div class="text-sm text-gray-500">
                            <i class="fas fa-calendar mr-1"></i>
                            March 15, 2025
                        </div>
                    </div>
                    <a href="#" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-600 to-red-600 text-white rounded-xl font-semibold hover:from-orange-700 hover:to-red-700 transition-all duration-300 transform hover:scale-105">
                        Read Full Article
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                
                <div class="relative">
                    <div class="bg-white rounded-2xl p-6 shadow-lg">
                        <div class="text-center mb-4">
                            <i class="fas fa-robot text-6xl text-orange-500 mb-4"></i>
                            <h4 class="text-xl font-semibold text-gray-900">AI Insights</h4>
                        </div>
                        <div class="space-y-3 text-sm text-gray-600">
                            <div class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                Natural Language Processing
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                Sentiment Analysis
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                Predictive Analytics
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                Automated Routing
                            </div>
                        </div>
                    </div>
                    
                    <!-- Floating Elements -->
                    <div class="absolute -top-4 -right-4 w-20 h-20 bg-yellow-400 rounded-full animate-bounce" style="animation-delay: 0.5s;"></div>
                    <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-pink-400 rounded-full animate-bounce" style="animation-delay: 1s;"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest Articles Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 animate-fade-in-up">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Latest Articles</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Stay informed with our latest research, case studies, and industry insights
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Article 1 -->
            <article class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.1s;">
                <div class="relative">
                    <div class="h-48 bg-gradient-to-br from-blue-500 to-purple-600 rounded-t-2xl flex items-center justify-center">
                        <i class="fas fa-chart-line text-white text-4xl"></i>
                    </div>
                    <div class="absolute top-4 left-4">
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">Analytics</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">
                        Measuring Customer Satisfaction in the AI Era
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Learn how to effectively measure and improve customer satisfaction using AI-powered analytics 
                        and real-time feedback systems.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-calendar mr-2"></i>
                            March 12, 2025
                        </div>
                        <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Read More →</a>
                    </div>
                </div>
            </article>
            
            <!-- Article 2 -->
            <article class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="relative">
                    <div class="h-48 bg-gradient-to-br from-green-500 to-blue-600 rounded-t-2xl flex items-center justify-center">
                        <i class="fas fa-users text-white text-4xl"></i>
                    </div>
                    <div class="absolute top-4 left-4">
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Team</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">
                        Building High-Performance Support Teams with AI
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Discover strategies for building and managing high-performance customer support teams 
                        that leverage AI tools effectively.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-calendar mr-2"></i>
                            March 10, 2025
                        </div>
                        <a href="#" class="text-green-600 hover:text-green-700 font-medium">Read More →</a>
                    </div>
                </div>
            </article>
            
            <!-- Article 3 -->
            <article class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.3s;">
                <div class="relative">
                    <div class="h-48 bg-gradient-to-br from-purple-500 to-pink-600 rounded-t-2xl flex items-center justify-center">
                        <i class="fas fa-cogs text-white text-4xl"></i>
                    </div>
                    <div class="absolute top-4 left-4">
                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">Technology</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">
                        Integration Best Practices for AI Customer Service
                    </h3>
                    <p class="text-gray-600 mb-4">
                        A comprehensive guide to integrating AI-powered customer service solutions 
                        with your existing business systems and workflows.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-calendar mr-2"></i>
                            March 8, 2025
                        </div>
                        <a href="#" class="text-purple-600 hover:text-purple-700 font-medium">Read More →</a>
                    </div>
                </div>
            </article>
            
            <!-- Article 4 -->
            <article class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.4s;">
                <div class="relative">
                    <div class="h-48 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-t-2xl flex items-center justify-center">
                        <i class="fas fa-lightbulb text-white text-4xl"></i>
                    </div>
                    <div class="absolute top-4 left-4">
                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">Innovation</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">
                        Emerging Trends in Customer Service AI
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Explore the latest trends and innovations shaping the future of AI-powered 
                        customer service and support operations.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-calendar mr-2"></i>
                            March 5, 2025
                        </div>
                        <a href="#" class="text-yellow-600 hover:text-yellow-700 font-medium">Read More →</a>
                    </div>
                </div>
            </article>
            
            <!-- Article 5 -->
            <article class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.5s;">
                <div class="relative">
                    <div class="h-48 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-t-2xl flex items-center justify-center">
                        <i class="fas fa-shield-alt text-white text-4xl"></i>
                    </div>
                    <div class="absolute top-4 left-4">
                        <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-medium">Security</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">
                        Data Security in AI Customer Service
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Understanding the importance of data security and privacy when implementing 
                        AI-powered customer service solutions.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-calendar mr-2"></i>
                            March 3, 2025
                        </div>
                        <a href="#" class="text-indigo-600 hover:text-indigo-700 font-medium">Read More →</a>
                    </div>
                </div>
            </article>
            
            <!-- Article 6 -->
            <article class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.6s;">
                <div class="relative">
                    <div class="h-48 bg-gradient-to-br from-pink-500 to-red-600 rounded-t-2xl flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white text-4xl"></i>
                    </div>
                    <div class="absolute top-4 left-4">
                        <span class="bg-pink-100 text-pink-800 px-3 py-1 rounded-full text-sm font-medium">Education</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">
                        Training Your Team for AI Success
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Essential training programs and resources to help your team maximize the benefits 
                        of AI-powered customer service tools.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-calendar mr-2"></i>
                            March 1, 2025
                        </div>
                        <a href="#" class="text-pink-600 hover:text-pink-700 font-medium">Read More →</a>
                    </div>
                </div>
            </article>
        </div>
        
        <!-- Load More Button -->
        <div class="text-center mt-12 animate-fade-in-up" style="animation-delay: 0.7s;">
            <button class="bg-gradient-to-r from-orange-600 to-red-600 text-white px-8 py-4 rounded-xl font-semibold hover:from-orange-700 hover:to-red-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                <i class="fas fa-plus mr-2"></i>
                Load More Articles
            </button>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-20 bg-gradient-to-r from-orange-600 via-red-600 to-pink-600">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-in-up">
            <h2 class="text-4xl font-bold text-white mb-6">
                Stay Updated with Our Newsletter
            </h2>
            <p class="text-xl text-orange-100 mb-8">
                Get the latest insights, tips, and industry news delivered directly to your inbox
            </p>
            <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                <input type="email" placeholder="Enter your email" 
                       class="flex-1 px-6 py-4 rounded-xl text-gray-900 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50">
                <button type="submit" 
                        class="bg-white text-orange-600 px-8 py-4 rounded-xl font-semibold hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    Subscribe
                </button>
            </form>
            <p class="text-orange-100 text-sm mt-4">
                No spam, unsubscribe at any time. We respect your privacy.
            </p>
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
    
    .animate-bounce {
        animation: bounce 2s infinite;
    }
    
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
    }
</style>
@endpush
