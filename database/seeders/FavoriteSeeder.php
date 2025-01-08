<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Favorite;
use App\Models\Member;
use App\Models\Restaurant;

class FavoriteSeeder extends Seeder
{
    public function run()
    {

        $members = Member::all();
        $restaurants = Restaurant::all();

        if ($members->isEmpty() || $restaurants->isEmpty()) {
            $this->command->info('Members または Restaurants のデータが不足しています。');
            return;
        }


        foreach ($members as $member) {
            $selectedRestaurants = $restaurants->random(rand(1, min(3, $restaurants->count())));

            foreach ($selectedRestaurants as $restaurant) {
                Favorite::firstOrCreate([
                    'member_id' => $member->id,
                    'restaurant_id' => $restaurant->id,
                ]);
            }
        }
    }
}
