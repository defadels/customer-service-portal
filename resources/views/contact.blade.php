@extends('layouts.app')

@section('title', 'Contact Us - Corisindo AI')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-green-900 via-blue-900 to-purple-900 py-32">
    <!-- Animated Background -->
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-r from-green-600/20 to-blue-600/20"></div>
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-20 left-10 w-72 h-72 bg-green-500/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute top-40 right-20 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute bottom-20 left-1/3 w-80 h-80 bg-purple-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
        </div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="animate-fade-in-up">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">
                Get in <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-400">Touch</span>
            </h1>
            <p class="text-xl md:text-2xl text-green-100 max-w-3xl mx-auto leading-relaxed">
                Ready to transform your customer service? Let's discuss how Corisindo AI can help your business grow.
            </p>
        </div>
    </div>
</div>

<!-- Contact Form Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
            <!-- Contact Form -->
            <div class="animate-slide-in-left">
                <div class="bg-white rounded-2xl p-8 shadow-xl border border-gray-200">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Send us a Message</h2>
                    
                    <form id="contactForm" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="firstName" class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                                <input type="text" id="firstName" name="firstName" required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                                       placeholder="John">
                            </div>
                            <div>
                                <label for="lastName" class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                                <input type="text" id="lastName" name="lastName" required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                                       placeholder="Doe">
                            </div>
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                            <input type="email" id="email" name="email" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                                   placeholder="john@company.com">
                        </div>
                        
                        <div>
                            <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Company</label>
                            <input type="text" id="company" name="company" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                                   placeholder="Your Company Name">
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" id="phone" name="phone" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                                   placeholder="+1 (555) 123-4567">
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject *</label>
                            <select id="subject" name="subject" required 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                                <option value="">Select a subject</option>
                                <option value="general">General Inquiry</option>
                                <option value="sales">Sales & Pricing</option>
                                <option value="demo">Request Demo</option>
                                <option value="support">Technical Support</option>
                                <option value="partnership">Partnership</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                            <textarea id="message" name="message" rows="5" required 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 resize-none"
                                      placeholder="Tell us about your needs..."></textarea>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" id="newsletter" name="newsletter" 
                                   class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="newsletter" class="ml-2 text-sm text-gray-600">
                                Subscribe to our newsletter for updates and insights
                            </label>
                        </div>
                        
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-4 rounded-xl font-semibold text-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Contact Information -->
            <div class="animate-slide-in-right">
                <div class="space-y-8">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Let's Start a Conversation</h2>
                        <p class="text-lg text-gray-600 leading-relaxed">
                            Whether you have questions about our AI-powered customer service solutions, 
                            want to schedule a demo, or need technical support, we're here to help. 
                            Our team of experts is ready to assist you in transforming your customer service operations.
                        </p>
                    </div>
                    
                    <!-- Contact Methods -->
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-envelope text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Email Us</h3>
                                <p class="text-gray-600 mb-1">info@corisindoai.com</p>
                                <p class="text-gray-600">support@corisindoai.com</p>
                                <p class="text-sm text-gray-500">We typically respond within 2 hours</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-phone text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Call Us</h3>
                                <p class="text-gray-600 mb-1">+1 (555) 123-4567</p>
                                <p class="text-gray-600">+1 (555) 987-6543</p>
                                <p class="text-sm text-gray-500">Mon-Fri: 9AM-6PM EST</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Visit Us</h3>
                                <p class="text-gray-600 mb-1">123 AI Innovation Drive</p>
                                <p class="text-gray-600">Tech Valley, CA 94000</p>
                                <p class="text-sm text-gray-500">United States</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Media -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Follow Us</h3>
                        <div class="flex space-x-4">
                            <a href="#" class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center text-white hover:bg-blue-700 transition-colors duration-300 transform hover:scale-110">
                                <i class="fab fa-linkedin-in text-xl"></i>
                            </a>
                            <a href="#" class="w-12 h-12 bg-blue-400 rounded-xl flex items-center justify-center text-white hover:bg-blue-500 transition-colors duration-300 transform hover:scale-110">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                            <a href="#" class="w-12 h-12 bg-gray-800 rounded-xl flex items-center justify-center text-white hover:bg-gray-900 transition-colors duration-300 transform hover:scale-110">
                                <i class="fab fa-github text-xl"></i>
                            </a>
                            <a href="#" class="w-12 h-12 bg-red-600 rounded-xl flex items-center justify-center text-white hover:bg-red-700 transition-colors duration-300 transform hover:scale-110">
                                <i class="fab fa-youtube text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 animate-fade-in-up">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Find answers to common questions about our services and support
            </p>
        </div>
        
        <div class="space-y-6">
            <!-- FAQ Item 1 -->
            <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.1s;">
                <button class="w-full text-left flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h3 class="text-lg font-semibold text-gray-900">How quickly can I get started with Corisindo AI?</h3>
                    <i class="fas fa-chevron-down text-blue-600 transition-transform duration-300"></i>
                </button>
                <div class="mt-4 text-gray-600 hidden">
                    <p>You can get started with Corisindo AI in as little as 24 hours! Our platform is designed for quick deployment, and our team provides comprehensive onboarding support to ensure a smooth transition.</p>
                </div>
            </div>
            
            <!-- FAQ Item 2 -->
            <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.2s;">
                <button class="w-full text-left flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h3 class="text-lg font-semibold text-gray-900">What kind of support do you provide?</h3>
                    <i class="fas fa-chevron-down text-blue-600 transition-transform duration-300"></i>
                </button>
                <div class="mt-4 text-gray-600 hidden">
                    <p>We provide comprehensive support including 24/7 technical assistance, dedicated account managers for enterprise clients, comprehensive documentation, video tutorials, and regular training sessions for your team.</p>
                </div>
            </div>
            
            <!-- FAQ Item 3 -->
            <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.3s;">
                <button class="w-full text-left flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h3 class="text-lg font-semibold text-gray-900">Can I integrate Corisindo AI with my existing systems?</h3>
                    <i class="fas fa-chevron-down text-blue-600 transition-transform duration-300"></i>
                </button>
                <div class="mt-4 text-gray-600 hidden">
                    <p>Absolutely! Corisindo AI is designed with integration in mind. We offer REST APIs, webhooks, and pre-built connectors for popular CRM systems, helpdesk platforms, and communication tools.</p>
                </div>
            </div>
            
            <!-- FAQ Item 4 -->
            <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.4s;">
                <button class="w-full text-left flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h3 class="text-lg font-semibold text-gray-900">Is my data secure with Corisindo AI?</h3>
                    <i class="fas fa-chevron-down text-blue-600 transition-transform duration-300"></i>
                </button>
                <div class="mt-4 text-gray-600 hidden">
                    <p>Yes, data security is our top priority. We implement enterprise-grade security measures including end-to-end encryption, SOC 2 compliance, regular security audits, and strict data privacy controls.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-green-600 via-blue-600 to-purple-600">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-in-up">
            <h2 class="text-4xl font-bold text-white mb-6">
                Ready to Transform Your Customer Service?
            </h2>
            <p class="text-xl text-green-100 mb-8">
                Join hundreds of businesses already using Corisindo AI to deliver exceptional customer experiences.
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('register') }}" class="bg-white text-green-600 px-8 py-4 rounded-xl text-lg font-semibold hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-rocket mr-2"></i>
                    Start Free Trial
                </a>
                <a href="#demo" class="border-2 border-white text-white px-8 py-4 rounded-xl text-lg font-semibold hover:bg-white hover:text-green-600 transition-all duration-300">
                    <i class="fas fa-play mr-2"></i>
                    Watch Demo
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
</style>
@endpush

@push('scripts')
<script>
function toggleFAQ(button) {
    const content = button.nextElementSibling;
    const icon = button.querySelector('i');
    
    if (content.classList.contains('hidden')) {
        content.classList.remove('hidden');
        icon.style.transform = 'rotate(180deg)';
    } else {
        content.classList.add('hidden');
        icon.style.transform = 'rotate(0deg)';
    }
}

// Form submission handling
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Get form data
    const formData = new FormData(this);
    const data = Object.fromEntries(formData);
    
    // Show success message (in real app, this would send to server)
    alert('Thank you for your message! We\'ll get back to you within 2 hours.');
    
    // Reset form
    this.reset();
});

// Add floating animation to contact icons
document.addEventListener('DOMContentLoaded', function() {
    const icons = document.querySelectorAll('.w-12.h-12');
    icons.forEach((icon, index) => {
        icon.style.animationDelay = `${index * 0.2}s`;
        icon.classList.add('animate-bounce');
    });
});
</script>
@endpush
