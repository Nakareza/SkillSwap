@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-blue-50 to-purple-50 min-h-screen">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl mb-6">
            <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 px-6 py-8">
                <h1 class="text-3xl font-bold text-white">Leave a Review</h1>
                <p class="text-blue-100 mt-1">Share your experience with {{ $user->name }}</p>
            </div>
        </div>

        <!-- Review Form -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl">
            <div class="p-8">
                <!-- Task Info -->
                <div class="mb-8 p-4 bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl border border-blue-100">
                    <h3 class="font-semibold text-gray-800 mb-2">Task: {{ $task->title }}</h3>
                    <p class="text-sm text-gray-600">{{ $task->description }}</p>
                </div>

                <!-- User Info -->
                <div class="mb-8 flex items-center space-x-4">
                    <div class="h-16 w-16 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Reviewing</p>
                        <p class="text-lg font-semibold text-gray-800">{{ $user->name }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('reviews.store') }}">
                    @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <input type="hidden" name="to_user_id" value="{{ $user->id }}">

                    <!-- Rating -->
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-3">Rating</label>
                        <div class="flex items-center space-x-2" x-data="{ rating: 0, hover: 0 }">
                            <input type="hidden" name="rating" x-model="rating" required>
                            
                            @for($i = 1; $i <= 5; $i++)
                            <button 
                                type="button"
                                @click="rating = {{ $i }}"
                                @mouseenter="hover = {{ $i }}"
                                @mouseleave="hover = 0"
                                class="focus:outline-none transition-transform hover:scale-110">
                                <svg 
                                    :class="(hover >= {{ $i }} || rating >= {{ $i }}) ? 'text-yellow-400' : 'text-gray-300'"
                                    class="h-12 w-12 transition-colors duration-200" 
                                    fill="currentColor" 
                                    viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg>
                            </button>
                            @endfor
                            
                            <span class="ml-4 text-gray-600 font-medium" x-show="rating > 0">
                                <span x-text="rating"></span> / 5 stars
                            </span>
                        </div>
                        @error('rating')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Feedback -->
                    <div class="mb-6">
                        <label for="feedback" class="block text-gray-700 text-sm font-bold mb-2">
                            Feedback <span class="text-gray-400 font-normal">(Optional)</span>
                        </label>
                        <textarea 
                            name="feedback" 
                            id="feedback" 
                            rows="5"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition resize-none"
                            placeholder="Share your experience working with {{ $user->name }}...">{{ old('feedback') }}</textarea>
                        @error('feedback')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-2">Maximum 1000 characters</p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-between pt-6 border-t">
                        <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition">
                            Cancel
                        </a>
                        <button 
                            type="submit" 
                            class="px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold rounded-lg shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                            Submit Review
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Guidelines -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-6">
            <h3 class="font-semibold text-blue-900 mb-3 flex items-center">
                <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
                Review Guidelines
            </h3>
            <ul class="text-sm text-blue-800 space-y-2">
                <li class="flex items-start">
                    <svg class="h-5 w-5 text-blue-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Be honest and constructive in your feedback
                </li>
                <li class="flex items-start">
                    <svg class="h-5 w-5 text-blue-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Focus on the quality of work and communication
                </li>
                <li class="flex items-start">
                    <svg class="h-5 w-5 text-blue-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Keep it professional and respectful
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
