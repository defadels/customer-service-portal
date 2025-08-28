<div
    class="bg-white shadow-xl rounded-xl flex flex-col h-full border border-gray-200 overflow-hidden"
    x-data="{
        messages: @entangle('messages'),
        isTyping: @entangle('isTyping'),
        newMessage: @entangle('newMessage'),
        init() {
            this.$watch('messages', () => {
                this.$nextTick(() => {
                    const container = this.$refs.messageContainer;
                    if (container) {
                        container.scrollTop = container.scrollHeight;
                    }
                })
            })
        }
    }"
>
    <!-- Chat Header -->
    <div class="border-b border-gray-200 p-6 bg-gradient-to-r from-blue-600 to-blue-800">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-lg">
                    <i class="fas fa-robot text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-xl font-bold text-white">AI Customer Service</h3>
                    <p class="text-blue-100 text-sm">Siap membantu 24/7</p>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 shadow-sm">
                    <i class="fas fa-circle text-green-500 text-xs mr-2 animate-pulse"></i>
                    Online
                </span>
            </div>
        </div>
    </div>

    <!-- Chat Messages -->
    <div 
        class="flex-1 overflow-y-auto p-6 space-y-4 bg-gray-50 chat-scrollbar" 
        id="chat-messages"
        x-ref="messageContainer"
        x-data="{
            scrollToBottom() {
                this.$el.scrollTop = this.$el.scrollHeight;
            }
        }"
        x-init="scrollToBottom"
        @chatUpdated="scrollToBottom"
    >
        @if(count($messages) == 0)
            <!-- Welcome Message -->
            <div class="chat-message animate-fade-in">
                <div class="chat-message-avatar ai">
                    <i class="fas fa-robot text-white text-lg"></i>
                </div>
                <div class="chat-message-bubble ai message-shadow">
                    <p class="text-gray-800 text-sm leading-relaxed">
                        Halo! Saya adalah asisten AI yang siap membantu Anda. Ada yang bisa saya bantu hari ini?
                    </p>
                    <p class="text-xs text-gray-500 mt-2">Ketik pesan Anda di bawah untuk memulai percakapan.</p>
                </div>
            </div>
        @endif

        @foreach($messages as $message)
            <div class="chat-message {{ $message->sender_type == 'Customer' ? 'user' : '' }} animate-fade-in">
                @if($message->sender_type != 'Customer')
                    <div class="chat-message-avatar {{ $message->sender_type == 'AI Bot' ? 'ai' : 'agent' }}">
                        <i class="fas {{ $message->sender_type == 'AI Bot' ? 'fa-robot' : 'fa-headset' }} text-white text-lg"></i>
                    </div>
                @endif

                <div class="chat-message-bubble {{ $message->sender_type == 'Customer' ? 'user' : ($message->sender_type == 'AI Bot' ? 'ai' : 'agent') }} message-shadow">
                    @if($message->sender_type == 'AI Bot')
                        <div class="absolute -top-2 left-0 px-3 py-1 rounded-full bg-blue-100 text-blue-600 text-xs font-medium transform -translate-y-full opacity-0 group-hover:opacity-100 transition-opacity">
                            AI Assistant
                        </div>
                    @endif
                    <p class="text-sm leading-relaxed">{{ $message->message }}</p>
                    <p class="text-xs {{ $message->sender_type == 'Customer' ? 'text-blue-200' : 'text-gray-400' }} mt-2">
                        {{ $message->created_at->format('H:i') }}
                    </p>
                </div>

                @if($message->sender_type == 'Customer')
                    <div class="chat-message-avatar user">
                        <i class="fas fa-user text-white text-lg"></i>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <!-- Typing Indicator -->
    <div x-show="isTyping" x-cloak class="p-6">
        <div class="chat-message">
            <div class="chat-message-avatar ai">
                <i class="fas fa-robot text-white text-lg"></i>
            </div>
            <div class="chat-message-bubble ai message-shadow">
                <div class="flex space-x-2">
                    <div class="w-3 h-3 bg-gray-500 rounded-full animate-bounce"></div>
                    <div class="w-3 h-3 bg-gray-500 rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
                    <div class="w-3 h-3 bg-gray-500 rounded-full animate-bounce" style="animation-delay: 0.4s;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Message -->
    @if($error)
        <div class="p-4 bg-red-50 border-l-4 border-red-500">
            <div class="flex items-center">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">{{ $error }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Chat Input -->
    <div class="border-t border-gray-200 p-6 bg-white">
        <div class="flex items-center space-x-3">
            <div class="relative flex-1">
                <input 
                    type="text"
                    x-model="newMessage"
                    placeholder="Ketik pesan Anda..."
                    class="chat-input-field"
                    :disabled="isTyping"
                    @keydown.enter.prevent="sendMessage()"
                    autofocus
                >
                <button 
                    type="button"
                    @click="sendMessage()"
                    class="chat-send-btn"
                    :disabled="isTyping || !newMessage.trim()"
                >
                    <i class="fas fa-paper-plane text-sm"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function sendMessage() {
    const message = document.querySelector('[x-model="newMessage"]').value.trim();
    if (!message) return;
    
    // Call Livewire method
    @this.sendMessage();
}
</script>
