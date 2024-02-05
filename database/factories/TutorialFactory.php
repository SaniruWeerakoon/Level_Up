<?php

namespace Database\Factories;

use App\Models\Tutorial;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TutorialFactory extends Factory
{
    protected $model = Tutorial::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'author_id' => $this->faker->numberBetween(1, 3),
            'course_id' => $this->faker->numberBetween(1, 2),
            'description' => $this->faker->text(),
            'content' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
