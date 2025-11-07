<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\User;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users
        $users = User::all();

        if ($users->count() < 2) {
            $this->command->info('Need at least 2 users to create notifications.');
            return;
        }

        // Create sample notifications for each user
        foreach ($users as $user) {
            // Welcome notification
            Notification::create([
                'user_id' => $user->id,
                'type' => 'welcome',
                'title' => 'Welcome to SkillSwap!',
                'message' => 'Start by adding your skills and finding matches.',
                'icon' => 'bell',
                'link' => route('profile.index'),
                'notifiable_type' => 'App\Models\User',
                'notifiable_id' => $user->id,
                'is_read' => false,
            ]);

            // New message notification (if not the first user)
            if ($user->id > 1) {
                Notification::create([
                    'user_id' => $user->id,
                    'type' => 'message_received',
                    'title' => 'New Message',
                    'message' => 'You have a new message from ' . $users->first()->name,
                    'icon' => 'message',
                    'link' => route('messages.index'),
                    'notifiable_type' => 'App\Models\Message',
                    'notifiable_id' => 1,
                    'is_read' => false,
                ]);
            }

            // Points earned notification
            Notification::create([
                'user_id' => $user->id,
                'type' => 'points_earned',
                'title' => 'Points Earned!',
                'message' => 'You earned 50 points for completing your profile.',
                'icon' => 'star',
                'link' => route('dashboard'),
                'notifiable_type' => 'App\Models\User',
                'notifiable_id' => $user->id,
                'is_read' => rand(0, 1) == 1, // Random read/unread
            ]);
        }

        $this->command->info('Sample notifications created successfully!');
    }
}

