<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_one_id',
        'user_two_id',
        'last_message_id',
        'last_message_at',
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    /**
     * Get user one of the conversation
     */
    public function userOne()
    {
        return $this->belongsTo(User::class, 'user_one_id');
    }

    /**
     * Get user two of the conversation
     */
    public function userTwo()
    {
        return $this->belongsTo(User::class, 'user_two_id');
    }

    /**
     * Get all messages in this conversation
     */
    public function messages()
    {
        return $this->hasMany(Message::class)->orderBy('created_at', 'asc');
    }

    /**
     * Get the last message
     */
    public function lastMessage()
    {
        return $this->belongsTo(Message::class, 'last_message_id');
    }

    /**
     * Get the other participant in the conversation
     */
    public function getOtherUser($userId)
    {
        return $this->user_one_id == $userId ? $this->userTwo : $this->userOne;
    }

    /**
     * Get unread messages count for a specific user
     */
    public function unreadCount($userId)
    {
        return $this->messages()
            ->where('receiver_id', $userId)
            ->unread()
            ->count();
    }

    /**
     * Get or create a conversation between two users
     */
    public static function findOrCreate($userOneId, $userTwoId)
    {
        // Ensure consistent ordering (lower ID first)
        $ids = [$userOneId, $userTwoId];
        sort($ids);

        return static::firstOrCreate([
            'user_one_id' => $ids[0],
            'user_two_id' => $ids[1],
        ]);
    }

    /**
     * Scope to get conversations for a specific user
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_one_id', $userId)
            ->orWhere('user_two_id', $userId);
    }

    /**
     * Scope to order by latest message
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('last_message_at', 'desc');
    }
}
