@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Find Skill Matches</h1>
                <p class="text-gray-600 mt-2">Connect with people who have the skills you need and need the skills you have</p>
            </div>
            
            @if($matches->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($matches as $match)
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                            <!-- Gradient Header -->
                            <div class="h-24 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 relative">
                                <div class="absolute inset-0 bg-black opacity-10"></div>
                            </div>
                            
                            <div class="px-6 pb-6 -mt-12 relative">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <a href="{{ route('profile.show', $match->id) }}">
                                            <div class="h-20 w-20 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold text-3xl hover:scale-110 transition shadow-xl border-4 border-white">
                                                {{ substr($match->name, 0, 1) }}
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="mt-4 text-center">
                                    <a href="{{ route('profile.show', $match->id) }}" class="text-xl font-bold text-gray-900 hover:text-blue-600 transition">
                                        {{ $match->name }}
                                    </a>
                                    <div class="flex items-center justify-center space-x-3 mt-2">
                                        <div class="flex items-center space-x-1">
                                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                            </svg>
                                            <span class="text-sm font-semibold text-gray-700">{{ number_format($match->average_rating, 1) }}</span>
                                        </div>
                                        <span class="text-gray-400">•</span>
                                        <div class="flex items-center space-x-1">
                                            <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-sm font-semibold text-gray-700">{{ $match->points }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-6 space-y-4">
                                    <div>
                                        <div class="flex items-center space-x-2 mb-2">
                                            <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <h4 class="text-sm font-bold text-gray-900">Can Help With:</h4>
                                        </div>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($match->offeredSkills as $skill)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-green-100 to-emerald-100 text-green-800">
                                                    {{ $skill->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <div class="flex items-center space-x-2 mb-2">
                                            <svg class="h-5 w-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                            <h4 class="text-sm font-bold text-gray-900">Looking For:</h4>
                                        </div>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($match->neededSkills as $skill)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-orange-100 to-red-100 text-orange-800">
                                                    {{ $skill->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-6 grid grid-cols-2 gap-3">
                                    <a href="{{ route('profile.show', $match->id) }}" class="inline-flex justify-center items-center px-4 py-2.5 border-2 border-blue-200 text-sm font-semibold rounded-xl text-blue-700 bg-blue-50 hover:bg-blue-100 hover:border-blue-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Profile
                                    </a>
                                    <a href="{{ route('messages.start', $match->id) }}" class="inline-flex justify-center items-center px-4 py-2.5 text-sm font-semibold rounded-xl shadow-lg text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition transform hover:scale-105">
                                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                        Message
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-3xl shadow-xl p-12 text-center">
                    <div class="mx-auto h-32 w-32 rounded-full bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center mb-6">
                        <svg class="h-16 w-16 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No matches found yet</h3>
                    <p class="text-gray-600 mb-6">
                        Add more skills to your profile to find potential matches for skill swapping.
                    </p>
                    <a href="{{ route('profile.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-purple-700 transition shadow-lg">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Skills to Profile
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection