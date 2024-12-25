<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Restaurant;

class RestaurantDetailTest extends TestCase
{
public function testDetailPageDisplaysCorrectly()
{
    // 正常なレストランデータを作成
    $restaurant = Restaurant::factory()->create();

    // ページが正常に表示されるか
    $response = $this->get('/detail/' . $restaurant->id);
    $response->assertStatus(200);
    $response->assertSee($restaurant->name);

    // 存在しないshop_idで404が返るか
    $response = $this->get('/detail/99999'); // 存在しないID
    $response->assertStatus(404);
}


}
