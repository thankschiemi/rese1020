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
            'description' => $this->faker->paragraph,
            'image_url' => $this->faker->imageUrl(640, 480, 'food'),
            'member_id' => null,
        ];
    }
}
