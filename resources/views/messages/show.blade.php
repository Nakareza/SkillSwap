@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col h-[calc(100vh-8rem)]">
            <!-- Chat Header -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-4 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('messages.index') }}" class="text-white hover:text-blue-100 transition">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <div class="h-12 w-12 rounded-full bg-white bg-opacity-20 flex items-center justify-center text-white text-xl font-bold">
                        {{ substr($otherUser->name, 0, 1) }}
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">{{ $otherUser->name }}</h2>
                        <p class="text-blue-100 text-sm">{{ $otherUser->email }}</p>
                    </div>
                </div>
                <a href="{{ route('profile.show', $otherUser->id) }}" class="px-4 py-2 bg-white bg-opacity-20 hover:bg-opacity-30 text-white rounded-lg transition text-sm font-medium">
                    View Profile
                </a>
            </div>

            <!-- Messages Container -->
            <div id="messages-container" class="flex-1 overflow-y-auto p-6 space-y-4 bg-gray-50">
                @foreach($messages as $message)
                <div class="flex {{ $message->sender_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-md {{ $message->sender_id == Auth::id() ? 'order-2' : 'order-1' }}">
                        <div class="flex items-end space-x-2 {{ $message->sender_id == Auth::id() ? 'flex-row-reverse space-x-reverse' : '' }}">
                            <!-- Avatar -->
                            <div class="h-8 w-8 rounded-full {{ $message->sender_id == Auth::id() ? 'bg-gradient-to-br from-blue-500 to-purple-500' : 'bg-gradient-to-br from-gray-400 to-gray-600' }} flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                {{ substr($message->sender->name, 0, 1) }}
                            </div>
                            
                            <!-- Message Bubble -->
                            <div>
                                <div class="px-4 py-2 rounded-2xl {{ $message->sender_id == Auth::id() ? 'bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-br-none' : 'bg-white text-gray-800 shadow-md rounded-bl-none' }}">
                                    <p class="text-sm break-words">{{ $message->content }}</p>
                                    
                                    @if($message->attachment)
                                    <a href="{{ Storage::url($message->attachment) }}" target="_blank" class="mt-2 inline-flex items-center text-xs {{ $message->sender_id == Auth::id() ? 'text-blue-100 hover:text-white' : 'text-blue-600 hover:text-blue-800' }}">
                                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                        </svg>
                                        Attachment
                                    </a>
                                    @endif
                                </div>
                                <p class="text-xs text-gray-500 mt-1 {{ $message->sender_id == Auth::id() ? 'text-right' : 'text-left' }}">
                                    {{ $message->created_at->format('H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Message Input -->
            <div class="bg-white border-t border-gray-200 p-4">
                <form action="{{ route('messages.store') }}" method="POST" enctype="multipart/form-data" id="message-form" class="flex items-end space-x-3">
                    @csrf
                    <input type="hidden" name="receiver_id" value="{{ $otherUser->id }}">
                    
                    <!-- Attachment Button -->
                    <label for="attachment" class="cursor-pointer p-3 text-gray-400 hover:text-blue-600 transition flex-shrink-0">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                        </svg>
                    </label>
                    <input type="file" id="attachment" name="attachment" class="hidden" accept="image/*,.pdf,.doc,.docx">
                    
                    <!-- Message Input -->
                    <div class="flex-1 relative">
                        <textarea 
                            name="content" 
                            id="message-input"
                            rows="1"
                            placeholder="Type your message..."
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-0 resize-none"
                            required
                            maxlength="5000"
                        ></textarea>
                        <span id="attachment-indicator" class="hidden absolute bottom-2 left-4 text-xs text-blue-600 bg-blue-50 px-2 py-1 rounded">
                            📎 File attached
                        </span>
                    </div>
                    
                    <!-- Send Button -->
                    <button type="submit" class="p-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-xl transition flex-shrink-0 shadow-lg">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-resize textarea
const messageInput = document.getElementById('message-input');
messageInput.addEventListener('input', function() {
    this.style.height = 'auto';
    this.style.height = (this.scrollHeight) + 'px';
});

// Auto-scroll to bottom
const messagesContainer = document.getElementById('messages-container');
messagesContainer.scrollTop = messagesContainer.scrollHeight;

// File attachment indicator
const attachmentInput = document.getElementById('attachment');
const attachmentIndicator = document.getElementById('attachment-indicator');

attachmentInput.addEventListener('change', function() {
    if (this.files.length > 0) {
        attachmentIndicator.textContent = '📎 ' + this.files[0].name;
        attachmentIndicator.classList.remove('hidden');
    } else {
        attachmentIndicator.classList.add('hidden');
    }
});

// Enter to send (Shift+Enter for new line)
messageInput.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        document.getElementById('message-form').submit();
    }
});

// Auto-refresh messages every 5 seconds
setInterval(function() {
    fetch('{{ route('messages.fetch', $otherUser->id) }}')
        .then(response => response.json())
        .then(data => {
            // You can implement real-time message updates here
            // For now, we'll reload on new messages
        });
}, 5000);

// Mark messages as read when viewing
fetch('{{ route('messages.markRead', $otherUser->id) }}', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    }
});
</script>
@endsection
