<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Skill;
use App\Models\UserSkill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Alice Johnson',
                'email' => 'alice@example.com',
                'password' => Hash::make('password'),
                'bio' => 'Web developer and designer with 5 years of experience.',
                'points' => 150,
                'average_rating' => 4.5,
            ],
            [
                'name' => 'Bob Smith',
                'email' => 'bob@example.com',
                'password' => Hash::make('password'),
                'bio' => 'Marketing specialist and content creator.',
                'points' => 120,
                'average_rating' => 4.2,
            ],
            [
                'name' => 'Charlie Brown',
                'email' => 'charlie@example.com',
                'password' => Hash::make('password'),
                'bio' => 'Photographer and video editor.',
                'points' => 180,
                'average_rating' => 4.8,
            ],
            [
                'name' => 'Diana Prince',
                'email' => 'diana@example.com',
                'password' => Hash::make('password'),
                'bio' => 'Data analyst and translator.',
                'points' => 200,
                'average_rating' => 4.9,
            ],
            [
                'name' => 'Eve Wilson',
                'email' => 'eve@example.com',
                'password' => Hash::make('password'),
                'bio' => 'Cook and food blogger.',
                'points' => 90,
                'average_rating' => 4.0,
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create($userData);

            // Tambahkan beberapa skill untuk setiap user
            $allSkills = Skill::all();
            $randomSkills = $allSkills->random(rand(3, 5))->pluck('id');

            foreach ($randomSkills as $skillId) {
                // 50% chance untuk menawarkan skill, 50% untuk membutuhkan skill
                $type = rand(0, 1) ? 'offer' : 'need';
                UserSkill::create([
                    'user_id' => $user->id,
                    'skill_id' => $skillId,
                    'type' => $type,
                ]);
            }
        }
    }
}