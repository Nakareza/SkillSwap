<?php

use App\Http\Controllers\{
    UserController,
    SkillController,
    TaskController,
    MatchController,
    NotificationController,
    ReviewController,
    MessageController,
    ChatbotController
};
use Illuminate\Support\Facades\Route;

// Rute autentikasi (Laravel Breeze)
require __DIR__.'/auth.php';

// Halaman utama (Landing Page)
Route::get('/', function () {
    return view('landing');
})->name('home');

// Rute yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    
    // Profil
    Route::get('/profile', [UserController::class, 'profile'])->name('profile.index');
    Route::patch('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/avatar', [UserController::class, 'updateAvatar'])->name('profile.avatar');
    Route::get('/profile/{user}', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    
    // Skill
    Route::post('/skills', [SkillController::class, 'addSkill'])->name('skills.add');
    Route::delete('/skills/{id}', [SkillController::class, 'removeSkill'])->name('skills.remove');
    
    // Task
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::post('/tasks/{id}/accept', [TaskController::class, 'accept'])->name('tasks.accept');
    Route::post('/tasks/{id}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
    
    // Match
    Route::get('/match', [MatchController::class, 'findMatches'])->name('match.index');
    
    // Leaderboard
    Route::get('/leaderboard', [UserController::class, 'leaderboard'])->name('leaderboard');
    
    // Notifications (specific routes MUST come before general routes)
    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unread-count');
    Route::get('/notifications/recent', [NotificationController::class, 'recent'])->name('notifications.recent');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    Route::delete('/notifications/clear-read', [NotificationController::class, 'clearRead'])->name('notifications.clearRead');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    
    // Reviews
    Route::get('/users/{user}/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/reviews/{review}/helpful', [ReviewController::class, 'markHelpful'])->name('reviews.helpful');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::get('/users/{user}/reviews/filter', [ReviewController::class, 'filter'])->name('reviews.filter');
    
    // Messages/Chat
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{user}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/{user}/fetch', [MessageController::class, 'fetchMessages'])->name('messages.fetch');
    Route::post('/messages/{user}/mark-read', [MessageController::class, 'markAsRead'])->name('messages.markRead');
    Route::get('/messages/unread-count', [MessageController::class, 'unreadCount'])->name('messages.unreadCount');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
    Route::get('/start-conversation/{user}', [MessageController::class, 'startConversation'])->name('messages.start');
    
    // AI Chatbot
    Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot.index');
    Route::post('/chatbot/chat', [ChatbotController::class, 'chat'])->name('chatbot.chat');
    Route::delete('/chatbot/clear', [ChatbotController::class, 'clearHistory'])->name('chatbot.clear');
});