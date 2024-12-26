<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Member;

class OwnerTest extends TestCase
{
    public function test_owner_can_access_dashboard()
    {
        /** @var \App\Models\Member $owner */
        $owner = Member::factory()->create(['role' => 'owner']);
        $this->actingAs($owner);

        $response = $this->get('/owner/dashboard');
        $response->assertStatus(200)
            ->assertSee('店舗管理画面');
    }

    public function test_admin_cannot_access_owner_dashboard()
    {
        /** @var \App\Models\Member $admin */
        $admin = Member::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $response = $this->get('/owner/dashboard');
        $response->assertForbidden(); // 403チェック
    }



    public function test_guest_redirected_to_account_settings()
    {
        $response = $this->get('/owner/dashboard');
        $response->assertRedirect('/account-settings'); // 実際のリダイレクト先に合わせる
    }



    public function test_member_cannot_access_owner_dashboard()
    {
        /** @var \App\Models\Member $member */
        $member = Member::factory()->create(['role' => 'member']);
        $this->actingAs($member);

        $response = $this->get('/owner/dashboard');
        $response->assertForbidden(); // 403 を確認
    }
}
