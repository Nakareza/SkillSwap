@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Leaderboard</h1>
            
            <div class="bg-white shadow overflow-hidden sm:rounded-md glass-effect">
                <ul class="divide-y divide-gray-200">
                    @foreach($users as $index => $user)
                        <li class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <span class="inline-block h-10 w-10 rounded-full overflow-hidden bg-gray-100">
                                        <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <a href="{{ route('profile.show', $user->id) }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 hover:underline">
                                                {{ $user->name }}
                                            </a>
                                            @if($index === 0)
                                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    #1
                                                </span>
                                            @elseif($index === 1)
                                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    #2
                                                </span>
                                            @elseif($index === 2)
                                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                    #3
                                                </span>
                                            @else
                                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    #{{ $index + 1 }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <span class="text-sm font-medium text-blue-600">{{ $user->points }} Points</span>
                                            <span class="text-sm font-medium text-yellow-500">{{ number_format($user->average_rating, 2) }} ⭐</span>
                                        </div>
                                    </div>
                                    <div class="mt-1 text-sm text-gray-500">
                                        {{ $user->bio ?? 'No bio available' }}
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection