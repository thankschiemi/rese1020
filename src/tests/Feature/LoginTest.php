<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Member;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_login_page()
    {
        // ページへアクセス
        $response = $this->get('/login');

        // ステータスコード200を確認
        $response->assertStatus(200);

        // 必要なビューの確認
        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function it_allows_a_user_to_login()
    {
        // テストユーザー作成
        $user = Member::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        // 正しい情報でログイン試行
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/main_menu'); // ログイン後のリダイレクト先を確認
        $this->assertAuthenticatedAs($user); // 認証状態を確認
    }

    /** @test */
    public function it_rejects_invalid_login_attempts()
    {
        // 不正な情報でログイン試行
        $response = $this->post('/login', [
            'email' => 'wrong@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors(); // セッションにエラーが含まれるか確認
        $this->assertGuest(); // 認証されていないことを確認
    }
}

