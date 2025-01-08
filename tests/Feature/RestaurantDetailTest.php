<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Restaurant;
use App\Models\Region;
use App\Models\Genre;
use App\Models\Member;

class RestaurantDetailTest extends TestCase
{
    use RefreshDatabase;

    public function testDetailPageDisplaysCorrectly()
    {

        $member = Member::factory()->create();
        $this->actingAs($member, 'web');


        $region = Region::firstOrCreate(['name' => '東京都']);
        $genre = Genre::firstOrCreate(['name' => '寿司']);


        $restaurant = Restaurant::create([
            'name' => '木船',
            'region_id' => $region->id,
            'genre_id' => $genre->id,
            'description' => '毎日店主自ら市場等に出向き、厳選した魚介類が、お鮨をはじめとした繊細な料理に仕立てられます。',
            'image_url' => 'images/sushi-image.jpg',
        ]);


        $response = $this->get('/detail/' . $restaurant->id);
        $response->assertStatus(200);
        $response->assertSee($restaurant->name);


        $response = $this->get('/detail/99999');
        $response->assertStatus(404);
    }
}
