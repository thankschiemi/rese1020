<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;

class ReservationSeeder extends Seeder
{
    public function run()
    {
        // ランダムに50件の予約を生成
        Reservation::factory()->count(50)->create();
    }
}
