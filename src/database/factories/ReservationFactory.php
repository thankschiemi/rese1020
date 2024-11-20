<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\Member;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition()
    {
        return [
            'member_id' => Member::factory(), // ダミーメンバー
            'restaurant_id' => Restaurant::factory(), // ダミーレストラン
            'reservation_date' => $this->faker->dateTimeBetween('now', '+1 year'), // 現在から1年以内の日付
            'reservation_time' => $this->faker->time('H:i:s'), // 時間
            'number_of_people' => $this->faker->numberBetween(1, 10), // 人数
        ];
    }
}
