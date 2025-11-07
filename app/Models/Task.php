<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'reward_points',
        'requester_id',
        'helper_id',
        'status',
        'accepted_at',
        'completed_at',
    ];

    /**
     * Relasi: Task dibuat oleh satu user
     */
    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    /**
     * Relasi: Task diselesaikan oleh satu user
     */
    public function helper()
    {
        return $this->belongsTo(User::class, 'helper_id');
    }

    /**
     * Relasi: Task memiliki banyak review
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Method untuk menandai task sebagai diterima
     */
    public function accept($helperId)
    {
        $this->update([
            'helper_id' => $helperId,
            'status' => 'accepted',
            'accepted_at' => now()
        ]);
    }

    /**
     * Method untuk menandai task sebagai selesai
     */
    public function complete()
    {
        $this->update([
            'status' => 'done',
            'completed_at' => now()
        ]);
    }
}