<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchController extends Controller
{
    /**
     * Temukan pengguna yang cocok berdasarkan skill
     */
    public function findMatches()
    {
        $userId = Auth::id();
        
        // Ambil skill yang dibutuhkan oleh user saat ini
        $neededSkills = UserSkill::where('user_id', $userId)
                                ->where('type', 'need')
                                ->pluck('skill_id');

        // Ambil skill yang ditawarkan oleh user saat ini
        $offeredSkills = UserSkill::where('user_id', $userId)
                                 ->where('type', 'offer')
                                 ->pluck('skill_id');

        // Cari user lain yang menawarkan skill yang kita butuhkan
        $usersWithNeededSkills = collect();
        if ($neededSkills->count() > 0) {
            $usersWithNeededSkills = UserSkill::whereIn('skill_id', $neededSkills)
                                             ->where('type', 'offer')
                                             ->where('user_id', '!=', $userId)
                                             ->pluck('user_id');
        }

        // Cari user lain yang membutuhkan skill yang kita tawarkan
        $usersNeedingOurSkills = collect();
        if ($offeredSkills->count() > 0) {
            $usersNeedingOurSkills = UserSkill::whereIn('skill_id', $offeredSkills)
                                             ->where('type', 'need')
                                             ->where('user_id', '!=', $userId)
                                             ->pluck('user_id');
        }

        // Gabungkan user yang cocok
        $matchingUserIds = $usersWithNeededSkills->merge($usersNeedingOurSkills)->unique();

        $matches = User::whereIn('id', $matchingUserIds)
                      ->with(['offeredSkills', 'neededSkills'])
                      ->get();

        return view('match', compact('matches'));
    }

    /**
     * Endpoint API untuk mencari match
     */
    public function apiMatches()
    {
        $userId = Auth::id();
        
        // Ambil skill yang dibutuhkan oleh user saat ini
        $neededSkills = UserSkill::where('user_id', $userId)
                                ->where('type', 'need')
                                ->pluck('skill_id');

        // Ambil skill yang ditawarkan oleh user saat ini
        $offeredSkills = UserSkill::where('user_id', $userId)
                                 ->where('type', 'offer')
                                 ->pluck('skill_id');

        // Cari user lain yang menawarkan skill yang kita butuhkan
        $usersWithNeededSkills = collect();
        if ($neededSkills->count() > 0) {
            $usersWithNeededSkills = UserSkill::whereIn('skill_id', $neededSkills)
                                             ->where('type', 'offer')
                                             ->where('user_id', '!=', $userId)
                                             ->pluck('user_id');
        }

        // Cari user lain yang membutuhkan skill yang kita tawarkan
        $usersNeedingOurSkills = collect();
        if ($offeredSkills->count() > 0) {
            $usersNeedingOurSkills = UserSkill::whereIn('skill_id', $offeredSkills)
                                             ->where('type', 'need')
                                             ->where('user_id', '!=', $userId)
                                             ->pluck('user_id');
        }

        // Gabungkan user yang cocok
        $matchingUserIds = $usersWithNeededSkills->merge($usersNeedingOurSkills)->unique();

        $matches = User::whereIn('id', $matchingUserIds)
                      ->with(['offeredSkills', 'neededSkills'])
                      ->select('id', 'name', 'email', 'bio', 'points', 'average_rating')
                      ->get();

        return response()->json($matches);
    }
}