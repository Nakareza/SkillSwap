@extends('layouts.app')

@section('content')
<div class="py-12 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Messages</h1>
            <p class="text-gray-600 mt-2">Your conversations with other members</p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Search Bar -->
            <div class="p-6 bg-gradient-to-r from-blue-600 to-purple-600">
                <div class="relative">
                    <input type="text" id="search-conversations" placeholder="Search conversations..." class="w-full px-4 py-3 pl-12 rounded-xl border-0 focus:ring-2 focus:ring-white focus:ring-opacity-50 bg-white bg-opacity-90">
                    <svg class="absolute left-4 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <!-- Conversations List -->
            <div class="divide-y divide-gray-100">
                @forelse($conversations as $conversation)
                <a href="{{ route('messages.show', $conversation->other_user->id) }}" class="block hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 transition">
                    <div class="p-6 flex items-center space-x-4">
                        <!-- Avatar -->
                        <div class="relative flex-shrink-0">
                            <div class="h-14 w-14 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white text-xl font-bold shadow-lg">
                                {{ substr($conversation->other_user->name, 0, 1) }}
                            </div>
                            @if($conversation->unread_count > 0)
                            <span class="absolute -top-1 -right-1 h-6 w-6 bg-red-500 rounded-full flex items-center justify-center text-white text-xs font-bold shadow-lg">
                                {{ $conversation->unread_count }}
                            </span>
                            @endif
                        </div>

                        <!-- Message Info -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between mb-1">
                                <h3 class="text-lg font-semibold text-gray-900 truncate">
                                    {{ $conversation->other_user->name }}
                                </h3>
                                <span class="text-xs text-gray-500">
                                    {{ $conversation->last_message_at ? $conversation->last_message_at->diffForHumans() : '' }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-600 truncate {{ $conversation->unread_count > 0 ? 'font-semibold' : '' }}">
                                @if($conversation->lastMessage)
                                    {{ $conversation->lastMessage->sender_id == Auth::id() ? 'You: ' : '' }}
                                    {{ $conversation->lastMessage->content }}
                                @else
                                    Start a conversation
                                @endif
                            </p>
                        </div>

                        <!-- Arrow Icon -->
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>
                @empty
                <div class="px-6 py-20 text-center">
                    <svg class="mx-auto h-20 w-20 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No conversations yet</h3>
                    <p class="text-gray-600 mb-6">Start chatting with other members to see your conversations here</p>
                    <a href="{{ route('match.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-purple-700 transition shadow-lg">
                        Find Matches
                        <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($conversations->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $conversations->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<script>
// Search functionality
document.getElementById('search-conversations').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const conversations = document.querySelectorAll('[href*="messages"]');
    
    conversations.forEach(conv => {
        const name = conv.querySelector('h3').textContent.toLowerCase();
        const message = conv.querySelector('p').textContent.toLowerCase();
        
        if (name.includes(searchTerm) || message.includes(searchTerm)) {
            conv.style.display = 'block';
        } else {
            conv.style.display = 'none';
        }
    });
});
</script>
@endsection
