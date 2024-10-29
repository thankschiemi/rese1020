<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reservation::create([
            'member_id' => 1, // テスト用に存在する会員IDを指定
            'restaurant_id' => 1, // テスト用に存在するレストランIDを指定
            'reservation_date' => Carbon::now()->format('Y-m-d'),
            'reservation_time' => Carbon::now()->format('H:i:s'),
            'number_of_people' => 2,
        ]);

        Reservation::create([
            'member_id' => 2,
            'restaurant_id' => 2,
            'reservation_date' => Carbon::now()->addDays(1)->format('Y-m-d'),
            'reservation_time' => '18:00:00',
            'number_of_people' => 4,
        ]);

        // 必要に応じて、他のデータも追加可能
    }
}
