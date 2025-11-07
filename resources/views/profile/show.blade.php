@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Profile Header -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden mb-8">
            <div class="relative h-48 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600">
                <div class="absolute inset-0 bg-black opacity-20"></div>
            </div>
            
            <div class="relative px-8 pb-8">
                <div class="flex flex-col sm:flex-row items-center sm:items-end -mt-20 sm:-mt-16">
                    <!-- Avatar -->
                    <div class="relative">
                        <div class="h-32 w-32 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white text-5xl font-bold shadow-2xl border-4 border-white overflow-hidden">
                            @if($user->avatar)
                                <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                            @else
                                {{ substr($user->name, 0, 1) }}
                            @endif
                        </div>
                        @if($user->average_rating > 0)
                        <div class="absolute -bottom-2 -right-2 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full px-3 py-1 shadow-lg">
                            <div class="flex items-center space-x-1">
                                <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg>
                                <span class="text-white font-bold text-sm">{{ number_format($user->average_rating, 1) }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <!-- User Info -->
                    <div class="mt-6 sm:mt-0 sm:ml-8 flex-1 text-center sm:text-left">
                        <h1 class="text-4xl font-bold text-gray-900">{{ $user->name }}</h1>
                        <p class="text-gray-600 text-lg mt-1">{{ $user->email }}</p>
                        <div class="flex flex-wrap justify-center sm:justify-start gap-4 mt-4">
                            <div class="flex items-center space-x-2 text-gray-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-semibold">{{ $user->points }} Points</span>
                            </div>
                            <div class="flex items-center space-x-2 text-gray-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ $stats['tasks_completed'] }} Tasks Completed</span>
                            </div>
                            <div class="flex items-center space-x-2 text-gray-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.539-1.118l1.519-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                                <span>{{ $stats['reviews_count'] }} Reviews</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    @if(Auth::id() !== $user->id)
                    <div class="mt-6 sm:mt-0 flex gap-3">
                        <a href="{{ route('messages.start', $user->id) }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg transition">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            Send Message
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Stats & Skills -->
            <div class="space-y-6">
                <!-- Stats Cards -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Statistics</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Tasks Created</span>
                            <span class="font-bold text-blue-600 text-xl">{{ $stats['tasks_created'] }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Tasks Completed</span>
                            <span class="font-bold text-green-600 text-xl">{{ $stats['tasks_completed'] }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Total Reviews</span>
                            <span class="font-bold text-purple-600 text-xl">{{ $stats['reviews_count'] }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Average Rating</span>
                            <div class="flex items-center space-x-2">
                                <span class="font-bold text-yellow-600 text-xl">{{ number_format($user->average_rating, 1) }}</span>
                                <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Skills Offered -->
                @if($user->offeredSkills->count() > 0)
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Skills Offered</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($user->offeredSkills as $skill)
                        <span class="px-4 py-2 bg-gradient-to-r from-green-100 to-emerald-100 text-green-700 rounded-full text-sm font-medium">
                            {{ $skill->name }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Skills Needed -->
                @if($user->neededSkills->count() > 0)
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Skills Needed</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($user->neededSkills as $skill)
                        <span class="px-4 py-2 bg-gradient-to-r from-orange-100 to-red-100 text-orange-700 rounded-full text-sm font-medium">
                            {{ $skill->name }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column - Reviews & Activities -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Reviews Section -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-900">Recent Reviews</h3>
                        @if($stats['reviews_count'] > 5)
                        <a href="{{ route('reviews.index', $user->id) }}" class="text-blue-600 hover:text-blue-700 font-medium">
                            View All →
                        </a>
                        @endif
                    </div>

                    @forelse($reviews as $review)
                    <div class="border-b border-gray-100 last:border-0 py-4 first:pt-0">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold">
                                    {{ substr($review->fromUser->name, 0, 1) }}
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <h4 class="font-semibold text-gray-900">{{ $review->fromUser->name }}</h4>
                                        <p class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        @for($i = 1; $i <= 5; $i++)
                                        <svg class="h-5 w-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-gray-700">{{ $review->feedback }}</p>
                                @if($review->task)
                                <p class="text-sm text-gray-500 mt-2">
                                    Task: <span class="font-medium">{{ $review->task->title }}</span>
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12">
                        <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.539-1.118l1.519-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                        <h4 class="text-lg font-medium text-gray-900 mb-1">No reviews yet</h4>
                        <p class="text-gray-600">This user hasn't received any reviews</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
