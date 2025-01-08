<?php

namespace Tests\Feature;

use App\Models\Member;
use Tests\TestCase;

class AdminTest extends TestCase
{
    public function test_admin_can_update_user_role()
    {
        /** @var \App\Models\Member $admin*/
        $admin = Member::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $user = Member::factory()->create(['role' => 'member']);
        $response = $this->put("/admin/users/{$user->id}/role", [
            'role' => 'owner',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('members', [
            'id' => $user->id,
            'role' => 'owner',
        ]);
    }

    public function test_owner_cannot_update_user_role()
    {
        /** @var \App\Models\Member $owner*/
        $owner = Member::factory()->create(['role' => 'owner']);
        $this->actingAs($owner);

        $user = Member::factory()->create(['role' => 'member']);
        $response = $this->put("/admin/users/{$user->id}/role", [
            'role' => 'admin',
        ]);

        $response->assertStatus(403);
    }
}
