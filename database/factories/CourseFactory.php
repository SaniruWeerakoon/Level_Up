<?php

namespace Database\Factories;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->sentence(),
            'description' => $this->faker->paragraph(50),
            'subject' => $this->faker->randomElement(['Math', 'Science', 'Computer Science', 'English']),
            'difficulty' => $this->faker->randomElement(['Beginner', 'Intermediate', 'Advanced']),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'author_id' => User::factory(['role_id' => UserRole::Moderator]),
            'type' => $this->faker->word(),
            'content' => $this->faker->paragraph(),
            'estimated_length' => $this->faker->randomElement(['0-1 hours', '1-2 hours', '2-4 hours', '5+ hours']),
            'course_image_path' => 'course_img/learn.jfif',
            'ratings' => $this->faker->numberBetween(1, 5),
            'completed_by' => $this->faker->numberBetween(1, 100),
        ];
    }
}
