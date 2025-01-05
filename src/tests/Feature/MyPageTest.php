<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Member;

class MyPageTest extends TestCase
{
    use RefreshDatabase;

    public function testMyPageDisplaysForAuthenticatedMember()
    {

        /** @var \App\Models\Member $member */
        $member = Member::factory()->create();
        $this->actingAs($member, 'web');

        $response = $this->get('/mypage');
        $response->assertStatus(200);
        $response->assertSee($member->name);
    }

    public function testMyPageRedirectsForGuest()
    {
        $response = $this->get('/mypage');
        $response->assertRedirect('/account-settings');
    }
}
