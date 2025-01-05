<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    public function run()
    {

        Member::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Test Admin',
                'password' => bcrypt('adminpassword'),
                'role' => 'admin',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
            ]
        );

        Member::firstOrCreate(
            ['email' => 'owner@example.com'],
            [
                'name' => 'Test Owner',
                'password' => bcrypt('ownerpassword'),
                'role' => 'owner',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
            ]
        );

        Member::factory()->count(10)->create();
    }
}
