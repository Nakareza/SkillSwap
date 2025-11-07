@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Profile Header -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg shadow-lg p-8 mb-6 text-white">
            <div class="flex items-center space-x-6">
                <div class="relative">
                    <div class="h-24 w-24 rounded-full bg-white flex items-center justify-center shadow-lg overflow-hidden">
                        @if($user->avatar)
                            <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                        @else
                            <svg class="h-16 w-16 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        @endif
                    </div>
                    <form id="avatar-form" method="POST" action="{{ route('profile.avatar') }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input type="file" id="avatar-upload" name="avatar" accept="image/*" style="display: none;" onchange="this.form.submit()">
                        <label for="avatar-upload" class="absolute bottom-0 right-0 bg-blue-500 rounded-full p-2 shadow-lg hover:bg-blue-600 transition cursor-pointer">
                            <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </label>
                    </form>
                </div>
                <div class="flex-1">
                    <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
                    <p class="text-blue-100 mt-1">{{ $user->email }}</p>
                    <div class="flex items-center space-x-4 mt-3">
                        <div class="flex items-center space-x-2">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="font-semibold">{{ number_format($user->average_rating, 2) }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="font-semibold">{{ $user->points }} Points</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Profile Info -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Edit Profile Form -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg glass-effect">
                    <div class="px-6 py-5 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                            <svg class="h-5 w-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Personal Information
                        </h3>
                    </div>
                    <div class="px-6 py-5">
                        @if(session('success'))
                            <div class="mb-4 bg-green-50 border-l-4 border-green-400 p-4 rounded">
                                <div class="flex">
                                    <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <p class="ml-3 text-sm text-green-700">{{ session('success') }}</p>
                                </div>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-3 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-3 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                                    <textarea id="bio" name="bio" rows="4" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-3 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition" placeholder="Tell us about yourself...">{{ old('bio', $user->bio) }}</textarea>
                                    @error('bio')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- My Skills Section -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg glass-effect">
                    <div class="px-6 py-5 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                <svg class="h-5 w-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                </svg>
                                My Skills
                            </h3>
                            <button onclick="document.getElementById('addSkillModal').classList.remove('hidden')" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Add Skill
                            </button>
                        </div>
                    </div>
                    <div class="px-6 py-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Skills I Offer -->
                            <div>
                                <h4 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                    <span class="inline-block w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                                    Skills I Offer
                                </h4>
                                <div class="flex flex-wrap gap-2">
                                    @forelse($offeredSkills as $skill)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            {{ $skill->name }}
                                            <form method="POST" action="{{ route('skills.remove', $skill->pivot->id ?? $skill->id) }}" class="inline ml-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-green-600 hover:text-green-800">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </span>
                                    @empty
                                        <p class="text-sm text-gray-500">No skills offered yet.</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Skills I Need -->
                            <div>
                                <h4 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                    <span class="inline-block w-3 h-3 bg-blue-500 rounded-full mr-2"></span>
                                    Skills I Need
                                </h4>
                                <div class="flex flex-wrap gap-2">
                                    @forelse($neededSkills as $skill)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            {{ $skill->name }}
                                            <form method="POST" action="{{ route('skills.remove', $skill->pivot->id ?? $skill->id) }}" class="inline ml-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-blue-600 hover:text-blue-800">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </span>
                                    @empty
                                        <p class="text-sm text-gray-500">No skills needed yet.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Stats & Activity -->
            <div class="space-y-6">
                <!-- Stats Card -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg glass-effect">
                    <div class="px-6 py-5 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                            <svg class="h-5 w-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Statistics
                        </h3>
                    </div>
                    <div class="px-6 py-5 space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Total Points</span>
                            <span class="text-lg font-bold text-blue-600">{{ $user->points }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Average Rating</span>
                            <span class="text-lg font-bold text-yellow-500">{{ number_format($user->average_rating, 2) }} ⭐</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Tasks Created</span>
                            <span class="text-lg font-bold text-purple-600">{{ $createdTasksCount }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Tasks Completed</span>
                            <span class="text-lg font-bold text-green-600">{{ $completedTasksCount }}</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg glass-effect">
                    <div class="px-6 py-5 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Quick Actions</h3>
                    </div>
                    <div class="px-6 py-5 space-y-3">
                        <a href="{{ route('match.index') }}" class="flex items-center p-3 rounded-lg hover:bg-blue-50 transition">
                            <svg class="h-6 w-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Find Matches</span>
                        </a>
                        <a href="{{ route('tasks.index') }}" class="flex items-center p-3 rounded-lg hover:bg-green-50 transition">
                            <svg class="h-6 w-6 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Browse Tasks</span>
                        </a>
                        <a href="{{ route('leaderboard') }}" class="flex items-center p-3 rounded-lg hover:bg-yellow-50 transition">
                            <svg class="h-6 w-6 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">View Leaderboard</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Skill Modal -->
    <div id="addSkillModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-lg bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-lg font-medium text-gray-900">Add New Skill</h3>
                    <button class="text-gray-500 hover:text-gray-700" onclick="document.getElementById('addSkillModal').classList.add('hidden')">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <form method="POST" action="{{ route('skills.add') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="skill_id" class="block text-sm font-medium text-gray-700">Select Skill</label>
                        <select name="skill_id" id="skill_id" required class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">Choose a skill...</option>
                            @foreach($allSkills as $skill)
                                <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                        <div class="flex space-x-4">
                            <label class="flex items-center">
                                <input type="radio" name="type" value="offer" required class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                                <span class="ml-2 text-sm text-gray-700">I Offer This</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="type" value="need" required class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                                <span class="ml-2 text-sm text-gray-700">I Need This</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 focus:outline-none" onclick="document.getElementById('addSkillModal').classList.add('hidden')">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none">
                            Add Skill
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
