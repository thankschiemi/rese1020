<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    public function run()
    {
        $members = [
            [
                'name' => 'Test User 1',
                'email' => 'test1@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Test User 2',
                'email' => 'test2@example.com',
                'password' => Hash::make('password123'),
            ],
        ];

        foreach ($members as $member) {
            // 重複を避けるため、存在しない場合のみ挿入
            Member::firstOrCreate(
                ['email' => $member['email']],
                $member
            );
        }
    }
}
