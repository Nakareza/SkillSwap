<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\UserSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    /**
     * Tambahkan skill ke pengguna
     */
    public function addSkill(Request $request)
    {
        $request->validate([
            'skill_id' => 'required|exists:skills,id',
            'type' => 'required|in:offer,need',
        ]);

        // Cek apakah user sudah memiliki skill ini dengan tipe yang sama
        $existing = UserSkill::where('user_id', Auth::id())
                           ->where('skill_id', $request->skill_id)
                           ->where('type', $request->type)
                           ->first();

        if (!$existing) {
            UserSkill::create([
                'user_id' => Auth::id(),
                'skill_id' => $request->skill_id,
                'type' => $request->type,
            ]);
        }

        return back()->with('success', 'Skill berhasil ditambahkan!');
    }

    /**
     * Hapus skill dari pengguna
     */
    public function removeSkill($id)
    {
        $userSkill = UserSkill::where('id', $id)
                            ->where('user_id', Auth::id())
                            ->firstOrFail();
        
        $userSkill->delete();

        return back()->with('success', 'Skill berhasil dihapus!');
    }

    /**
     * Dapatkan semua skill
     */
    public function getSkills()
    {
        return Skill::all();
    }
}