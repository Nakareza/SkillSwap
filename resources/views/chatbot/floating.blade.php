<!-- AI Chatbot Floating Button -->
<div id="chatbot-container" class="fixed bottom-6 right-6 z-50">
    <!-- Chat Button -->
    <button id="chatbot-toggle" class="group relative w-16 h-16 bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600 rounded-full shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-110 flex items-center justify-center">
        <svg id="chat-icon" class="w-8 h-8 text-white transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
        </svg>
        <svg id="close-icon" class="w-8 h-8 text-white hidden transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        
        <!-- Pulse Animation -->
        <span class="absolute inset-0 rounded-full bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600 animate-ping opacity-75"></span>
    </button>

    <!-- Chat Window -->
    <div id="chatbot-window" class="hidden absolute bottom-20 right-0 w-96 h-[600px] bg-white rounded-2xl shadow-2xl border border-gray-200 flex flex-col overflow-hidden transform transition-all duration-300 opacity-0 scale-95">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 p-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-white bg-opacity-20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-white font-bold text-lg">AI Assistant</h3>
                    <p class="text-blue-100 text-xs">Powered by Google Gemini</p>
                </div>
            </div>
            <button id="clear-chat" class="text-white hover:text-blue-100 transition-colors" title="Clear chat">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>
        </div>

        <!-- Messages Container -->
        <div id="chat-messages" class="flex-1 overflow-y-auto p-4 space-y-4 bg-gradient-to-br from-gray-50 to-blue-50">
            <!-- Welcome message -->
            <div class="flex items-start space-x-3">
                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="bg-white rounded-2xl rounded-tl-none p-4 shadow-md max-w-xs">
                    <p class="text-sm text-gray-700">👋 Hi! I'm your AI assistant. I can help you with:</p>
                    <ul class="text-xs text-gray-600 mt-2 space-y-1">
                        <li>• Skill recommendations</li>
                        <li>• Task suggestions</li>
                        <li>• Tips to earn more points</li>
                        <li>• General platform guidance</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Typing Indicator -->
        <div id="typing-indicator" class="hidden px-4 py-2">
            <div class="flex items-start space-x-3">
                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="bg-white rounded-2xl rounded-tl-none p-4 shadow-md">
                    <div class="flex space-x-2">
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0ms"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 150ms"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 300ms"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Input Form -->
        <form id="chat-form" class="p-4 bg-white border-t border-gray-200">
            <div class="flex space-x-2">
                <input 
                    type="text" 
                    id="chat-input" 
                    placeholder="Ask me anything..." 
                    class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent text-sm"
                    required
                    maxlength="1000"
                >
                <button 
                    type="submit" 
                    id="send-button"
                    class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.getElementById('chatbot-toggle');
    const window = document.getElementById('chatbot-window');
    const chatIcon = document.getElementById('chat-icon');
    const closeIcon = document.getElementById('close-icon');
    const form = document.getElementById('chat-form');
    const input = document.getElementById('chat-input');
    const messages = document.getElementById('chat-messages');
    const typing = document.getElementById('typing-indicator');
    const clearBtn = document.getElementById('clear-chat');

    let isOpen = false;

    // Toggle chat window
    toggle.addEventListener('click', function() {
        isOpen = !isOpen;
        
        if (isOpen) {
            window.classList.remove('hidden');
            setTimeout(() => {
                window.classList.remove('opacity-0', 'scale-95');
                window.classList.add('opacity-100', 'scale-100');
            }, 10);
            chatIcon.classList.add('hidden');
            closeIcon.classList.remove('hidden');
            input.focus();
        } else {
            window.classList.remove('opacity-100', 'scale-100');
            window.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                window.classList.add('hidden');
            }, 300);
            chatIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
        }
    });

    // Send message
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const message = input.value.trim();
        if (!message) return;

        // Add user message to chat
        addMessage(message, 'user');
        input.value = '';

        // Show typing indicator
        typing.classList.remove('hidden');
        scrollToBottom();

        try {
            const response = await fetch('{{ route("chatbot.chat") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message })
            });

            const data = await response.json();
            
            // Hide typing indicator
            typing.classList.add('hidden');

            if (data.success) {
                addMessage(data.message, 'assistant');
            } else {
                addMessage('Sorry, I encountered an error. Please try again.', 'assistant');
            }
        } catch (error) {
            typing.classList.add('hidden');
            addMessage('Sorry, something went wrong. Please try again later.', 'assistant');
        }
    });

    // Clear chat history
    clearBtn.addEventListener('click', async function() {
        if (!confirm('Are you sure you want to clear the chat history?')) return;

        try {
            const response = await fetch('{{ route("chatbot.clear") }}', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            if (response.ok) {
                messages.innerHTML = `
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="bg-white rounded-2xl rounded-tl-none p-4 shadow-md max-w-xs">
                            <p class="text-sm text-gray-700">👋 Chat history cleared! How can I help you?</p>
                        </div>
                    </div>
                `;
            }
        } catch (error) {
            console.error('Error clearing chat:', error);
        }
    });

    function addMessage(content, role) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'flex items-start space-x-3 animate-fade-in';
        
        if (role === 'user') {
            messageDiv.classList.add('flex-row-reverse', 'space-x-reverse');
            messageDiv.innerHTML = `
                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-gray-600 to-gray-700 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-2xl rounded-tr-none p-4 shadow-md max-w-xs">
                    <p class="text-sm">${escapeHtml(content)}</p>
                </div>
            `;
        } else {
            messageDiv.innerHTML = `
                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="bg-white rounded-2xl rounded-tl-none p-4 shadow-md max-w-xs">
                    <p class="text-sm text-gray-700">${escapeHtml(content)}</p>
                </div>
            `;
        }
        
        messages.appendChild(messageDiv);
        scrollToBottom();
    }

    function scrollToBottom() {
        messages.scrollTop = messages.scrollHeight;
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
});
</script>

<style>
@keyframes fade-in {
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
    animation: fade-in 0.3s ease-out;
}
</style>
