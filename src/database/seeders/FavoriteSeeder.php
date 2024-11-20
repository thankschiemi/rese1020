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
        $members = Member::pluck('id')->toArray(); // 全メンバーIDを取得
        $restaurants = Restaurant::pluck('id')->toArray(); // 全店舗IDを取得

        foreach ($members as $memberId) {
            // 各メンバーに対してランダムな店舗をお気に入りに登録
            $randomRestaurants = array_rand(array_flip($restaurants), rand(1, 3)); // 1～3店舗をランダム選択

            foreach ((array) $randomRestaurants as $restaurantId) {
                Favorite::firstOrCreate([ // 重複チェックを追加
                    'member_id' => $memberId,
                    'restaurant_id' => $restaurantId,
                ]);
            }
        }
    }
}
