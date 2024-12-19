<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory
{
    protected $model = \App\Models\Restaurant::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'region_id' => $this->faker->numberBetween(1, 5),
            'genre_id' => $this->faker->numberBetween(1, 5),
            'address' => $this->faker->address,
            'opening_hours' => '10:00-22:00',
            'member_id' => null,
        ];
    }
}
