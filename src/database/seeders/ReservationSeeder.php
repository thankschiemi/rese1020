<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\Member;
use App\Models\Restaurant;

class ReservationSeeder extends Seeder
{
    public function run()
    {
        // ランダムに50件の予約を生成
        Reservation::factory()->count(50)->create([
            // 既にシードされている Member の中からランダム
            'member_id' => Member::inRandomOrder()->first()->id,
            // 既にシードされている Restaurant の中からランダム
            'restaurant_id' => Restaurant::inRandomOrder()->first()->id,
        ]);
    }
}
