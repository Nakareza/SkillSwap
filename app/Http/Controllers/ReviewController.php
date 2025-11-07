<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Task;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display reviews for a specific user
     */
    public function index($userId)
    {
        $user = User::findOrFail($userId);
        
        $reviews = Review::where('to_user_id', $userId)
            ->visible()
            ->with(['fromUser', 'task'])
            ->recent()
            ->paginate(10);

        return view('reviews.index', compact('user', 'reviews'));
    }

    /**
     * Show the form for creating a new review
     */
    public function create(Request $request)
    {
        $taskId = $request->query('task_id');
        $userId = $request->query('user_id');

        $task = Task::findOrFail($taskId);
        $user = User::findOrFail($userId);

        // Check if user can review this task
        if (!$this->canReview($task, $user)) {
            return redirect()->back()->with('error', 'You cannot review this task or user.');
        }

        return view('reviews.create', compact('task', 'user'));
    }

    /**
     * Store a newly created review
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'to_user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string|max:1000',
        ]);

        $task = Task::findOrFail($validated['task_id']);
        $toUser = User::findOrFail($validated['to_user_id']);

        // Check if already reviewed
        $existingReview = Review::where('task_id', $validated['task_id'])
            ->where('from_user_id', Auth::id())
            ->where('to_user_id', $validated['to_user_id'])
            ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'You have already reviewed this user for this task.');
        }

        // Create review
        $review = Review::create([
            'task_id' => $validated['task_id'],
            'from_user_id' => Auth::id(),
            'to_user_id' => $validated['to_user_id'],
            'rating' => $validated['rating'],
            'feedback' => $validated['feedback'],
        ]);

        // Update user's average rating
        $this->updateUserRating($toUser);

        // Create notification
        Notification::create([
            'user_id' => $validated['to_user_id'],
            'type' => 'review_received',
            'title' => 'New Review Received',
            'message' => Auth::user()->name . ' left you a ' . $validated['rating'] . '-star review',
            'icon' => 'star',
            'link' => route('profile.show', $validated['to_user_id']),
            'notifiable_type' => Review::class,
            'notifiable_id' => $review->id,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Review submitted successfully!');
    }

    /**
     * Mark a review as helpful
     */
    public function markHelpful(Review $review)
    {
        // You can implement a pivot table to track who marked what as helpful
        // For now, we'll just increment the count
        $review->incrementHelpful();

        return response()->json([
            'success' => true,
            'helpful_count' => $review->helpful_count,
        ]);
    }

    /**
     * Update a review
     */
    public function update(Request $request, Review $review)
    {
        // Check if user owns this review
        if ($review->from_user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string|max:1000',
        ]);

        $review->update($validated);

        // Update user's average rating
        $this->updateUserRating($review->toUser);

        return redirect()->back()->with('success', 'Review updated successfully!');
    }

    /**
     * Delete a review
     */
    public function destroy(Review $review)
    {
        // Check if user owns this review
        if ($review->from_user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $toUser = $review->toUser;
        $review->delete();

        // Update user's average rating
        $this->updateUserRating($toUser);

        return redirect()->back()->with('success', 'Review deleted successfully!');
    }

    /**
     * Get reviews with filtering
     */
    public function filter(Request $request, $userId)
    {
        $query = Review::where('to_user_id', $userId)->visible()->with(['fromUser', 'task']);

        // Apply sorting
        $sort = $request->query('sort', 'recent');
        switch ($sort) {
            case 'highest':
                $query->highestRated();
                break;
            case 'helpful':
                $query->mostHelpful();
                break;
            default:
                $query->recent();
        }

        // Apply rating filter
        if ($request->has('rating')) {
            $query->where('rating', $request->query('rating'));
        }

        $reviews = $query->paginate(10);

        return response()->json($reviews);
    }

    /**
     * Check if user can review this task and user
     */
    private function canReview(Task $task, User $user): bool
    {
        // User can review if:
        // 1. Task is done (completed)
        // 2. User is either task requester or helper (but not reviewing themselves)
        // 3. User hasn't already reviewed this user for this task

        if ($task->status !== 'done') {
            return false;
        }

        if ($user->id === Auth::id()) {
            return false;
        }

        // Check if current user is either requester or helper
        if ($task->requester_id !== Auth::id() && $task->helper_id !== Auth::id()) {
            return false;
        }

        $existingReview = Review::where('task_id', $task->id)
            ->where('from_user_id', Auth::id())
            ->where('to_user_id', $user->id)
            ->exists();

        return !$existingReview;
    }

    /**
     * Update user's average rating and review count
     */
    private function updateUserRating(User $user): void
    {
        $stats = Review::where('to_user_id', $user->id)
            ->visible()
            ->select(DB::raw('AVG(rating) as avg_rating, COUNT(*) as review_count'))
            ->first();

        $user->update([
            'average_rating' => round($stats->avg_rating ?? 0, 2),
            'review_count' => $stats->review_count ?? 0,
        ]);
    }
}
