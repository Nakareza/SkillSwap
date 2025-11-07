<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'bio',
        'points',
        'reputation',
        'average_rating',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'average_rating' => 'decimal:2',
    ];

    /**
     * Relasi: User memiliki banyak skill
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'user_skills')
                    ->withPivot('type') // Menyertakan kolom type dari pivot table
                    ->withTimestamps();
    }

    /**
     * Relasi: User menawarkan banyak skill
     */
    public function offeredSkills()
    {
        return $this->skills()->wherePivot('type', 'offer');
    }

    /**
     * Relasi: User membutuhkan banyak skill
     */
    public function neededSkills()
    {
        return $this->skills()->wherePivot('type', 'need');
    }

    /**
     * Relasi: User membuat banyak task
     */
    public function createdTasks()
    {
        return $this->hasMany(Task::class, 'requester_id');
    }

    /**
     * Relasi: User menyelesaikan banyak task (alias untuk completedTasks)
     */
    public function acceptedTasks()
    {
        return $this->hasMany(Task::class, 'helper_id');
    }

    /**
     * Relasi: User menyelesaikan banyak task
     */
    public function completedTasks()
    {
        return $this->hasMany(Task::class, 'helper_id');
    }

    /**
     * Relasi: User mengirim banyak pesan
     */
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * Relasi: User menerima banyak pesan
     */
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    /**
     * Relasi: User memberi banyak review
     */
    public function givenReviews()
    {
        return $this->hasMany(Review::class, 'from_user_id');
    }

    /**
     * Relasi: User menerima banyak review
     */
    public function receivedReviews()
    {
        return $this->hasMany(Review::class, 'to_user_id');
    }

    /**
     * Relasi: User memiliki banyak notifications
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class)->orderBy('created_at', 'desc');
    }

    /**
     * Get unread notifications count
     */
    public function unreadNotificationsCount()
    {
        return $this->notifications()->unread()->count();
    }

    /**
     * Method untuk menambah poin ke user
     */
    public function addPoints($points)
    {
        $this->increment('points', $points);
    }

    /**
     * Method untuk mengurangi poin dari user
     */
    public function subtractPoints($points)
    {
        $this->decrement('points', $points);
    }

    /**
     * Method untuk memperbarui rating rata-rata
     */
    public function updateAverageRating()
    {
        $reviews = $this->receivedReviews()->get();
        if ($reviews->count() > 0) {
            $average = $reviews->avg('rating');
            $this->update(['average_rating' => round($average, 2)]);
        } else {
            $this->update(['average_rating' => 0.00]);
        }
    }

    /**
     * Get average rating as stars (for display)
     */
    public function getStarRatingAttribute()
    {
        return round($this->average_rating * 2) / 2; // Round to nearest 0.5
    }

    /**
     * Get rating percentage (for progress bars)
     */
    public function getRatingPercentageAttribute()
    {
        return ($this->average_rating / 5) * 100;
    }
}
