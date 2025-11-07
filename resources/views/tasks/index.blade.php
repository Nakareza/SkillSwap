@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Available Tasks</h1>
                <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" onclick="document.getElementById('createTaskModal').classList.remove('hidden')">
                    Create Task
                </button>
            </div>
            
            <div class="grid grid-cols-1 gap-6">
                @foreach($tasks as $task)
                    <div class="bg-white overflow-hidden shadow rounded-lg glass-effect">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex justify-between">
                                <h3 class="text-lg font-medium text-gray-900">{{ $task->title }}</h3>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ $task->reward_points }} Points
                                </span>
                            </div>
                            
                            <p class="mt-2 text-sm text-gray-600">{{ $task->description }}</p>
                            
                            <div class="mt-4 flex justify-between items-center">
                                <div class="text-sm text-gray-500">
                                    Created by: {{ $task->requester->name }}
                                </div>
                                <form action="{{ route('tasks.accept', $task->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Accept Task
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Create Task Modal -->
    <div id="createTaskModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-lg font-medium text-gray-900">Create New Task</h3>
                    <button class="text-gray-500 hover:text-gray-700" onclick="document.getElementById('createTaskModal').classList.add('hidden')">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" id="title" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="4" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label for="reward_points" class="block text-sm font-medium text-gray-700">Reward Points</label>
                        <input type="number" name="reward_points" id="reward_points" min="1" max="1000" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none" onclick="document.getElementById('createTaskModal').classList.add('hidden')">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
