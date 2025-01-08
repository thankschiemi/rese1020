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

        Reservation::factory()->count(50)->create([

            'member_id' => Member::inRandomOrder()->first()->id,
            'restaurant_id' => Restaurant::inRandomOrder()->first()->id,
        ]);
    }
}
