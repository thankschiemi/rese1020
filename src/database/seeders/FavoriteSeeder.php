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
        // 存在するユーザーと店舗を対象にする
        $member = Member::first();
        $restaurant = Restaurant::first();

        if ($member && $restaurant) {
            $exists = Favorite::where('member_id', $member->id)
                ->where('restaurant_id', $restaurant->id)
                ->exists();

            if (!$exists) {
                Favorite::create([
                    'member_id' => $member->id,
                    'restaurant_id' => $restaurant->id,
                ]);
            }
        }
    }
}
