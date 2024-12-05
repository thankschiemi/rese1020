<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    public function run()
    {
        // 定義されたユーザーを挿入
        $members = [
            [
                'name' => 'Test User 1',
                'email' => 'test1@example.com',
                'password' => bcrypt('password123'),
                'role' => 'user', // 明示的に role を指定
            ],
            [
                'name' => 'Test Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('adminpassword'),
                'role' => 'admin', // 明示的に role を指定
            ],
        ];

        foreach ($members as $member) {
            // 重複を避けるため、存在しない場合のみ挿入
            Member::firstOrCreate(
                ['email' => $member['email']], // メールで重複チェック
                $member
            );
        }
    }
}
