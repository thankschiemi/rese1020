<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Member;

class MyPageTest extends TestCase
{
    public function testMyPageDisplaysForAuthenticatedMember()
    {
        // テスト用の会員を作成してログイン
        $member = Member::factory()->create();
        $this->actingAs($member, 'web');


        // マイページへアクセス
        $response = $this->get('/mypage');
        $response->assertStatus(200);
        $response->assertSee($member->name);
    }

    public function testMyPageRedirectsForGuest()
    {
        // 未ログイン状態でのアクセス
        $response = $this->get('/mypage');
        $response->assertRedirect('/login'); // ログインページにリダイレクト
    }
}
