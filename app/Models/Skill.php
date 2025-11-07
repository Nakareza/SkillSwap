<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'category',
    ];

    /**
     * Relasi: Skill dimiliki oleh banyak user
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_skills')
                    ->withPivot('type')
                    ->withTimestamps();
    }
}