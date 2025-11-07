<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'task_id',
        'from_user_id',
        'to_user_id',
        'rating',
        'feedback',
        'helpful_count',
        'is_visible',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'rating' => 'integer',
        'helpful_count' => 'integer',
        'is_visible' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi: Review milik satu task
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * Relasi: Review diberikan oleh satu user
     */
    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    /**
     * Relasi: Review diterima oleh satu user
     */
    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    /**
     * Scope untuk review yang terlihat (visible)
     */
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    /**
     * Scope untuk review terbaru
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Scope untuk review dengan rating tertinggi
     */
    public function scopeHighestRated($query)
    {
        return $query->orderBy('rating', 'desc');
    }

    /**
     * Scope untuk review yang paling helpful
     */
    public function scopeMostHelpful($query)
    {
        return $query->orderBy('helpful_count', 'desc');
    }

    /**
     * Increment helpful count
     */
    public function incrementHelpful()
    {
        $this->increment('helpful_count');
    }
}