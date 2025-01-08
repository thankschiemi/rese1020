<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Member;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function it_displays_the_login_page()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    public function test_it_allows_a_user_to_login()
    {
        $user = Member::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
            '_token' => csrf_token(),
        ]);

        $response->assertRedirect('/main_menu');
        $this->assertAuthenticatedAs($user);
    }

    public function test_rejects_invalid_login_attempts()
    {
        $response = $this->withoutMiddleware()->post('/login', [
            'email' => 'wrong@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }
}
