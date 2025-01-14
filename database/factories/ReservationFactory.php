<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition()
    {
        return [
            'member_id' => null,
            'restaurant_id' => null,
            'reservation_date' => $this->faker->dateTimeBetween('now', '+30 days')->format('Y-m-d'),
            'reservation_time' => $this->faker->time('H:i:s'),
            'number_of_people' => $this->faker->numberBetween(1, 6),
        ];
    }
}
