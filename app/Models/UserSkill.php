<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'skill_id',
        'type',
    ];

    /**
     * Relasi: UserSkill milik satu user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: UserSkill milik satu skill
     */
    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}