@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 px-6 py-8">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-white">Notifications</h1>
                        <p class="text-blue-100 mt-1">Stay updated with your latest activities</p>
                    </div>
                    <div class="flex space-x-3">
                        @if($notifications->where('is_read', false)->count() > 0)
                        <form action="{{ route('notifications.readAll') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg font-medium transition backdrop-blur-sm">
                                Mark All Read
                            </button>
                        </form>
                        @endif
                        @if($notifications->where('is_read', true)->count() > 0)
                        <form action="{{ route('notifications.clearRead') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500/80 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium transition">
                                Clear Read
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Notifications List -->
            <div class="divide-y divide-gray-100">
                @forelse($notifications as $notification)
                <div class="px-6 py-4 hover:bg-gray-50 transition {{ !$notification->is_read ? 'bg-blue-50' : '' }}">
                    <div class="flex items-start space-x-4">
                        <!-- Icon -->
                        <div class="flex-shrink-0">
                            <div class="h-12 w-12 rounded-full bg-gradient-to-br {{ $notification->icon == 'check' ? 'from-green-400 to-green-600' : ($notification->icon == 'star' ? 'from-yellow-400 to-orange-500' : ($notification->icon == 'message' ? 'from-blue-400 to-blue-600' : 'from-purple-400 to-purple-600')) }} flex items-center justify-center shadow-lg">
                                @if($notification->icon == 'check')
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                @elseif($notification->icon == 'star')
                                <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg>
                                @elseif($notification->icon == 'message')
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                                @else
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                @endif
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-gray-900 flex items-center">
                                        {{ $notification->title }}
                                        @if(!$notification->is_read)
                                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-600 text-white">
                                            New
                                        </span>
                                        @endif
                                    </p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $notification->message }}</p>
                                    <p class="mt-1 text-xs text-gray-400">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>

                                <!-- Actions -->
                                <div class="ml-4 flex-shrink-0 flex space-x-2">
                                    @if(!$notification->is_read)
                                    <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-blue-600 hover:text-blue-800 text-xs font-medium">
                                            Mark Read
                                        </button>
                                    </form>
                                    @endif
                                    <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-medium">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Link Button -->
                            @if($notification->link)
                            <div class="mt-3">
                                <a href="{{ $notification->link }}" class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-blue-500 to-purple-500 text-white text-xs font-medium rounded-lg hover:from-blue-600 hover:to-purple-600 transition">
                                    View Details
                                    <svg class="ml-1 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="px-6 py-16 text-center">
                    <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">No notifications yet</h3>
                    <p class="text-sm text-gray-500">When you receive notifications, they will appear here</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($notifications->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $notifications->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
