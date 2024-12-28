<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /** @test */
    public function it_displays_the_register_page()
    {
        // ページへアクセス
        $response = $this->get('/register');

        // ステータスコード200を確認
        $response->assertStatus(200);

        // 必要なビューの確認
        $response->assertViewIs('auth.register');
    }

    /** @test */
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
