<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        return [
            'reservation_id' => Reservation::factory(), // ダミー予約
            'restaurant_id' => Restaurant::factory(),   // ダミー店舗
            'member_id' => Member::factory(),           // ダミーメンバー
            'rating' => $this->faker->numberBetween(1, 5), // 1～5のランダム評価
            'comment' => $this->faker->sentence(10),       // ランダムコメント
        ];
    }
}
