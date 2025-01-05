<?php

namespace Tests\Feature;

use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function it_displays_the_register_page()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);

        $response->assertViewIs('auth.register');
    }

    public function it_validates_user_registration()
    {
        $response = $this->withoutMiddleware()->post('/register', [
            'name' => '',
            'email' => '',
            'password' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }
}
