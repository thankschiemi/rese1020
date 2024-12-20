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
        // すべての Member と Restaurant の組み合わせを作成する例
        $members = Member::all();
        $restaurants = Restaurant::all();

        if ($members->isEmpty() || $restaurants->isEmpty()) {
            $this->command->info('Members または Restaurants のデータが不足しています。');
            return;
        }

        // 複数の Favorites をランダムに生成
        foreach ($members as $member) {
            $selectedRestaurants = $restaurants->random(rand(1, min(3, $restaurants->count()))); // ランダムに1〜3店舗選択

            foreach ($selectedRestaurants as $restaurant) {
                Favorite::firstOrCreate([
                    'member_id' => $member->id,
                    'restaurant_id' => $restaurant->id,
                ]);
            }
        }
    }
}
