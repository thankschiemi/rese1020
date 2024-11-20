<?php

namespace Database\Factories;

use App\Models\Restaurant;
use App\Models\Genre;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory
{
    protected $model = Restaurant::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company, // 店舗名
            'region_id' => Region::inRandomOrder()->first()->id,
            'genre_id' => Genre::factory(), // ジャンルID
            'image_url' => $this->faker->imageUrl(), // 店舗画像のURL
        ];
    }
}
