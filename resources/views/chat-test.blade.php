@extends('layouts.app')

@section('title', 'Chat Test - Corisindo AI')

@section('content')
<div class="min-h-screen bg-gray-50 py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Chat Test Interface</h1>
            <p class="text-lg text-gray-600 mb-6">
                Test the AI chat functionality with switchable providers (OpenAI / Gemini)
            </p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('chat.index') }}" 
                   class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-comments mr-2"></i>
                    Go to Main Chat
                </a>
                <a href="{{ route('chat.test') }}" 
                   class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-robot mr-2"></i>
                    Test AI API
                </a>
            </div>
        </div>

        <!-- Chat Interface -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <!-- Chat Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-lg">
                            <i class="fas fa-robot text-blue-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-bold text-white">AI Chat Test</h3>
                            <p class="text-blue-100 text-sm">Testing OpenAI Integration</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 shadow-sm">
                            <i class="fas fa-circle text-green-500 text-xs mr-2 animate-pulse"></i>
                            Testing Mode
                        </span>
                    </div>
                </div>
            </div>

            <!-- Chat Messages -->
            <div id="chat-messages" class="h-96 overflow-y-auto p-6 space-y-4 bg-gray-50">
                <!-- Messages will be added here -->
            </div>

            <!-- Typing Indicator -->
            <div id="typing-indicator" class="hidden p-6">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-robot text-white text-sm"></i>
                    </div>
                    <div class="flex space-x-2">
                        <div class="w-3 h-3 bg-gray-500 rounded-full animate-bounce"></div>
                        <div class="w-3 h-3 bg-gray-500 rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
                        <div class="w-3 h-3 bg-gray-500 rounded-full animate-bounce" style="animation-delay: 0.4s;"></div>
                    </div>
                </div>
            </div>

            <!-- Chat Input -->
            <div class="border-t border-gray-200 p-6 bg-white">
                <div class="flex items-center space-x-3">
                    <div class="relative flex-1">
                        <input 
                            type="text"
                            id="message-input"
                            placeholder="Type your message here..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                        >
                        <button 
                            onclick="sendMessage()"
                            id="send-btn"
                            class="absolute right-2 top-1/2 transform -translate-y-1/2 w-10 h-10 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center"
                        >
                            <i class="fas fa-paper-plane text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Debug Info -->
        <div class="mt-6 p-4 bg-gray-100 rounded-lg">
            <h3 class="font-semibold text-gray-900 mb-2">Debug Information:</h3>
            <div class="text-sm text-gray-600 space-y-1">
                <div><strong>Status:</strong> <span id="debug-status">Ready</span></div>
                <div><strong>API Endpoint:</strong> <span id="debug-endpoint">/api/ai/test-chat</span></div>
                <div><strong>Provider:</strong> 
                    <select id="provider-select" class="border rounded px-2 py-1 text-sm">
                        <option value="">Default (config)</option>
                        <option value="gemini">Gemini</option>
                        <option value="openai">OpenAI</option>
                    </select>
                </div>
                <div><strong>Last Response:</strong> <span id="debug-response">None</span></div>
                <div><strong>Error Count:</strong> <span id="debug-errors">0</span></div>
            </div>
        </div>

        <!-- Quick Test Buttons -->
        <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
            <button onclick="sendQuickMessage('Hello, how are you?')" 
                    class="p-3 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors text-sm">
                <i class="fas fa-hand-wave mr-2"></i>
                Greeting
            </button>
            <button onclick="sendQuickMessage('I need help with billing')" 
                    class="p-3 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors text-sm">
                <i class="fas fa-credit-card mr-2"></i>
                Billing Help
            </button>
            <button onclick="sendQuickMessage('My account is not working')" 
                    class="p-3 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition-colors text-sm">
                <i class="fas fa-tools mr-2"></i>
                Technical Issue
            </button>
            <button onclick="sendQuickMessage('I want to make a complaint')" 
                    class="p-3 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors text-sm">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                Complaint
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
let errorCount = 0;

document.addEventListener('DOMContentLoaded', function() {
    addMessageToChat('system', 'Welcome to the AI Chat Test! This interface tests the OpenAI integration. Try sending a message or use the quick test buttons below.');
    updateDebugStatus('Ready');
});

function sendMessage() {
    const input = document.getElementById('message-input');
    const message = input.value.trim();
    
    if (!message) return;
    
    // Add user message to chat
    addMessageToChat('user', message);
    input.value = '';
    
    // Show typing indicator
    showTyping();
    
    // Update debug info
    updateDebugStatus('Sending message to AI...');

    // Send to AI using public test endpoint
    fetch('/api/ai/test-chat', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            message: message,
            context: {
                chat_id: 'test_chat_' + Date.now(),
                user_type: 'test_user',
                provider: document.getElementById('provider-select').value || undefined
            }
        })
    })
    .then(response => {
        updateDebugStatus(`Response status: ${response.status}`);

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        // Check if response is JSON
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            throw new Error('Response is not JSON');
        }

        return response.json();
    })
    .then(data => {
        hideTyping();
        updateDebugStatus('AI response received successfully');
        updateDebugResponse(JSON.stringify(data, null, 2));

        if (data.error) {
            addMessageToChat('ai', 'Sorry, I encountered an error: ' + data.error);
            errorCount++;
            updateDebugErrors();
        } else {
            addMessageToChat('ai', data.response || 'I received your message but had trouble generating a response.');
        }
    })
    .catch(error => {
        hideTyping();
        updateDebugStatus(`Error: ${error.message}`);
        addMessageToChat('ai', 'Sorry, I\'m having trouble connecting right now. Please try again.');
        console.error('Network Error:', error);
        errorCount++;
        updateDebugErrors();
    });
}

function sendQuickMessage(message) {
    document.getElementById('message-input').value = message;
    sendMessage();
}

function addMessageToChat(sender, message) {
    const chatMessages = document.getElementById('chat-messages');
    const messageDiv = document.createElement('div');
    
    const isUser = sender === 'user';
    const messageClass = isUser ? 'ml-auto' : 'mr-auto';
    const bgClass = isUser ? 'bg-blue-600 text-white' : 'bg-white text-gray-800 border border-gray-200';
    const icon = isUser ? 'fa-user' : 'fa-robot';
    const iconBg = isUser ? 'bg-blue-500' : 'bg-purple-500';
    
    messageDiv.className = `flex items-start space-x-3 ${messageClass} max-w-xs lg:max-w-md`;
    messageDiv.innerHTML = `
        <div class="flex-shrink-0">
            <div class="w-8 h-8 ${iconBg} rounded-full flex items-center justify-center">
                <i class="fas ${icon} text-white text-sm"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg px-4 py-2 shadow-sm border border-gray-200">
            <p class="text-sm">${message}</p>
            <p class="text-xs text-gray-500 mt-1">${new Date().toLocaleTimeString()}</p>
        </div>
    `;
    
    chatMessages.appendChild(messageDiv);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

function showTyping() {
    document.getElementById('typing-indicator').classList.remove('hidden');
}

function hideTyping() {
    document.getElementById('typing-indicator').classList.add('hidden');
}

function updateDebugStatus(message) {
    document.getElementById('debug-status').textContent = message;
}

function updateDebugResponse(response) {
    document.getElementById('debug-response').textContent = response.substring(0, 50) + '...';
}

function updateDebugErrors() {
    document.getElementById('debug-errors').textContent = errorCount;
}

// Enter key support
document.getElementById('message-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        sendMessage();
    }
});
</script>
@endpush

@endsection
