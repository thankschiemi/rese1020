<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    public function run()
    {
        // 管理者、オーナー、一般ユーザーを固定で作成
        Member::firstOrCreate(
            ['email' => 'admin@example.com'], // ユニークキーでチェック
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

        // ランダムな一般ユーザーを作成
        Member::factory()->count(10)->create();
    }
}
