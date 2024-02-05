<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    function testProfileViewWithoutLogin()
    {
        $response = $this->get(route('profile'));
        $response->assertRedirect(route('login'));
    }

    function testProfileViewWithLogin()
    {

        $this->actingAs(User::factory()->create());
        $response = $this->get(route('profile'));
        $response->assertStatus(200);
        $response->assertViewIs('profile');
    }

    function testEditUserProfile()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $userData = [
            'name' => 'Updated Name',
            'email' => 'updated_email@example.com',
            'username' => 'updated_username',
            'password' => 'new_password',
            'password_confirmation' => 'new_password',
            'profile_image_path' => UploadedFile::fake()->image('profile_picture.jpg'),
            'mobile' => '1234567890',
            'designation' => 'Updated Designer',
            'skill_level' => 'Advanced',
            'gender' => 'Female',
            'birthday' => '1990-01-01',
            'progress' => 75,
        ];
        $response = $this->put(route('profile.update', $user->id), $userData);
        $response->assertRedirect(route('profile'));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $userData['name'],
            'email' => $userData['email'],
            'username' => $userData['username'],
        ]);
    }

    function testDeleteUserProfile()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->delete(route('profile.destroy', $user->id));
        $response->assertRedirect(route('home'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

}
