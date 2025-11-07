@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 shadow-2xl mb-8 z-10">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="relative px-8 py-12">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="text-white mb-6 md:mb-0">
                        <div class="flex items-center space-x-3 mb-3">
                            <div class="w-16 h-16 rounded-full bg-white bg-opacity-20 backdrop-blur-lg flex items-center justify-center overflow-hidden">
                                @if($user->avatar)
                                    <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                                @else
                                    <span class="text-3xl font-bold text-white">{{ substr($user->name, 0, 1) }}</span>
                                @endif
                            </div>
                            <div>
                                <h1 class="text-4xl font-bold tracking-tight">Welcome back!</h1>
                                <p class="text-xl text-blue-100 mt-1">{{ $user->name }}</p>
                            </div>
                        </div>
                        <p class="text-blue-50 text-lg">Ready to swap some skills and earn rewards today?</p>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <div class="bg-white bg-opacity-20 backdrop-blur-lg rounded-2xl px-6 py-4 text-center border border-white border-opacity-30">
                            <div class="text-3xl font-bold text-white">{{ $user->points }}</div>
                            <div class="text-sm text-blue-100 font-medium">Points</div>
                        </div>
                        <div class="bg-white bg-opacity-20 backdrop-blur-lg rounded-2xl px-6 py-4 text-center border border-white border-opacity-30">
                            <div class="text-3xl font-bold text-white">{{ number_format($user->average_rating, 1) }}</div>
                            <div class="text-sm text-blue-100 font-medium">Rating </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolute -right-8 -bottom-8 w-40 h-40 bg-white rounded-full opacity-10"></div>
            <div class="absolute -left-8 -top-8 w-32 h-32 bg-white rounded-full opacity-10"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 group-hover:text-white transition-colors duration-300">{{ $createdTasks->count() }}</h3>
                    <p class="text-gray-600 text-sm font-medium mt-1 group-hover:text-blue-100 transition-colors duration-300">Tasks Created</p>
                </div>
            </div>

            <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="absolute inset-0 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 group-hover:text-white transition-colors duration-300">{{ $acceptedTasks->where('status', 'done')->count() }}</h3>
                    <p class="text-gray-600 text-sm font-medium mt-1 group-hover:text-green-100 transition-colors duration-300">Tasks Completed</p>
                </div>
            </div>

            <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="absolute inset-0 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-yellow-500 to-orange-600 flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 group-hover:text-white transition-colors duration-300">{{ $acceptedTasks->where('status', 'accepted')->count() }}</h3>
                    <p class="text-gray-600 text-sm font-medium mt-1 group-hover:text-yellow-100 transition-colors duration-300">Pending Tasks</p>
                </div>
            </div>

            <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 group-hover:text-white transition-colors duration-300">{{ $user->points }}</h3>
                    <p class="text-gray-600 text-sm font-medium mt-1 group-hover:text-purple-100 transition-colors duration-300">Total Points</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-5">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-bold text-white flex items-center">
                            <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                            My Tasks
                        </h3>
                        <a href="{{ route('tasks.index') }}" class="text-sm text-white hover:text-blue-100 font-medium flex items-center group">View All <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></a>
                    </div>
                </div>
                <div class="p-6 max-h-[600px] overflow-y-auto">
                    @forelse($createdTasks->take(5) as $task)
                    <div class="group mb-4 p-4 rounded-xl bg-gradient-to-r from-gray-50 to-blue-50 hover:from-blue-50 hover:to-blue-100 border border-gray-200 hover:border-blue-300 transition-all duration-300 hover:shadow-md">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h4 class="text-base font-bold text-gray-900 group-hover:text-blue-700 transition-colors">{{ $task->title }}</h4>
                                <p class="text-sm text-gray-600 mt-2">{{ Str::limit($task->description, 80) }}</p>
                                <div class="flex items-center mt-3 space-x-3">
                                    @if($task->helper)
                                    <span class="inline-flex items-center text-xs text-gray-600 bg-white px-3 py-1 rounded-full border border-gray-200"><svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>{{ $task->helper->name }}</span>
                                    @else
                                    <span class="inline-flex items-center text-xs text-yellow-700 bg-yellow-100 px-3 py-1 rounded-full font-medium">Waiting for helper</span>
                                    @endif
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-green-400 to-emerald-500 text-white shadow-sm">{{ $task->reward_points }} pts</span>
                                </div>
                            </div>
                            <div class="ml-3 flex flex-col space-y-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $task->status === 'done' ? 'bg-gradient-to-r from-green-400 to-emerald-500 text-white' : ($task->status === 'accepted' ? 'bg-gradient-to-r from-yellow-400 to-orange-500 text-white' : 'bg-gray-200 text-gray-700') }} shadow-sm">{{ ucfirst($task->status) }}</span>
                                
                                @if($task->status === 'done' && $task->helper)
                                @php
                                    $hasReviewed = \App\Models\Review::where('task_id', $task->id)
                                        ->where('from_user_id', Auth::id())
                                        ->where('to_user_id', $task->helper_id)
                                        ->exists();
                                @endphp
                                @if(!$hasReviewed)
                                <a href="{{ route('reviews.create', ['task_id' => $task->id, 'user_id' => $task->helper_id]) }}" class="inline-flex items-center justify-center px-4 py-2 border-2 border-yellow-400 text-xs font-bold rounded-xl text-yellow-700 bg-yellow-50 hover:bg-yellow-100 shadow-sm hover:shadow-md transition-all duration-300">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    Review Helper
                                </a>
                                @else
                                <span class="inline-flex items-center justify-center px-4 py-2 rounded-xl text-xs font-medium text-gray-500 bg-gray-100">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    Reviewed
                                </span>
                                @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-blue-100 to-blue-200 mb-4"><svg class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg></div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">No tasks yet</h3>
                        <p class="text-sm text-gray-600 mb-6">Get started by creating your first task.</p>
                        <a href="{{ route('tasks.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5"><svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>Create Task</a>
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-5">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-bold text-white flex items-center">
                            <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" /></svg>
                            Helping Others
                        </h3>
                        <a href="{{ route('tasks.index') }}" class="text-sm text-white hover:text-green-100 font-medium flex items-center group">Browse Tasks<svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></a>
                    </div>
                </div>
                <div class="p-6 max-h-[600px] overflow-y-auto">
                    @forelse($acceptedTasks->take(5) as $task)
                    <div class="group mb-4 p-4 rounded-xl bg-gradient-to-r from-gray-50 to-green-50 hover:from-green-50 hover:to-green-100 border border-gray-200 hover:border-green-300 transition-all duration-300 hover:shadow-md">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h4 class="text-base font-bold text-gray-900 group-hover:text-green-700 transition-colors">{{ $task->title }}</h4>
                                <p class="text-sm text-gray-600 mt-2">{{ Str::limit($task->description, 80) }}</p>
                                <div class="flex items-center mt-3 space-x-3">
                                    <span class="inline-flex items-center text-xs text-gray-600 bg-white px-3 py-1 rounded-full border border-gray-200"><svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>{{ $task->requester->name }}</span>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-green-400 to-emerald-500 text-white shadow-sm">+{{ $task->reward_points }} pts</span>
                                </div>
                            </div>
                            <div class="ml-3 flex flex-col space-y-2">
                                @if($task->status === 'accepted')
                                <form method="POST" action="{{ route('tasks.complete', $task->id) }}">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-xs font-bold rounded-xl text-white bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">Complete</button>
                                </form>
                                @elseif($task->status === 'done')
                                <span class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold bg-gradient-to-r from-green-400 to-emerald-500 text-white shadow-sm">Completed</span>
                                @php
                                    $hasReviewed = \App\Models\Review::where('task_id', $task->id)
                                        ->where('from_user_id', Auth::id())
                                        ->where('to_user_id', $task->requester_id)
                                        ->exists();
                                @endphp
                                @if(!$hasReviewed)
                                <a href="{{ route('reviews.create', ['task_id' => $task->id, 'user_id' => $task->requester_id]) }}" class="inline-flex items-center justify-center px-4 py-2 border-2 border-yellow-400 text-xs font-bold rounded-xl text-yellow-700 bg-yellow-50 hover:bg-yellow-100 shadow-sm hover:shadow-md transition-all duration-300">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    Leave Review
                                </a>
                                @else
                                <span class="inline-flex items-center justify-center px-4 py-2 rounded-xl text-xs font-medium text-gray-500 bg-gray-100">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    Reviewed
                                </span>
                                @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-green-100 to-emerald-200 mb-4"><svg class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg></div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">No tasks accepted yet</h3>
                        <p class="text-sm text-gray-600 mb-6">Start helping others to earn points.</p>
                        <a href="{{ route('tasks.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">Browse Available Tasks</a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
