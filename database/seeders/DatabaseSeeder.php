<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Course;
use App\Models\Quiz;
use App\Models\Tutorial;
use Database\Factories\QuizFactory;
use Illuminate\Database\Seeder;

use function Laravel\Prompts\password;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'Admin@example.com',
            'username' => 'supAdmin',
            'password' => 'password',
            'role_id' => 1,

        ]);
        \App\Models\User::factory()->create([
            'name' => 'Moderator',
            'email' => 'Moderator@example.com',
            'username' => 'moderator',
            'password' => 'password',
            'role_id' => 2,

        ]);
        \App\Models\User::factory()->create([
            'name' => '2nd Moderator ',
            'email' => 'Moderator2@example.com',
            'username' => 'moderator2',
            'password' => 'password',
            'role_id' => 2,

        ]);
        \App\Models\User::factory()->create([

            'name' => 'Student',
            'email' => 'student@example.com',
            'username' => 'student',
            'password' => 'password',
            'role_id' => 3,

        ]);
        \App\Models\User::factory()->count(10)->create();

        $course = \App\Models\Course::factory()->create([
            'title' => 'Software Engineering',
            'description' => 'Start your coding journey with this lesson',
            'subject' => 'Computer Science',
            'difficulty' => 'Beginner',
            'price' => 0.00,
        ]);
        \App\Models\Course::factory()->count(10)->create();

        \App\Models\Enrollment::factory()->create([
            'course_id' => $course->id,
            'user_id' => 12,
            'complete' => false,
        ]);
        Quiz::factory()->count(5)->create();
        Tutorial::factory()->count(5)->create();
    }
}
