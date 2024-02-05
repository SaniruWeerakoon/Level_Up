<?php
// tests/Feature/Reg_LoginTest.php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class Register_LoginTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

//    use WithoutMiddleware;
    public function testLogin(): void
    {
        // Empty email and password
        $response = $this->post(route('login'), [
            'email' => '',
            'password' => '',
        ]);
        $response->assertSessionHasErrors([
            'email', 'password',
        ]);

        // Incorrect email format
        $response = $this->post(route('login'), [
            'email' => 'invalid_email_format',
            'password' => 'password',
        ]);
        $response->assertSessionHasErrors([
            'email',
        ]);

        // Valid email, but missing password
        $response = $this->post(route('login'), [
            'email' => 'example@example.com',
            'password' => '',
        ]);
        $response->assertSessionHasErrors([
            'password',
        ]);

        // Valid email and password, but incorrect password
        $response = $this->post(route('login'), [
            'email' => 'example@example.com',
            'password' => 'incorrect_password',
        ]);
        $response->assertSessionHasErrors([
            'email'
        ]);

        // Valid email and password
        $response = $this->post(route('login'), [
            'email' => 'example@example.com',
            'password' => 'password',
        ]);
        $response->assertRedirectToRoute('home');
    }

    public function testRegister(): void
    {
        $response = $this->post(route('register'), [
            'email' => '',
            'password' => 'password',
        ]);
        $response->assertSessionHasErrors([
            'email', 'username', 'password', 'name'
        ]);

        $response = $this->post(route('register'), [
            'email' => 'example@example.com',
            'password' => 'password',
        ]);
        $response->assertSessionHasErrors([
            'password', 'username', 'password', 'name'
        ]);
        $response = $this->post(route('register'), [
            'email' => 'example@example.com',
            'password' => 'password',
            'password_confirmation' => 'password1',
        ]);
        $response->assertSessionHasErrors([
            'password', 'username', 'password', 'name'
        ]);
        $response = $this->post(route('register'), [
            'email' => 'example@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $response->assertSessionHasErrors([
            'username', 'name'
        ]);
        $response = $this->post(route('register'), [
            'email' => 'example@example.com',
            'name' => 'name',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $response->assertSessionHasErrors([
            'username',
        ]);
        $response = $this->post(route('register'), [
            'email' => 'example@example.com',
            'name' => 'name',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $response->assertRedirectToRoute('home');
    }
}
