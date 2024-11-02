<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 他のシーダーを追加する場合は、ここに追加
        $this->call([

            RegionSeeder::class,
            GenreSeeder::class,
            RestaurantSeeder::class,
            MemberSeeder::class,
            ReservationSeeder::class,
            FavoriteSeeder::class,
        ]);
    }
}
