<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class QuizFactory extends Factory
{
    protected $model = Quiz::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->sentence(3, false),
            'author_id' => 2,
            'description' => $this->faker->paragraph(),
            'subject' => $this->faker->randomElement(['Math', 'Science', 'Computer Science', 'English']),
            'difficulty' => $this->faker->randomElement(['Beginner', 'Intermediate', 'Advanced']),
            'duration' => $this->faker->randomElement(['0-1 hours', '1-2 hours', '2-4 hours', '5+ hours']),
            'question_count' => $this->faker->numberBetween(1, 100),
            'quiz_image_path' => 'course_img/learn.jfif',
            'completed_by' => $this->faker->numberBetween(1, 100),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
