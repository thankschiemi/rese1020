<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
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

    public function test_it_allows_a_user_to_login()
    {
        $user = Member::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
            '_token' => csrf_token(), // CSRFトークンを明示的に追加
        ]);

        $response->assertRedirect('/main_menu');
        $this->assertAuthenticatedAs($user);
    }



    /**
     * 無効な情報でログインが失敗することを確認する
     *
     * @return void
     */
    public function test_rejects_invalid_login_attempts()
    {
        // 不正なログイン試行
        $response = $this->withoutMiddleware()->post('/login', [
            'email' => 'wrong@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors(['email']); // セッションエラーの確認
        $this->assertGuest(); // 認証されていないことの確認
    }
}
