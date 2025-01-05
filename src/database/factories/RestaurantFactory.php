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
            'region_id' => null,
            'genre_id' => null,
            'description' => $this->faker->paragraph,
            'image_url' => $this->faker->imageUrl(640, 480, 'food'),
            'member_id' => null,
        ];
    }
}
