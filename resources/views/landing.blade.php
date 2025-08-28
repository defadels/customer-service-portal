<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AI-Powered Customer Service Portal - CORISINDO 2025 Competition</title>
    <meta name="description" content="AI-Powered Customer Service Portal designed for CORISINDO 2025 Competition. Demonstrating AI and Big Data optimization in decision-making for customer support.">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #1e40af 0%, #7c3aed 50%, #ec4899 100%);
            position: relative;
            min-height: 100vh;
        }
        .gradient-text {
            background: linear-gradient(135deg, #1e40af 0%, #7c3aed 50%, #ec4899 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            position: relative;
            z-index: 1;
        }
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .bounce-in {
            animation: bounceIn 1s ease-out;
        }
        @keyframes bounceIn {
            0% { transform: scale(0.3); opacity: 0; }
            50% { transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); opacity: 1; }
        }
        .glow {
            box-shadow: 0 0 20px rgba(124, 58, 237, 0.3);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* Modern additions */
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .text-gradient {
            background: linear-gradient(to right, #1e40af, #7c3aed, #ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hover-lift {
            transition: transform 0.2s ease;
        }

        .hover-lift:hover {
            transform: translateY(-4px);
        }

        .nav-blur {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.8);
        }

        .card-shine {
            position: relative;
            overflow: hidden;
        }

        .card-shine::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                45deg,
                transparent,
                rgba(255, 255, 255, 0.1),
                transparent
            );
            transform: rotate(45deg);
            transition: 0.5s;
        }

        .card-shine:hover::before {
            left: 100%;
        }

        /* Hero section specific styles */
        .hero-section {
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            position: relative;
            z-index: 10;
        }

        .hero-visual {
            position: relative;
            z-index: 10;
        }

        .floating-card {
            animation: floating 4s ease-in-out infinite;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .decorative-bg {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
            z-index: 1;
        }

        .blur-circle {
            border-radius: 50%;
            filter: blur(40px);
            opacity: 0.6;
            animation: pulse 4s ease-in-out infinite alternate;
        }

        @keyframes pulse {
            0% { opacity: 0.3; transform: scale(1); }
            100% { opacity: 0.7; transform: scale(1.1); }
        }

        .text-shadow {
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .backdrop-card {
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Ensure hero section has proper background */
        .hero-bg {
            background: linear-gradient(135deg, #1e40af 0%, #7c3aed 50%, #ec4899 100%) !important;
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        /* Fallback background colors */
        .hero-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #1e40af 0%, #7c3aed 50%, #ec4899 100%);
            z-index: -1;
        }

        /* Ensure text is readable */
        .hero-bg .text-white {
            color: white !important;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-bg .text-blue-100 {
            color: #dbeafe !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-slate-50">
    <!-- Navigation -->
    <nav class="nav-blur fixed w-full z-50 border-b border-slate-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center hover-lift">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 rounded-xl flex items-center justify-center glow card-shine">
                        <i class="fas fa-brain text-white text-xl"></i>
                    </div>
                    <span class="ml-3 text-2xl font-bold text-gradient">Corisindo AI</span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-slate-700 hover:text-blue-600 transition-colors font-medium">Features</a>
                    <a href="#ai-benefits" class="text-slate-700 hover:text-blue-600 transition-colors font-medium">AI Benefits</a>
                    <a href="#competition" class="text-slate-700 hover:text-blue-600 transition-colors font-medium">Competition</a>
                    <a href="{{ route('about') }}" class="text-slate-700 hover:text-blue-600 transition-colors font-medium">About</a>
                    <a href="{{ route('services') }}" class="text-slate-700 hover:text-blue-600 transition-colors font-medium">Services</a>
                    <a href="{{ route('blog') }}" class="text-slate-700 hover:text-blue-600 transition-colors font-medium">Blog</a>
                    <a href="{{ route('contact') }}" class="text-slate-700 hover:text-blue-600 transition-colors font-medium">Contact</a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-slate-700 hover:text-blue-600 transition-colors font-medium">Login</a>
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 text-white px-6 py-3 rounded-xl hover:from-blue-700 hover:via-purple-700 hover:to-pink-700 transition-all duration-300 transform hover:scale-105 font-semibold shadow-lg">
                        <i class="fas fa-rocket mr-2"></i>
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-bg hero-pattern pt-32 pb-20 relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-32 h-32 bg-blue-500/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-40 h-40 bg-purple-500/20 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-pink-500/10 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="text-white">
                    <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-medium text-white mb-6 border border-white/30">
                        <i class="fas fa-trophy text-yellow-300 mr-2"></i>
                        CORISINDO 2025 Competition Entry
                    </div>
                    <h1 class="text-5xl lg:text-6xl font-bold leading-tight mb-6 text-shadow">
                        <span class="text-white">AI-Powered</span>
                        <br>
                        <span class="text-yellow-300 drop-shadow-lg">Decision Making</span>
                        <br>
                        <span class="text-white">in Customer Service</span>
                    </h1>
                    <p class="text-xl lg:text-2xl text-blue-100 mb-8 leading-relaxed max-w-2xl">
                        Demonstrating the power of Artificial Intelligence and Big Data optimization in customer support decision-making.
                        Built for CORISINDO 2025 Web Design Competition.
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mb-8">
                        <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-4 rounded-xl text-lg font-semibold hover:bg-slate-100 transition-all duration-300 transform hover:scale-105 text-center shadow-lg hover:shadow-xl">
                            <i class="fas fa-rocket mr-2"></i>
                            Try AI Portal
                        </a>
                        <a href="#demo" class="border-2 border-white text-white px-8 py-4 rounded-xl text-lg font-semibold hover:bg-white hover:text-blue-600 transition-all duration-300 text-center backdrop-blur-sm">
                            <i class="fas fa-play mr-2"></i>
                            Watch Demo
                        </a>
                    </div>
                    <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-6">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-green-500/20 backdrop-blur-sm rounded-full flex items-center justify-center mr-3 border border-green-400/30">
                                <i class="fas fa-check text-green-300 text-sm"></i>
                            </div>
                            <span class="text-blue-100 font-medium">AI-Powered Decision Making</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-500/20 backdrop-blur-sm rounded-full flex items-center justify-center mr-3 border border-blue-400/30">
                                <i class="fas fa-check text-blue-300 text-sm"></i>
                            </div>
                            <span class="text-blue-100 font-medium">Big Data Optimization</span>
                        </div>
                    </div>
                </div>

                <!-- Right Visual -->
                <div class="relative">
                    <div class="bg-white/10 backdrop-blur-md rounded-3xl shadow-2xl p-8 floating-card border border-white/20">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 rounded-full flex items-center justify-center shadow-lg">
                                <i class="fas fa-brain text-white text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-white">AI Decision Engine</h3>
                                <p class="text-sm text-blue-100">Real-time analysis & routing</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="bg-white/20 backdrop-blur-sm rounded-lg p-3 border border-white/30">
                                <p class="text-sm text-white font-medium">"I need help with billing"</p>
                            </div>
                            <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 rounded-lg p-3 ml-8 shadow-lg">
                                <p class="text-sm text-white font-medium">AI Analysis: Billing Issue → High Priority → Route to Billing Expert</p>
                            </div>
                        </div>
                    </div>

                    <!-- Floating decorative elements -->
                    <div class="absolute -top-4 -right-4 w-20 h-20 bg-yellow-400/30 rounded-full floating backdrop-blur-sm border border-yellow-300/30" style="animation-delay: 1s;"></div>
                    <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-purple-400/30 rounded-full floating backdrop-blur-sm border border-purple-300/30" style="animation-delay: 2s;"></div>
                    <div class="absolute top-1/2 -right-8 w-12 h-12 bg-pink-400/20 rounded-full floating backdrop-blur-sm border border-pink-300/30" style="animation-delay: 0.5s;"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Competition Banner -->
    <section class="py-8 bg-gradient-to-r from-yellow-400 via-orange-500 to-red-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="flex items-center justify-center space-x-4">
                <i class="fas fa-trophy text-white text-2xl"></i>
                <h2 class="text-2xl font-bold text-white">CORISINDO 2025 Web Design Competition</h2>
                <i class="fas fa-trophy text-white text-2xl"></i>
            </div>
            <p class="text-white/90 mt-2 text-lg">Theme: "Optimalisasi Artificial Intelligence (AI) dan Big Data Dalam Pengambilan Keputusan"</p>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl font-bold text-blue-600 mb-2">85%</div>
                    <div class="text-slate-600">AI Decision Accuracy</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-purple-600 mb-2">3.2s</div>
                    <div class="text-slate-600">Average Response Time</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-pink-600 mb-2">60%</div>
                    <div class="text-slate-600">Cost Reduction</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-green-600 mb-2">98%</div>
                    <div class="text-slate-600">Customer Satisfaction</div>
                </div>
            </div>
        </div>
    </section>

    <!-- AI Decision Making Benefits Section -->
    <section id="ai-benefits" class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-slate-900 mb-4">
                    AI-Powered Decision Making in Customer Service
                </h2>
                <p class="text-xl text-slate-600 max-w-3xl mx-auto">
                    Our platform demonstrates how AI and Big Data can revolutionize decision-making processes in customer support operations.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Intelligent Intent Classification -->
                <div class="bg-white rounded-2xl p-8 shadow-lg card-hover border border-slate-200">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-brain text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-4">Smart Intent Classification</h3>
                    <p class="text-slate-600 mb-4">
                        AI automatically analyzes customer messages to understand intent, sentiment, and urgency, enabling intelligent decision-making for ticket routing.
                    </p>
                    <ul class="text-sm text-slate-500 space-y-2">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Natural Language Processing</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Sentiment Analysis</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Priority Detection</li>
                    </ul>
                </div>

                <!-- Predictive Routing -->
                <div class="bg-white rounded-2xl p-8 shadow-lg card-hover border border-slate-200">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-route text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-4">Predictive Agent Routing</h3>
                    <p class="text-slate-600 mb-4">
                        Machine learning algorithms predict the best agent for each ticket based on skills, workload, and historical performance data.
                    </p>
                    <ul class="text-sm text-slate-500 space-y-2">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Skill-based Matching</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Load Balancing</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Performance Prediction</li>
                    </ul>
                </div>

                <!-- Real-time Analytics -->
                <div class="bg-white rounded-2xl p-8 shadow-lg card-hover border border-slate-200">
                    <div class="w-16 h-16 bg-gradient-to-r from-pink-500 to-pink-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-chart-line text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-4">Real-time Decision Analytics</h3>
                    <p class="text-slate-600 mb-4">
                        Live dashboards provide instant insights for data-driven decision-making, helping managers optimize operations in real-time.
                    </p>
                    <ul class="text-sm text-slate-500 space-y-2">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Live Performance Metrics</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Trend Analysis</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Predictive Insights</li>
                    </ul>
                </div>

                <!-- Automated Escalation -->
                <div class="bg-white rounded-2xl p-8 shadow-lg card-hover border border-slate-200">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-arrow-up text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-4">Intelligent Escalation</h3>
                    <p class="text-slate-600 mb-4">
                        AI automatically detects complex issues and escalates them to human agents, ensuring optimal resource allocation and customer satisfaction.
                    </p>
                    <ul class="text-sm text-slate-500 space-y-2">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Complexity Detection</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Risk Assessment</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Smart Workflow</li>
                    </ul>
                </div>

                <!-- SLA Optimization -->
                <div class="bg-white rounded-2xl p-8 shadow-lg card-hover border border-slate-200">
                    <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-clock text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-4">SLA Optimization</h3>
                    <p class="text-slate-600 mb-4">
                        AI algorithms optimize Service Level Agreements by predicting resolution times and automatically adjusting priorities based on business rules.
                    </p>
                    <ul class="text-sm text-slate-500 space-y-2">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Time Prediction</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Priority Adjustment</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Business Rule Engine</li>
                    </ul>
                </div>

                <!-- Continuous Learning -->
                <div class="bg-white rounded-2xl p-8 shadow-lg card-hover border border-slate-200">
                    <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-graduation-cap text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-4">Continuous Learning</h3>
                    <p class="text-slate-600 mb-4">
                        The AI system continuously learns from interactions, improving decision-making accuracy and adapting to changing customer needs.
                    </p>
                    <ul class="text-sm text-slate-500 space-y-2">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Pattern Recognition</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Adaptive Responses</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Performance Evolution</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Competition Information Section -->
    <section id="competition" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full text-sm font-medium text-white mb-6">
                        <i class="fas fa-trophy mr-2"></i>
                        CORISINDO 2025 Competition
                    </div>
                    <h2 class="text-4xl font-bold text-slate-900 mb-6">
                        Built for Web Design Excellence
                    </h2>
                    <div class="space-y-8">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-robot text-white text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold text-slate-900 mb-2">AI & Big Data Integration</h3>
                                <p class="text-slate-600">Demonstrates advanced AI implementation with natural language processing, sentiment analysis, and intelligent decision-making algorithms.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-chart-bar text-white text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold text-slate-900 mb-2">Modern Web Technologies</h3>
                                <p class="text-slate-600">Built with Laravel 11, Tailwind CSS, and Alpine.js, showcasing cutting-edge web development practices and responsive design.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-users text-white text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold text-slate-900 mb-2">User Experience Focus</h3>
                                <p class="text-slate-600">Designed with user-centered principles, featuring intuitive interfaces, smooth animations, and seamless user workflows.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="bg-gradient-to-br from-slate-50 to-blue-50 rounded-3xl p-8 border border-slate-200">
                        <div class="text-center mb-6">
                            <div class="text-3xl font-bold text-blue-600 mb-2">Competition Highlights</div>
                            <p class="text-slate-600">What makes this project special</p>
                        </div>

                        <div class="space-y-6">
                            <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-200">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-green-600">AI Implementation</span>
                                    <span class="text-xs text-slate-500">Advanced</span>
                                </div>
                                <div class="space-y-2 text-sm text-slate-600">
                                    <div class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Natural Language Processing</div>
                                    <div class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Sentiment Analysis</div>
                                    <div class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Intelligent Routing</div>
                                    <div class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Predictive Analytics</div>
                                </div>
                            </div>

                            <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-200">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-blue-600">Technical Excellence</span>
                                    <span class="text-xs text-slate-500">Modern</span>
                                </div>
                                <div class="space-y-2 text-sm text-slate-600">
                                    <div class="flex items-center"><i class="fas fa-check text-blue-500 mr-2"></i>Laravel 11 Framework</div>
                                    <div class="flex items-center"><i class="fas fa-check text-blue-500 mr-2"></i>Responsive Design</div>
                                    <div class="flex items-center"><i class="fas fa-check text-blue-500 mr-2"></i>Real-time Features</div>
                                    <div class="flex items-center"><i class="fas fa-check text-blue-500 mr-2"></i>Performance Optimized</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-slate-900 mb-4">
                    Complete Customer Service Solution
                </h2>
                <p class="text-xl text-slate-600 max-w-3xl mx-auto">
                    A comprehensive platform that showcases AI-powered decision-making in every aspect of customer support operations.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Customer Management -->
                <div class="bg-white rounded-2xl p-8 shadow-lg card-hover border border-slate-200">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-4">Smart Customer Management</h3>
                    <p class="text-slate-600 mb-4">
                        AI-powered customer profiling and segmentation for personalized service delivery and improved customer relationships.
                    </p>
                </div>

                <!-- Ticket System -->
                <div class="bg-white rounded-2xl p-8 shadow-lg card-hover border border-slate-200">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-ticket-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-4">Intelligent Ticket System</h3>
                    <p class="text-slate-600 mb-4">
                        Automated ticket categorization, priority assignment, and intelligent routing based on AI analysis of content and context.
                    </p>
                </div>

                <!-- Agent Management -->
                <div class="bg-white rounded-2xl p-8 shadow-lg card-hover border border-slate-200">
                    <div class="w-16 h-16 bg-gradient-to-r from-pink-500 to-pink-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-user-tie text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-4">Performance Analytics</h3>
                    <p class="text-slate-600 mb-4">
                        AI-driven performance tracking and optimization for agents, enabling data-driven decision-making in team management.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 gradient-bg">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-white mb-6">
                Experience AI-Powered Decision Making
            </h2>
            <p class="text-xl text-blue-100 mb-8">
                Built for CORISINDO 2025 Competition, this platform demonstrates the future of customer service with AI and Big Data optimization.
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-4 rounded-xl text-lg font-semibold hover:bg-slate-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-rocket mr-2"></i>
                    Try the AI Portal
                </a>
                <a href="#demo" class="border-2 border-white text-white px-8 py-4 rounded-xl text-lg font-semibold hover:bg-white hover:text-blue-600 transition-all duration-300">
                    <i class="fas fa-play mr-2"></i>
                    Watch Demo
                </a>
            </div>
            <p class="text-blue-100 text-sm mt-4">CORISINDO 2025 Competition Entry • AI & Big Data Optimization • Modern Web Technologies</p>
        </div>
    </section>

    <!-- Developer Section -->
    <section id="developer" class="py-20 bg-gradient-to-b from-slate-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-flex items-center px-4 py-2 bg-blue-100 rounded-full text-sm font-medium text-blue-600 mb-6">
                    <i class="fas fa-code mr-2"></i>
                    Developer Profile
                </div>
                <h2 class="text-4xl font-bold text-slate-900 mb-4">
                    Meet The Developer
                </h2>
                <p class="text-xl text-slate-600 max-w-3xl mx-auto">
                    The creative mind behind this AI-powered customer service innovation
                </p>
            </div>

            <div class="max-w-3xl mx-auto">
                <div class="bg-white rounded-2xl p-8 md:p-12 shadow-xl hover:shadow-2xl transition-all duration-300 border border-slate-200 card-shine">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                        <div class="text-center md:text-left">
                            <div class="relative mb-6 md:mb-0">
                                <div class="w-40 h-40 mx-auto md:mx-0 rounded-full overflow-hidden border-4 border-blue-500 shadow-lg">
                                    {{-- <img src="https://ui-avatars.com/api/?name=Muhammad+Fadhil+Adha&background=4F46E5&color=fff&size=400" alt="Muhammad Fadhil Adha" class="w-full h-full object-cover"> --}}
                                    <img src="{{ asset('profile.png') }}" alt="Muhammad Fadhil Adha" class="w-full h-full object-cover">
                                </div>
                                <div class="absolute -bottom-4 left-1/2 md:left-20 transform -translate-x-1/2 md:-translate-x-1/2">
                                    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-2 rounded-full text-sm font-medium shadow-lg">
                                        Full Stack Developer
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center md:text-left">
                            <h3 class="text-2xl font-bold text-slate-900 mb-2">Muhammad Fadhil Adha</h3>
                            <div class="space-y-3 mb-6">
                                <p class="text-slate-600">
                                    <i class="fas fa-university text-blue-500 mr-2"></i>
                                    Universitas Potensi Utama
                                </p>
                                <p class="text-slate-600">
                                    <i class="fas fa-graduation-cap text-blue-500 mr-2"></i>
                                    Sistem Informasi (S1)
                                </p>
                                <p class="text-slate-600">
                                    <i class="fas fa-trophy text-blue-500 mr-2"></i>
                                    CORSINDO 2025 Web Competition
                                </p>
                            </div>
                            <div class="flex justify-center md:justify-start space-x-4">
                                <a href="https://github.com/defadels" target="_blank" class="bg-slate-800 text-white px-4 py-2 rounded-lg hover:bg-slate-700 transition-colors">
                                    <i class="fab fa-github mr-2"></i>
                                    GitHub
                                </a>
                                <a href="https://www.linkedin.com/in/muhammad-fadhil-adha-440945178/" target="_blank" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                    <i class="fab fa-linkedin mr-2"></i>
                                    LinkedIn
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-8 border-t border-slate-200">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-slate-50 rounded-xl p-6 text-center hover:bg-slate-100 transition-colors">
                                <div class="text-blue-500 text-2xl font-bold mb-2">Full Stack</div>
                                <p class="text-slate-600">Laravel & React Development</p>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-6 text-center hover:bg-slate-100 transition-colors">
                                <div class="text-purple-500 text-2xl font-bold mb-2">AI Integration</div>
                                <p class="text-slate-600">Machine Learning & NLP</p>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-6 text-center hover:bg-slate-100 transition-colors">
                                <div class="text-pink-500 text-2xl font-bold mb-2">UI/UX Design</div>
                                <p class="text-slate-600">Modern Web Interfaces</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-brain text-white text-xl"></i>
                        </div>
                        <span class="ml-3 text-xl font-bold">Corisindo AI</span>
                    </div>
                    <p class="text-slate-400 mb-4">
                        AI-Powered Customer Service Portal designed for CORISINDO 2025 Web Design Competition.
                        Demonstrating AI and Big Data optimization in decision-making.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-slate-400 hover:text-white transition-colors"><i class="fab fa-twitter text-xl"></i></a>
                        <a href="#" class="text-slate-400 hover:text-white transition-colors"><i class="fab fa-linkedin text-xl"></i></a>
                        <a href="#" class="text-slate-400 hover:text-white transition-colors"><i class="fab fa-github text-xl"></i></a>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">AI Features</h3>
                    <ul class="space-y-2 text-slate-400">
                        <li><a href="#" class="hover:text-white transition-colors">Intent Classification</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Sentiment Analysis</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Smart Routing</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Predictive Analytics</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Competition</h3>
                    <ul class="space-y-2 text-slate-400">
                        <li><a href="#" class="hover:text-white transition-colors">CORISINDO 2025</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">AI & Big Data</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Decision Making</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Web Design</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Technology</h3>
                    <ul class="space-y-2 text-slate-400">
                        <li><a href="#" class="hover:text-white transition-colors">Laravel 11</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Tailwind CSS</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Alpine.js</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">MySQL</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-slate-800 mt-12 pt-8 text-center text-slate-400">
                <p>&copy; 2025 Corisindo AI. Built for CORISINDO 2025 Web Design Competition.
                Demonstrating AI and Big Data optimization in decision-making processes.</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Parallax scroll effect disabled for better performance
        // window.addEventListener('scroll', function() {
        //     const scrolled = window.pageYOffset;
        //     const parallax = document.querySelector('.hero-pattern');
        //     if (parallax) {
        //         parallax.style.transform = `translateY(${scrolled * 0.5}px)`;
        //     }
        // });

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('bounce-in');
                }
            });
        }, observerOptions);

        // Observe all feature cards
        document.querySelectorAll('.card-hover').forEach(card => {
            observer.observe(card);
        });
    </script>
</body>
</html>

