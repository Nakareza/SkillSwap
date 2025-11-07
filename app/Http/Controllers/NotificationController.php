<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of user notifications
     */
    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate(20);
        
        return view('notifications.index', compact('notifications'));
    }

    /**
     * Get unread notifications count (for AJAX)
     */
    public function unreadCount()
    {
        // Redirect to dashboard if accessed directly (not AJAX)
        if (!request()->expectsJson() && !request()->ajax()) {
            return redirect()->route('dashboard');
        }

        $count = Auth::user()->unreadNotificationsCount();
        
        return response()->json(['count' => $count]);
    }

    /**
     * Get recent notifications (for dropdown)
     */
    public function recent()
    {
        // Redirect to notifications page if accessed directly (not AJAX)
        if (!request()->expectsJson() && !request()->ajax()) {
            return redirect()->route('notifications.index');
        }

        $notifications = Auth::user()->notifications()
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        
        return response()->json($notifications);
    }

    /**
     * Mark a notification as read
     */
    public function markAsRead($id)
    {
        $notification = Notification::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();
        
        $notification->markAsRead();
        
        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }
        
        return redirect()->back()->with('success', 'Notification marked as read');
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        Auth::user()->notifications()->unread()->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
        
        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }
        
        return redirect()->back()->with('success', 'All notifications marked as read');
    }

    /**
     * Delete a notification
     */
    public function destroy($id)
    {
        $notification = Notification::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();
        
        $notification->delete();
        
        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }
        
        return redirect()->back()->with('success', 'Notification deleted');
    }

    /**
     * Delete all read notifications
     */
    public function clearRead()
    {
        Auth::user()->notifications()->read()->delete();
        
        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }
        
        return redirect()->back()->with('success', 'Read notifications cleared');
    }
}

