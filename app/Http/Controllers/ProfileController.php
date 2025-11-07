<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Store new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return Redirect::route('profile.index')->with('success', 'Profile updated successfully!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Show a specific user's profile (public view)
     */
    public function show($userId): View
    {
        $user = \App\Models\User::with([
            'offeredSkills',
            'neededSkills',
            'createdTasks',
            'acceptedTasks',
            'receivedReviews.fromUser'
        ])->findOrFail($userId);

        // Get user statistics
        $stats = [
            'tasks_created' => $user->createdTasks()->count(),
            'tasks_completed' => $user->acceptedTasks()->where('status', 'completed')->count(),
            'reviews_count' => $user->receivedReviews()->count(),
            'average_rating' => $user->average_rating,
        ];

        // Get recent reviews
        $reviews = $user->receivedReviews()
            ->visible()
            ->with(['fromUser', 'task'])
            ->recent()
            ->limit(5)
            ->get();

        return view('profile.show', compact('user', 'stats', 'reviews'));
    }
}
