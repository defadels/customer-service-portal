@extends('layouts.app')

@section('title', 'Chat - Corisindo AI')

@section('content')
<div class="min-h-screen bg-gray-50 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Chat Interface -->
            <div class="lg:col-span-3">
                @livewire('chat-box', [
                    'chatId' => $chatId ?? uniqid('chat_'),
                    'ticketId' => $ticketId ?? null,
                    'customerId' => auth()->user()->customer->id ?? auth()->user()->id ?? null
                ])
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Customer Info Panel -->
                <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-user text-blue-600 mr-3 text-xl"></i>
                        Customer Info
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                            <input
                                type="text"
                                id="customer-name"
                                placeholder="Your name"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input
                                type="email"
                                id="customer-email"
                                placeholder="your@email.com"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                            >
                        </div>
                        <button
                            onclick="updateCustomerInfo()"
                            class="w-full px-4 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg text-sm font-medium hover:from-green-600 hover:to-green-700 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5"
                        >
                            <i class="fas fa-save mr-2"></i>
                            Save Info
                        </button>
                    </div>
                </div>

                <!-- AI Insights -->
                <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-brain text-purple-600 mr-3 text-xl"></i>
                        AI Insights
                    </h3>
                    <div class="space-y-4">
                        <div class="text-center p-4 bg-blue-50 rounded-lg">
                            <div class="text-3xl font-bold text-blue-600" id="ai-accuracy">-</div>
                            <div class="text-sm text-gray-600 font-medium">Accuracy Rate</div>
                        </div>
                        <div class="text-center p-4 bg-green-50 rounded-lg">
                            <div class="text-3xl font-bold text-green-600" id="auto-resolution">-</div>
                            <div class="text-sm text-gray-600 font-medium">Auto-Resolution</div>
                        </div>
                        <div class="text-center p-4 bg-yellow-50 rounded-lg">
                            <div class="text-3xl font-bold text-yellow-600" id="response-time">-</div>
                            <div class="text-sm text-gray-600 font-medium">Response Time (s)</div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-bolt text-yellow-600 mr-3 text-xl"></i>
                        Quick Actions
                    </h3>
                    <div class="space-y-3">
                        <button
                            onclick="sendQuickMessage('I need technical support')"
                            class="w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-all duration-200 border border-transparent hover:border-blue-200 group"
                        >
                            <i class="fas fa-tools mr-3 text-blue-600 group-hover:text-blue-700"></i>
                            Technical Support
                        </button>
                        <button
                            onclick="sendQuickMessage('I have a billing question')"
                            class="w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition-all duration-200 border border-transparent hover:border-green-200 group"
                        >
                            <i class="fas fa-credit-card mr-3 text-green-600 group-hover:text-green-700"></i>
                            Billing Question
                        </button>
                        <button
                            onclick="sendQuickMessage('How do I reset my password?')"
                            class="w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 rounded-lg transition-all duration-200 border border-transparent hover:border-purple-200 group"
                        >
                            <i class="fas fa-key mr-3 text-purple-600 group-hover:text-purple-700"></i>
                            Password Reset
                        </button>
                        <button
                            onclick="sendQuickMessage('I want to make a complaint')"
                            class="w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700 rounded-lg transition-all duration-200 border border-transparent hover:border-red-200 group"
                        >
                            <i class="fas fa-exclamation-triangle mr-3 text-red-600 group-hover:text-red-700"></i>
                            Make Complaint
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Chat Grid Layout */
    .grid-chat {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 2rem;
    }

    /* Chat Container */
    .chat-container {
        min-height: 600px;
    }

    /* Chat Messages */
    .chat-message {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1rem;
        animation: fadeIn 0.3s ease-in;
    }

    .chat-message.user {
        flex-direction: row-reverse;
    }

    .chat-message-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin: 0 0.75rem;
    }

    .chat-message-avatar.user {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    }

    .chat-message-avatar.ai {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
    }

    .chat-message-avatar.agent {
        background: linear-gradient(135deg, #10b981, #059669);
    }

    .chat-message-bubble {
        position: relative;
        max-width: 70%;
        padding: 0.75rem 1rem;
        border-radius: 1rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease;
    }

    .chat-message-bubble.user {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
        border-bottom-right-radius: 0.25rem;
    }

    .chat-message-bubble.ai {
        background: white;
        color: #374151;
        border: 1px solid #e5e7eb;
        border-bottom-left-radius: 0.25rem;
    }

    .chat-message-bubble.agent {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border-bottom-left-radius: 0.25rem;
    }

    .chat-message-bubble:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    /* Chat Input */
    .chat-input-field {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 1.5rem;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        padding-right: 3rem;
    }

    .chat-input-field:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .chat-send-btn {
        position: absolute;
        right: 0.5rem;
        top: 50%;
        transform: translateY(-50%);
        width: 2.5rem;
        height: 2.5rem;
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .chat-send-btn:hover:not(:disabled) {
        transform: translateY(-50%) scale(1.05);
        box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3);
    }

    .chat-send-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    /* Scrollbar */
    .chat-scrollbar::-webkit-scrollbar {
        width: 6px;
    }

    .chat-scrollbar::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }

    .chat-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }

    .chat-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.3s ease-in;
    }

    .message-shadow {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .grid-chat {
            grid-template-columns: 1fr;
        }
        
        .chat-container {
            min-height: 500px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
let customerInfo = JSON.parse(localStorage.getItem('customerInfo') || '{}');
let chatId = 'chat_' + Date.now();

document.addEventListener('DOMContentLoaded', function() {
    loadCustomerInfo();
    loadAIStats();

    // Listen for Livewire events
    window.addEventListener('chatUpdated', function() {
        console.log('Chat updated event received');
    });

    window.addEventListener('showError', function() {
        console.log('Error event received');
    });
});

function getChatId() {
    return chatId;
}

function sendQuickMessage(message) {
    // Find the Livewire component and trigger the message
    const chatBox = document.querySelector('[wire\\:id]');
    if (chatBox && window.Livewire) {
        // Set the message in the Livewire component
        const inputField = chatBox.querySelector('[x-model="newMessage"]');
        if (inputField) {
            inputField.value = message;
            // Trigger the send message
            const sendButton = chatBox.querySelector('.chat-send-btn');
            if (sendButton && !sendButton.disabled) {
                sendButton.click();
            }
        }
    }
}

function updateCustomerInfo() {
    const name = document.getElementById('customer-name').value.trim();
    const email = document.getElementById('customer-email').value.trim();

    if (!name || !email) {
        showNotification('Please fill in both name and email.', 'error');
        return;
    }

    customerInfo = { name, email };
    localStorage.setItem('customerInfo', JSON.stringify(customerInfo));
    showNotification('Customer information saved successfully!', 'success');
}

function loadCustomerInfo() {
    if (customerInfo.name) {
        document.getElementById('customer-name').value = customerInfo.name;
    }
    if (customerInfo.email) {
        document.getElementById('customer-email').value = customerInfo.email;
    }
}

function loadAIStats() {
    fetch('/api/ai/stats')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (document.getElementById('ai-accuracy')) {
            document.getElementById('ai-accuracy').textContent =
                ((data.average_confidence || 0) * 100).toFixed(1) + '%';
        }
        if (document.getElementById('auto-resolution')) {
            document.getElementById('auto-resolution').textContent =
                ((data.auto_resolution_rate || 0) * 100).toFixed(1) + '%';
        }
        if (document.getElementById('response-time')) {
            document.getElementById('response-time').textContent =
                (data.response_time || '0.5s');
        }
    })
    .catch(error => {
        console.error('Error loading AI stats:', error);
        ['ai-accuracy', 'auto-resolution', 'response-time'].forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                element.textContent = 'N/A';
            }
        });
    });
}

function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 transform transition-all duration-300 ${
        type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    }`;
    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-3"></i>
            <span class="font-medium">${message}</span>
        </div>
    `;

    document.body.appendChild(notification);

    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateY(0)';
    }, 100);

    setTimeout(() => {
        notification.style.transform = 'translateY(-100%)';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}
</script>
@endpush

@endsection
