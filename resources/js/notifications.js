// Notification System JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Update notification count and list
    function updateNotifications() {
        // Update count badge
        fetch('/notifications/unread-count')
            .then(response => response.json())
            .then(data => {
                const countElement = document.querySelector('[x-data*="count"]');
                if (countElement && countElement.__x) {
                    countElement.__x.$data.count = data.count;
                }
            })
            .catch(error => console.error('Error fetching notification count:', error));

        // Update recent notifications in dropdown
        fetch('/notifications/recent')
            .then(response => response.json())
            .then(data => {
                const listElement = document.getElementById('notification-list');
                if (listElement) {
                    if (data.notifications.length === 0) {
                        listElement.innerHTML = `
                            <div class="px-4 py-8 text-center text-gray-500 text-sm">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                                <p>No notifications yet</p>
                            </div>
                        `;
                    } else {
                        listElement.innerHTML = data.notifications.map(notification => {
                            const iconColors = {
                                'check': 'from-green-400 to-green-600',
                                'star': 'from-yellow-400 to-orange-500',
                                'message': 'from-blue-400 to-blue-600',
                                'default': 'from-purple-400 to-purple-600'
                            };
                            const iconColor = iconColors[notification.icon] || iconColors.default;
                            
                            const icons = {
                                'check': '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />',
                                'star': '<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />',
                                'message': '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />',
                                'default': '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />'
                            };
                            const iconPath = icons[notification.icon] || icons.default;
                            
                            return `
                                <a href="${notification.link || '#'}" 
                                   onclick="markAsRead(${notification.id}); ${!notification.link ? 'return false;' : ''}"
                                   class="block px-4 py-3 hover:bg-gray-50 transition ${!notification.is_read ? 'bg-blue-50' : ''}">
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0">
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-br ${iconColor} flex items-center justify-center shadow">
                                                <svg class="h-5 w-5 text-white" fill="${notification.icon === 'star' ? 'currentColor' : 'none'}" stroke="currentColor" viewBox="0 0 24 24">
                                                    ${iconPath}
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-semibold text-gray-900">
                                                ${notification.title}
                                                ${!notification.is_read ? '<span class="ml-2 inline-flex h-2 w-2 rounded-full bg-blue-600"></span>' : ''}
                                            </p>
                                            <p class="text-xs text-gray-600 mt-1 line-clamp-2">${notification.message}</p>
                                            <p class="text-xs text-gray-400 mt-1">${notification.created_at_human}</p>
                                        </div>
                                    </div>
                                </a>
                            `;
                        }).join('');
                    }
                }
            })
            .catch(error => console.error('Error fetching notifications:', error));
    }

    // Mark notification as read
    window.markAsRead = function(notificationId) {
        fetch(`/notifications/read/${notificationId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateNotifications();
            }
        })
        .catch(error => console.error('Error marking notification as read:', error));
    };

    // Update notifications every 30 seconds
    setInterval(updateNotifications, 30000);

    // Initial load
    updateNotifications();

    // Listen for custom notification events (for real-time updates via broadcasting)
    document.addEventListener('notification-received', function(event) {
        updateNotifications();
        
        // Optional: Show browser notification
        if ('Notification' in window && Notification.permission === 'granted') {
            new Notification(event.detail.title, {
                body: event.detail.message,
                icon: '/favicon.ico'
            });
        }
    });

    // Request notification permission
    if ('Notification' in window && Notification.permission === 'default') {
        Notification.requestPermission();
    }
});
