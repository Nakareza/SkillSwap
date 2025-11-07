<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SkillSwap') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen bg-gradient-to-br from-blue-50 to-white">
            <!-- Header -->
            <header class="bg-white shadow-sm glass-effect sticky top-0 z-50">
                <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 flex items-center">
                                <span class="text-xl font-bold text-blue-600">SkillSwap</span>
                            </div>
                            <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                    Dashboard
                                </a>
                                <a href="{{ route('match.index') }}" class="{{ request()->routeIs('match.index') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                    Find Matches
                                </a>
                                <a href="{{ route('tasks.index') }}" class="{{ request()->routeIs('tasks.*') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                    Tasks
                                </a>
                                <a href="{{ route('messages.index') }}" class="{{ request()->routeIs('messages.*') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                    Messages
                                </a>
                                <a href="{{ route('leaderboard') }}" class="{{ request()->routeIs('leaderboard') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                    Leaderboard
                                </a>
                            </div>
                        </div>
                        <div class="hidden sm:ml-6 sm:flex sm:items-center">
                            <!-- Points Badge -->
                            <div class="flex items-center space-x-2 mr-4 bg-gradient-to-r from-blue-100 to-purple-100 px-4 py-2 rounded-full">
                                <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-sm font-semibold text-gray-700">{{ Auth::user()->points }}</span>
                            </div>

                            <!-- Notification Bell -->
                            <div class="relative mr-4 z-50" x-data="{ open: false, count: {{ Auth::user()->unreadNotificationsCount() }} }">
                                <button @click="open = !open" @click.away="open = false" type="button" class="relative p-2 text-gray-600 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-full transition">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                    <span x-show="count > 0" x-text="count" class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full"></span>
                                </button>

                                <!-- Notification Dropdown -->
                                <div x-show="open" 
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="origin-top-right absolute right-0 mt-2 w-96 rounded-xl shadow-2xl bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                     style="display: none; z-index: 9999;">
                                    <div class="py-1">
                                        <div class="px-4 py-3 bg-gradient-to-r from-blue-500 to-purple-500 rounded-t-xl flex justify-between items-center">
                                            <h3 class="text-sm font-bold text-white">Notifications</h3>
                                            <a href="{{ route('notifications.index') }}" class="text-xs text-white hover:text-blue-100 font-medium">View All</a>
                                        </div>
                                        <div class="max-h-96 overflow-y-auto" id="notification-list">
                                            <div class="px-4 py-8 text-center text-gray-500 text-sm">
                                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                                </svg>
                                                <p>No notifications yet</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- User Dropdown -->
                            <div class="ml-3 relative z-50" x-data="{ open: false }">
                                <div>
                                    <button @click="open = !open" @click.away="open = false" type="button" class="bg-white rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                                        <span class="inline-flex items-center">
                                            <span class="inline-block h-10 w-10 rounded-full overflow-hidden bg-gradient-to-r from-blue-500 to-purple-500 p-0.5">
                                                <span class="inline-block h-full w-full rounded-full overflow-hidden bg-gray-100">
                                                    @if(Auth::user()->avatar)
                                                        <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" class="h-full w-full object-cover">
                                                    @else
                                                        <svg class="h-full w-full text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                        </svg>
                                                    @endif
                                                </span>
                                            </span>
                                            <span class="ml-3 text-sm font-medium text-gray-700 hidden md:block">{{ Auth::user()->name }}</span>
                                            <svg class="ml-2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>

                                <!-- Dropdown Menu -->
                                <div x-show="open" 
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="origin-top-right absolute right-0 mt-2 w-56 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                     style="display: none; z-index: 9999;">
                                    <div class="py-1">
                                        <div class="px-4 py-3 border-b border-gray-100">
                                            <p class="text-sm text-gray-500">Signed in as</p>
                                            <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->email }}</p>
                                        </div>
                                        <a href="{{ route('profile.index') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 transition">
                                            <svg class="mr-3 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            Your Profile
                                        </a>
                                        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 transition">
                                            <svg class="mr-3 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                            </svg>
                                            Dashboard
                                        </a>
                                        <div class="border-t border-gray-100"></div>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="flex items-center w-full px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition">
                                                <svg class="mr-3 h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                </svg>
                                                Sign out
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            <!-- Page Content -->
            <main>
                @if (session('success'))
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        <div class="rounded-md bg-green-50 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">
                                        {{ session('success') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        <div class="rounded-md bg-red-50 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-red-800">
                                        {{ session('error') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>

        <style>
            .glass-effect {
                background: rgba(255, 255, 255, 0.85);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
            }
        </style>

        <script>
            // Load notifications when dropdown is opened
            document.addEventListener('alpine:init', () => {
                // Auto-update notification count every 30 seconds
                setInterval(() => {
                    fetch('{{ route('notifications.unread-count') }}', {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        credentials: 'same-origin'
                    })
                        .then(response => response.json())
                        .then(data => {
                            const countElements = document.querySelectorAll('[x-text="count"]');
                            countElements.forEach(el => {
                                const alpineData = Alpine.$data(el.closest('[x-data]'));
                                if (alpineData) {
                                    alpineData.count = data.count;
                                }
                            });
                        })
                        .catch(error => console.error('Error fetching notification count:', error));
                }, 30000);
            });

            // Load notifications into dropdown
            function loadNotifications() {
                const notificationList = document.getElementById('notification-list');
                if (!notificationList) return;

                fetch('{{ route('notifications.recent') }}', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin'
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(notifications => {
                        if (notifications.length === 0) {
                            notificationList.innerHTML = `
                                <div class="px-4 py-8 text-center text-gray-500 text-sm">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <p>No notifications yet</p>
                                </div>
                            `;
                            return;
                        }

                        notificationList.innerHTML = notifications.map(notif => {
                            const isUnread = !notif.is_read;
                            const bgClass = isUnread ? 'bg-blue-50' : 'bg-white';
                            const timeAgo = getTimeAgo(new Date(notif.created_at));
                            
                            return `
                                <a href="${notif.link || '#'}" class="block px-4 py-3 hover:bg-gray-50 ${bgClass} border-b border-gray-100 transition">
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0">
                                            ${getNotificationIcon(notif.icon)}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900">${notif.title}</p>
                                            <p class="text-xs text-gray-500 mt-1">${notif.message}</p>
                                            <p class="text-xs text-gray-400 mt-1">${timeAgo}</p>
                                        </div>
                                        ${isUnread ? '<span class="flex-shrink-0 inline-block w-2 h-2 bg-blue-500 rounded-full"></span>' : ''}
                                    </div>
                                </a>
                            `;
                        }).join('');
                    })
                    .catch(error => {
                        console.error('Error loading notifications:', error);
                        console.error('Error details:', error.message);
                        notificationList.innerHTML = `
                            <div class="px-4 py-8 text-center text-red-500 text-sm">
                                <p class="font-medium">Failed to load notifications</p>
                                <p class="text-xs mt-2 text-gray-500">Please refresh the page or check console</p>
                            </div>
                        `;
                    });
            }

            function getNotificationIcon(icon) {
                const icons = {
                    'check': '<svg class="h-8 w-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>',
                    'star': '<svg class="h-8 w-8 text-yellow-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" /></svg>',
                    'message': '<svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>',
                    'bell': '<svg class="h-8 w-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>'
                };
                return icons[icon] || icons['bell'];
            }

            function getTimeAgo(date) {
                const seconds = Math.floor((new Date() - date) / 1000);
                const intervals = {
                    year: 31536000,
                    month: 2592000,
                    week: 604800,
                    day: 86400,
                    hour: 3600,
                    minute: 60
                };

                for (const [name, value] of Object.entries(intervals)) {
                    const interval = Math.floor(seconds / value);
                    if (interval >= 1) {
                        return `${interval} ${name}${interval > 1 ? 's' : ''} ago`;
                    }
                }
                return 'Just now';
            }

            // Load notifications when page loads
            document.addEventListener('DOMContentLoaded', () => {
                loadNotifications();
                
                // Reload notifications when dropdown is clicked
                const notificationButton = document.querySelector('[x-data] button');
                if (notificationButton) {
                    notificationButton.addEventListener('click', () => {
                        setTimeout(loadNotifications, 100);
                    });
                }
            });
        </script>
        
        <!-- AI Chatbot Floating Widget -->
        @auth
            @include('chatbot.floating')
        @endauth
    </body>
</html>