@extends('layouts.app')

@section('title', 'Chat Support - Customer Service Portal')

@section('content')
<div class="flex h-[calc(100vh-4rem)]">
    <!-- Sidebar -->
    <div class="w-80 bg-white border-r border-gray-200 flex flex-col">
        <!-- Sidebar Header -->
        <div class="p-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">
                <i class="fas fa-comments text-blue-600 mr-2"></i>
                Chat Support
            </h2>
            <p class="text-sm text-gray-600 mt-1">AI-powered assistance</p>
        </div>

        <!-- Chat List -->
        <div class="flex-1 overflow-y-auto py-4">
            <!-- Active Chats -->
            <div class="px-4 mb-4">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Active Chats</h3>
                <div class="space-y-2">
                    @foreach($activeChats as $chat)
                    <button class="w-full text-left p-3 rounded-lg hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition-colors {{ $currentChat && $currentChat->id === $chat->id ? 'bg-blue-50' : '' }}">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                    <span class="text-blue-600 font-medium">{{ substr($chat->customer->name ?? 'A', 0, 1) }}</span>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">{{ $chat->customer->name ?? 'Anonymous' }}</p>
                                <p class="text-xs text-gray-500">{{ Str::limit($chat->lastMessage?->content ?? 'No messages', 20) }}</p>
                            </div>
                            @if($chat->unreadCount)
                            <span class="ml-auto bg-blue-600 text-white text-xs font-medium px-2 py-0.5 rounded-full">
                                {{ $chat->unreadCount }}
                            </span>
                            @endif
                        </div>
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- Previous Chats -->
            <div class="px-4">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Previous Chats</h3>
                <div class="space-y-2">
                    @foreach($previousChats as $chat)
                    <button class="w-full text-left p-3 rounded-lg hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition-colors">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center">
                                    <span class="text-gray-600 font-medium">{{ substr($chat->customer->name ?? 'A', 0, 1) }}</span>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">{{ $chat->customer->name ?? 'Anonymous' }}</p>
                                <p class="text-xs text-gray-500">{{ $chat->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Chat Main Content -->
    <div class="flex-1 flex flex-col bg-gray-50">
        <!-- Chat Header -->
        <div class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">
            <div class="flex items-center">
                <div class="flex items-center">
                    <i class="fas fa-robot text-white text-xl mr-3"></i>
                    <div>
                        <h3 class="text-white font-semibold">AI Customer Support</h3>
                        <p class="text-blue-100 text-sm">Online • Siap membantu 24/7</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="bg-green-400 text-green-800 text-xs px-2 py-1 rounded-full">AI Active</span>
                    <span class="text-blue-100 text-sm" id="ai-status">Connected</span>
                </div>
            </div>
        </div>

        <!-- Chat Messages -->
        <div class="h-96 overflow-y-auto p-6 space-y-4" id="chat-messages">
            <!-- Welcome Message -->
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-robot text-white text-sm"></i>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="bg-gray-100 rounded-lg px-4 py-2 max-w-xs">
                        <p class="text-gray-800 text-sm">
                            Halo! Selamat datang di Customer Service Portal. Saya adalah AI assistant yang siap membantu Anda.
                            Ada yang bisa saya bantu?
                        </p>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Baru saja</p>
                </div>
            </div>
        </div>

        <!-- Chat Input -->
        <div class="border-t border-gray-200 p-4">
            <form id="chat-form" class="flex space-x-3">
                <div class="flex-1">
                    <input
                        type="text"
                        id="message-input"
                        placeholder="Ketik pesan Anda di sini..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required
                    >
                </div>
                <button
                    type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors"
                >
                    <i class="fas fa-paper-plane mr-2"></i>
                    Kirim
                </button>
            </form>

            <!-- Quick Actions -->
            <div class="mt-3 flex flex-wrap gap-2">
                <button
                    onclick="sendQuickMessage('Saya mau komplain tentang produk')"
                    class="text-xs bg-gray-100 text-gray-700 px-3 py-1 rounded-full hover:bg-gray-200 transition-colors"
                >
                    Komplain Produk
                </button>
                <button
                    onclick="sendQuickMessage('Saya butuh bantuan teknis')"
                    class="text-xs bg-gray-100 text-gray-700 px-3 py-1 rounded-full hover:bg-gray-200 transition-colors"
                >
                    Bantuan Teknis
                </button>
                <button
                    onclick="sendQuickMessage('Saya mau tanya tentang billing')"
                    class="text-xs bg-gray-100 text-gray-700 px-3 py-1 rounded-full hover:bg-gray-200 transition-colors"
                >
                    Pertanyaan Billing
                </button>
                <button
                    onclick="sendQuickMessage('Saya mau tanya tentang layanan')"
                    class="text-xs bg-gray-100 text-gray-700 px-3 py-1 rounded-full hover:bg-gray-200 transition-colors"
                >
                    Informasi Layanan
                </button>
            </div>
        </div>
    </div>

    <!-- AI Insights Panel -->
    <div class="mt-6 bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">
            <i class="fas fa-brain text-purple-600 mr-2"></i>
            AI Insights
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="text-center p-4 bg-purple-50 rounded-lg">
                <div class="text-2xl font-bold text-purple-600" id="ai-accuracy">-</div>
                <div class="text-sm text-gray-600">Response Accuracy</div>
            </div>
            <div class="text-center p-4 bg-green-50 rounded-lg">
                <div class="text-2xl font-bold text-green-600" id="auto-resolution">-</div>
                <div class="text-sm text-gray-600">Auto-Resolution Rate</div>
            </div>
            <div class="text-center p-4 bg-blue-50 rounded-lg">
                <div class="text-2xl font-bold text-blue-600" id="response-time">-</div>
                <div class="text-sm text-gray-600">Average Response Time</div>
            </div>
        </div>
    </div>

    <!-- Customer Info Panel -->
    <div class="mt-6 bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">
            <i class="fas fa-user text-blue-600 mr-2"></i>
            Customer Information
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="customer-name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                <input
                    type="text"
                    id="customer-name"
                    placeholder="Enter your name (optional)"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
            </div>
            <div>
                <label for="customer-email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input
                    type="email"
                    id="customer-email"
                    placeholder="Enter your email (optional)"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
let chatId = 'chat-' + Date.now();
let customerId = null;
let customerInfo = {};

document.addEventListener('DOMContentLoaded', function() {
    // Initialize chat
    initializeChat();

    // Handle form submission
    document.getElementById('chat-form').addEventListener('input', handleCustomerInfoUpdate);
    document.getElementById('chat-form').addEventListener('submit', handleMessageSubmit);

    // Load AI stats
    loadAIStats();
});

function initializeChat() {
    // Generate unique chat ID
    chatId = 'chat-' + Date.now();

    // Load customer info from localStorage if available
    const savedCustomerInfo = localStorage.getItem('customerInfo');
    if (savedCustomerInfo) {
        customerInfo = JSON.parse(savedCustomerInfo);
        document.getElementById('customer-name').value = customerInfo.name || '';
        document.getElementById('customer-email').value = customerInfo.email || '';
    }
}

function handleCustomerInfoUpdate() {
    customerInfo.name = document.getElementById('customer-name').value;
    customerInfo.email = document.getElementById('customer-email').value;

    // Save to localStorage
    localStorage.setItem('customerInfo', JSON.stringify(customerInfo));
}

function handleMessageSubmit(e) {
    e.preventDefault();

    const input = document.getElementById('message-input');
    const message = input.value.trim();

    if (!message) return;

    // Add customer message to chat
    addMessageToChat('Customer', message, 'customer');

    // Clear input
    input.value = '';

    // Send to AI service
    sendMessageToAI(message);
}

function sendQuickMessage(message) {
    document.getElementById('message-input').value = message;
    document.getElementById('chat-form').dispatchEvent(new Event('submit'));
}

function addMessageToChat(sender, message, type = 'customer') {
    const chatMessages = document.getElementById('chat-messages');
    const messageDiv = document.createElement('div');

    const isCustomer = type === 'customer';
    const bgColor = isCustomer ? 'bg-blue-600' : 'bg-gray-100';
    const textColor = isCustomer ? 'text-white' : 'text-gray-800';
    const icon = isCustomer ? 'fas fa-user' : 'fas fa-robot';
    const iconBg = isCustomer ? 'bg-blue-600' : 'bg-gray-600';

    messageDiv.innerHTML = `
        <div class="flex items-start space-x-3 ${isCustomer ? 'justify-end' : ''}">
            ${!isCustomer ? `
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 ${iconBg} rounded-full flex items-center justify-center">
                        <i class="${icon} text-white text-sm"></i>
                    </div>
                </div>
            ` : ''}
            <div class="flex-1 ${isCustomer ? 'text-right' : ''}">
                <div class="${bgColor} ${textColor} rounded-lg px-4 py-2 max-w-xs ${isCustomer ? 'ml-auto' : ''}">
                    <p class="text-sm">${message}</p>
                </div>
                <p class="text-xs text-gray-500 mt-1">Baru saja</p>
            </div>
            ${isCustomer ? `
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white text-sm"></i>
                    </div>
                </div>
            ` : ''}
        </div>
    `;

    chatMessages.appendChild(messageDiv);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

function sendMessageToAI(message) {
    // Show typing indicator
    showTypingIndicator();

    // Prepare data for AI service
    const data = {
        message: message,
        customer_id: customerId,
        context: {
            chat_id: chatId,
            customer_name: customerInfo.name,
            customer_email: customerInfo.email
        }
    };

    // Call AI service
    fetch('/api/ai/generate-response', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        hideTypingIndicator();

        if (result.ai_response) {
            addMessageToChat('AI Bot', result.ai_response, 'ai');

            // Check if escalation is needed
            if (result.needs_human_agent) {
                setTimeout(() => {
                    addMessageToChat('AI Bot', 'Saya akan menghubungkan Anda dengan agent manusia untuk penanganan lebih lanjut.', 'ai');
                    showEscalationMessage();
                }, 1000);
            }
        } else {
            // Fallback to mock response if AI service fails
            const mockResponse = generateMockResponse(message);
            addMessageToChat('AI Bot', mockResponse, 'ai');
        }
    })
    .catch(error => {
        console.error('Error calling AI service:', error);
        hideTypingIndicator();

        // Fallback to mock response
        const mockResponse = generateMockResponse(message);
        addMessageToChat('AI Bot', mockResponse, 'ai');
    });
}

function generateMockResponse(message) {
    const lowerMessage = message.toLowerCase();

    if (lowerMessage.includes('komplain') || lowerMessage.includes('rusak')) {
        return 'Mohon maaf atas ketidaknyamanannya. Saya akan buatkan ticket untuk tim kami segera menangani masalah ini. Bisa dijelaskan lebih detail?';
    }

    if (lowerMessage.includes('bantuan teknis')) {
        return 'Saya siap membantu masalah teknis Anda. Bisa dijelaskan apa yang sedang Anda alami?';
    }

    if (lowerMessage.includes('billing')) {
        return 'Untuk masalah billing, saya akan arahkan ke tim keuangan. Mohon tunggu sebentar, saya akan hubungkan dengan agent yang tepat.';
    }

    if (lowerMessage.includes('layanan')) {
        return 'Kami memiliki berbagai layanan yang bisa disesuaikan dengan kebutuhan Anda. Layanan apa yang ingin Anda ketahui?';
    }

    return 'Terima kasih atas pesan Anda. Saya akan membantu menyelesaikan masalah ini. Ada yang bisa saya bantu lebih lanjut?';
}

function showEscalationMessage() {
    const chatMessages = document.getElementById('chat-messages');
    const escalationDiv = document.createElement('div');
    escalationDiv.className = 'bg-yellow-50 border border-yellow-200 rounded-lg p-4 mt-4';
    escalationDiv.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-exclamation-triangle text-yellow-600 mr-2"></i>
            <span class="text-yellow-800 text-sm font-medium">
                Ticket telah dibuat dan akan segera ditangani oleh tim kami.
                Anda akan dihubungi dalam waktu 24 jam.
            </span>
        </div>
    `;

    chatMessages.appendChild(escalationDiv);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

function showTypingIndicator() {
    const chatMessages = document.getElementById('chat-messages');
    const typingDiv = document.createElement('div');
    typingDiv.id = 'typing-indicator';
    typingDiv.innerHTML = `
        <div class="flex items-start space-x-3">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-gray-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-robot text-white text-sm"></i>
                </div>
            </div>
            <div class="flex-1">
                <div class="bg-gray-100 rounded-lg px-4 py-2 max-w-xs">
                    <div class="flex space-x-1">
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    </div>
                </div>
            </div>
        </div>
    `;

    chatMessages.appendChild(typingDiv);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

function hideTypingIndicator() {
    const typingIndicator = document.getElementById('typing-indicator');
    if (typingIndicator) {
        typingIndicator.remove();
    }
}

function loadAIStats() {
    fetch('/api/ai/stats')
        .then(response => response.json())
        .then(data => {
            document.getElementById('ai-accuracy').textContent = data.accuracy_percentage + '%';
            document.getElementById('auto-resolution').textContent = data.auto_resolution_rate + '%';
            document.getElementById('response-time').textContent = data.avg_response_time_seconds + 's';
        })
        .catch(error => {
            console.error('Error loading AI stats:', error);
            // Set default values
            document.getElementById('ai-accuracy').textContent = '85%';
            document.getElementById('auto-resolution').textContent = '60%';
            document.getElementById('response-time').textContent = '2s';
        });
}
</script>
@endpush
@endsection
