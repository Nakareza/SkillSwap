<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\Skill;
use App\Models\UserSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Tampilkan dashboard pengguna
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Ambil task yang dibuat oleh user
        $createdTasks = $user->createdTasks()->with(['helper'])->latest()->get();
        
        // Ambil task yang diterima/dibantu oleh user (sebagai helper)
        $acceptedTasks = $user->acceptedTasks()->with(['requester'])->latest()->get();
        
        return view('dashboard', compact('user', 'createdTasks', 'acceptedTasks'));
    }

    /**
     * Tampilkan halaman profil
     */
    public function profile()
    {
        $user = Auth::user();
        
        // Ambil skills yang ditawarkan dan dibutuhkan menggunakan relasi yang sudah ada
        $offeredSkills = $user->offeredSkills()->get();
        $neededSkills = $user->neededSkills()->get();
        
        // Ambil semua skill untuk dropdown
        $allSkills = Skill::orderBy('name')->get();
        
        // Hitung statistik
        $createdTasksCount = $user->createdTasks()->count();
        $completedTasksCount = $user->acceptedTasks()->where('status', 'done')->count();
        
        return view('profile.index', compact('user', 'offeredSkills', 'neededSkills', 'allSkills', 'createdTasksCount', 'completedTasksCount'));
    }

    /**
     * Update profil pengguna
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'bio' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();
        $user->update($request->only(['name', 'email', 'bio']));

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update avatar pengguna
     */
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // Hapus avatar lama jika ada
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Simpan avatar baru
        $avatarPath = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $avatarPath;
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Foto profil berhasil diperbarui!');
    }

    /**
     * Tampilkan leaderboard
     */
    public function leaderboard()
    {
        $users = User::orderBy('points', 'desc')
                    ->orderBy('average_rating', 'desc')
                    ->limit(10)
                    ->get();

        return view('leaderboard', compact('users'));
    }
}