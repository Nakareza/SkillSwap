<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            ['name' => 'Web Development', 'category' => 'Technology'],
            ['name' => 'Graphic Design', 'category' => 'Design'],
            ['name' => 'Mobile App Development', 'category' => 'Technology'],
            ['name' => 'Digital Marketing', 'category' => 'Marketing'],
            ['name' => 'Content Writing', 'category' => 'Writing'],
            ['name' => 'Photography', 'category' => 'Creative'],
            ['name' => 'Video Editing', 'category' => 'Creative'],
            ['name' => 'Data Analysis', 'category' => 'Technology'],
            ['name' => 'Language Translation', 'category' => 'Language'],
            ['name' => 'Cooking', 'category' => 'Lifestyle'],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}