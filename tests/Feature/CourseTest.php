<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\Course;

// Adjust the namespace based on your actual model location
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use WithoutMiddleware;

    public function testCreateCourseStudent()
    {
        $user = User::factory()->create(['role_id' => UserRole::Student]);
        $this->actingAs($user);
        $courseData = [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'subject' => $this->faker->randomElement(['Math', 'Science', 'Computer Science', 'English']),
            'difficulty' => $this->faker->randomElement(['Beginner', 'Intermediate', 'Advanced']),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'type' => $this->faker->word(),
            'content' => $this->faker->paragraph(),
            'estimated_length' => $this->faker->randomElement(['0-1 hours', '1-2 hours', '2-4 hours', '5+ hours']),
            'course_image_path' => UploadedFile::fake()->image('course_image.jpg'),
        ];

        $response = $this->post(route('courses.store'), $courseData);
        $response->assertForbidden();
        $this->assertDatabaseMissing('courses', $courseData);


//        $response->assertStatus(201);
//        $this->assertDatabaseHas('courses', $courseData);
    }

    public function testCreateCourseModerator()
    {
        $this->actingAs(User::factory()->create(['role_id' => UserRole::Moderator]));
        $courseData = [
            'title' => $this->faker->word,
            'description' => $this->faker->sentence(50),
            'subject' => $this->faker->randomElement(['Math', 'Science', 'Computer Science', 'English']),
            'difficulty' => $this->faker->randomElement(['Beginner', 'Intermediate', 'Advanced']),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'type' => $this->faker->word(),
            'content' => $this->faker->paragraph(),
            'estimated_length' => $this->faker->randomElement(['0-1 hours', '1-2 hours', '2-4 hours', '5+ hours']),
            'image' => UploadedFile::fake()->image('courses.jpg')
        ];

        $response = $this->post(route('courses.store'), $courseData);
        $response->assertStatus(302);
        $response->assertRedirectToRoute('courses.show');
    }

    public function testReadCourse()
    {
        $course = Course::factory()->create(
            [
                'author_id' => User::factory()->create(['role_id' => UserRole::Moderator])
            ]
        );

        $response = $this->get(route('courses.display', $course->id));

        $response->assertStatus(200);
        $response->assertViewIs('courses.display');
    }

    public function testUpdateCourse()
    {
        $user = User::factory()->create(['role_id' => UserRole::Moderator]);
        $this->actingAs($user);
        $course = Course::factory()->create([
            'author_id' => $user->id,
        ]);
        $updatedData = [
            'title' => $this->faker->word,
            'description' => $this->faker->sentence(50),
            'subject' => $this->faker->randomElement(['Math', 'Science', 'Computer Science', 'English']),
            'difficulty' => $this->faker->randomElement(['Beginner', 'Intermediate', 'Advanced']),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'type' => $this->faker->word(),
            'content' => $this->faker->paragraph(),
            'estimated_length' => $this->faker->randomElement(['0-1 hours', '1-2 hours', '2-4 hours', '5+ hours']),
            'image' => UploadedFile::fake()->image('courses.jpg')
        ];

        $response = $this->put(route('courses.update', $course->id), $updatedData);

        $response->assertStatus(302);
        $response->assertRedirectToRoute('courses.show', $course->id);

    }

    public function testDeleteCourse()
    {
        $course = Course::factory()->create();
//        dd($course->id);
        $this->actingAs($course->user);

        $this->assertInstanceOf(Course::class, $course);

        $response = $this->delete("/courses/{$course->id}/destroy");


        $response->assertRedirect(route('courses.show'));
        $this->assertDatabaseMissing('courses', ['id' => $course->id]);
    }
}
