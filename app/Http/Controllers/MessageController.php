<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Conversation;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    /**
     * Display conversations inbox
     */
    public function index()
    {
        $conversations = Conversation::forUser(Auth::id())
            ->with(['userOne', 'userTwo', 'lastMessage'])
            ->latest()
            ->paginate(20);

        // Add unread count for each conversation
        foreach ($conversations as $conversation) {
            $conversation->unread_count = $conversation->unreadCount(Auth::id());
            $conversation->other_user = $conversation->getOtherUser(Auth::id());
        }

        return view('messages.index', compact('conversations'));
    }

    /**
     * Show a specific conversation
     */
    public function show($userId)
    {
        $otherUser = User::findOrFail($userId);
        
        // Find or create conversation
        $conversation = Conversation::findOrCreate(Auth::id(), $userId);

        // Get messages
        $messages = $conversation->messages()
            ->with(['sender', 'receiver'])
            ->get();

        // Mark messages as read
        $conversation->messages()
            ->where('receiver_id', Auth::id())
            ->unread()
            ->each(function ($message) {
                $message->markAsRead();
            });

        return view('messages.show', compact('conversation', 'messages', 'otherUser'));
    }

    /**
     * Send a message
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string|max:5000',
            'attachment' => 'nullable|file|max:10240', // 10MB max
        ]);

        // Find or create conversation
        $conversation = Conversation::findOrCreate(Auth::id(), $validated['receiver_id']);

        // Handle file upload
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('message-attachments', 'public');
        }

        // Create message
        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => Auth::id(),
            'receiver_id' => $validated['receiver_id'],
            'content' => $validated['content'],
            'attachment' => $attachmentPath,
        ]);

        // Update conversation's last message
        $conversation->update([
            'last_message_id' => $message->id,
            'last_message_at' => now(),
        ]);

        // Create notification for receiver
        Notification::create([
            'user_id' => $validated['receiver_id'],
            'type' => 'message_received',
            'title' => 'New Message',
            'message' => Auth::user()->name . ' sent you a message',
            'icon' => 'message',
            'link' => route('messages.show', Auth::id()),
            'notifiable_type' => Message::class,
            'notifiable_id' => $message->id,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message->load(['sender', 'receiver']),
            ]);
        }

        return redirect()->route('messages.show', $validated['receiver_id'])
            ->with('success', 'Message sent successfully!');
    }

    /**
     * Get messages for a conversation (AJAX)
     */
    public function fetchMessages($userId)
    {
        $conversation = Conversation::findOrCreate(Auth::id(), $userId);

        $messages = $conversation->messages()
            ->with(['sender', 'receiver'])
            ->get()
            ->map(function ($message) {
                return [
                    'id' => $message->id,
                    'content' => $message->content,
                    'attachment' => $message->attachment ? Storage::url($message->attachment) : null,
                    'sender_id' => $message->sender_id,
                    'receiver_id' => $message->receiver_id,
                    'is_read' => $message->is_read,
                    'created_at' => $message->created_at->format('Y-m-d H:i:s'),
                    'created_at_human' => $message->created_at->diffForHumans(),
                    'sender' => [
                        'id' => $message->sender->id,
                        'name' => $message->sender->name,
                    ],
                ];
            });

        return response()->json(['messages' => $messages]);
    }

    /**
     * Mark conversation messages as read
     */
    public function markAsRead($userId)
    {
        $conversation = Conversation::findOrCreate(Auth::id(), $userId);

        $conversation->messages()
            ->where('receiver_id', Auth::id())
            ->unread()
            ->each(function ($message) {
                $message->markAsRead();
            });

        return response()->json(['success' => true]);
    }

    /**
     * Get unread messages count
     */
    public function unreadCount()
    {
        $count = Message::where('receiver_id', Auth::id())
            ->unread()
            ->count();

        return response()->json(['count' => $count]);
    }

    /**
     * Delete a message
     */
    public function destroy(Message $message)
    {
        // Only sender can delete their message
        if ($message->sender_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $message->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Start a conversation from task or profile
     */
    public function startConversation($userId)
    {
        $otherUser = User::findOrFail($userId);
        
        if ($userId == Auth::id()) {
            return redirect()->back()->with('error', 'You cannot message yourself.');
        }

        // Find or create conversation
        $conversation = Conversation::findOrCreate(Auth::id(), $userId);

        return redirect()->route('messages.show', $userId);
    }
}
