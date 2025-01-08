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
            'reservation_id' => Reservation::inRandomOrder()->first()->id,
            'restaurant_id' => Restaurant::inRandomOrder()->first()->id,
            'member_id' => Member::inRandomOrder()->first()->id,
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->sentence(10),
        ];
    }
}
