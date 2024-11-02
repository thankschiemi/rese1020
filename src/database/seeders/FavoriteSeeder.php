<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Favorite;

class FavoriteSeeder extends Seeder
{
    public function run()
    {
        Favorite::create([
            'member_id' => 1,
            'restaurant_id' => 1,
        ]);

        Favorite::create([
            'member_id' => 2,
            'restaurant_id' => 2,
        ]);
    }
}
