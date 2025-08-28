@extends('layouts.app')

@section('title', 'About Us - Corisindo AI')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-blue-900 via-purple-900 to-indigo-900 py-32">
    <!-- Animated Background -->
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-purple-600/20"></div>
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-20 left-10 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute top-40 right-20 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute bottom-20 left-1/3 w-80 h-80 bg-indigo-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
        </div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="animate-fade-in-up">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">
                About <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">Corisindo AI</span>
            </h1>
            <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
                Pioneering the future of customer service through artificial intelligence and big data optimization
            </p>
        </div>
    </div>
</div>

<!-- Company Story Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="animate-slide-in-left">
                <div class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium mb-6">
                    <i class="fas fa-history mr-2"></i>
                    Our Story
                </div>
                <h2 class="text-4xl font-bold text-gray-900 mb-6">
                    Revolutionizing Customer Service Since 2025
                </h2>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    Corisindo AI was born from a vision to transform how businesses handle customer support. 
                    We recognized that traditional customer service methods were becoming outdated and inefficient 
                    in our fast-paced digital world.
                </p>
                <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                    By combining cutting-edge artificial intelligence with big data analytics, we've created 
                    a platform that not only responds to customer needs but anticipates them, ensuring 
                    every interaction is meaningful and efficient.
                </p>
                
                <div class="grid grid-cols-2 gap-6">
                    <div class="text-center p-4 bg-blue-50 rounded-xl">
                        <div class="text-3xl font-bold text-blue-600 mb-2">2025</div>
                        <div class="text-sm text-gray-600">Founded</div>
                    </div>
                    <div class="text-center p-4 bg-purple-50 rounded-xl">
                        <div class="text-3xl font-bold text-purple-600 mb-2">100+</div>
                        <div class="text-sm text-gray-600">Happy Clients</div>
                    </div>
                </div>
            </div>
            
            <div class="animate-slide-in-right">
                <div class="relative">
                    <div class="bg-gradient-to-br from-blue-500 to-purple-600 rounded-3xl p-8 shadow-2xl">
                        <div class="text-white text-center">
                            <i class="fas fa-rocket text-6xl mb-6"></i>
                            <h3 class="text-2xl font-bold mb-4">Our Mission</h3>
                            <p class="text-blue-100 leading-relaxed">
                                To democratize AI-powered customer service, making advanced technology 
                                accessible to businesses of all sizes while delivering exceptional 
                                customer experiences.
                            </p>
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

<!-- Values Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 animate-fade-in-up">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Core Values</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                The principles that guide everything we do at Corisindo AI
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-lightbulb text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Innovation First</h3>
                <p class="text-gray-600">
                    We constantly push the boundaries of what's possible with AI and machine learning, 
                    always seeking new ways to improve customer experiences.
                </p>
            </div>
            
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.4s;">
                <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-users text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Customer-Centric</h3>
                <p class="text-gray-600">
                    Every decision we make is driven by our commitment to delivering exceptional 
                    value and experiences to our customers and their end-users.
                </p>
            </div>
            
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.6s;">
                <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-shield-alt text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Trust & Security</h3>
                <p class="text-gray-600">
                    We maintain the highest standards of data security and privacy, ensuring 
                    our customers can trust us with their most sensitive information.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 animate-fade-in-up">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Meet Our Team</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                The brilliant minds behind Corisindo AI's innovative solutions
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Team Member 1 -->
            <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="relative mb-6">
                    <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-blue-500 shadow-lg group-hover:border-purple-500 transition-colors duration-300">
                        <img src="https://ui-avatars.com/api/?name=Sarah+Johnson&background=4F46E5&color=fff&size=400" alt="Sarah Johnson" class="w-full h-full object-cover">
                    </div>
                    <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2">
                        <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-1 rounded-full text-sm font-medium">
                            CEO & Founder
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Sarah Johnson</h3>
                    <p class="text-gray-600 mb-4">AI & Machine Learning Expert</p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="text-blue-500 hover:text-blue-600 transition-colors">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-blue-500 hover:text-blue-600 transition-colors">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Team Member 2 -->
            <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.4s;">
                <div class="relative mb-6">
                    <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-purple-500 shadow-lg group-hover:border-pink-500 transition-colors duration-300">
                        <img src="https://ui-avatars.com/api/?name=Michael+Chen&background=7C3AED&color=fff&size=400" alt="Michael Chen" class="w-full h-full object-cover">
                    </div>
                    <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2">
                        <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-4 py-1 rounded-full text-sm font-medium">
                            CTO
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Michael Chen</h3>
                    <p class="text-gray-600 mb-4">Full Stack Developer</p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="text-purple-500 hover:text-purple-600 transition-colors">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-purple-500 hover:text-purple-600 transition-colors">
                            <i class="fab fa-github text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Team Member 3 -->
            <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 0.6s;">
                <div class="relative mb-6">
                    <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-green-500 shadow-lg group-hover:border-blue-500 transition-colors duration-300">
                        <img src="https://ui-avatars.com/api/?name=Emily+Rodriguez&background=10B981&color=fff&size=400" alt="Emily Rodriguez" class="w-full h-full object-cover">
                    </div>
                    <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2">
                        <div class="bg-gradient-to-r from-green-600 to-blue-600 text-white px-4 py-1 rounded-full text-sm font-medium">
                            Head of Design
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Emily Rodriguez</h3>
                    <p class="text-gray-600 mb-4">UI/UX Designer</p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="text-green-500 hover:text-green-600 transition-colors">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-green-500 hover:text-green-600 transition-colors">
                            <i class="fab fa-dribbble text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-in-up">
            <h2 class="text-4xl font-bold text-white mb-6">
                Ready to Transform Your Customer Service?
            </h2>
            <p class="text-xl text-blue-100 mb-8">
                Join hundreds of businesses already using Corisindo AI to deliver exceptional customer experiences.
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-4 rounded-xl text-lg font-semibold hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-rocket mr-2"></i>
                    Get Started Today
                </a>
                <a href="{{ route('contact') }}" class="border-2 border-white text-white px-8 py-4 rounded-xl text-lg font-semibold hover:bg-white hover:text-blue-600 transition-all duration-300">
                    <i class="fas fa-phone mr-2"></i>
                    Contact Sales
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
    
    @keyframes slide-in-left {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes slide-in-right {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out forwards;
    }
    
    .animate-slide-in-left {
        animation: slide-in-left 0.8s ease-out forwards;
    }
    
    .animate-slide-in-right {
        animation: slide-in-right 0.8s ease-out forwards;
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
