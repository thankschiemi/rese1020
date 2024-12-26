<?php

namespace Tests\Feature;

use App\Models\Favorite;
use App\Models\Member;
use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FavoriteControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // シーダーデータを事前に適用
        $this->artisan('db:seed', ['--class' => 'DatabaseSeeder']);
    }

    public function test_redirects_to_account_settings_for_guest()
    {
        $restaurant = Restaurant::factory()->create([
            'region_id' => 1,
            'genre_id' => 1,
        ]);

        // ルート名を使用してURLを生成
        $response = $this->post(route('favorites.store', ['restaurant_id' => $restaurant->id]));
        $response->assertRedirect('/account-settings');
    }

    public function test_adds_favorite_for_authenticated_user()
    {
        $user = Member::factory()->create();
        $restaurant = Restaurant::factory()->create([
            'region_id' => 1,
            'genre_id' => 1,
        ]);

        /** @var \App\Models\Member $user */
        $this->actingAs($user);

        $response = $this->post(route('favorites.store', ['restaurant_id' => $restaurant->id]));
        $response->assertStatus(200)
            ->assertJson(['isFavorite' => true]);

        $this->assertDatabaseHas('favorites', [
            'member_id' => $user->id,
            'restaurant_id' => $restaurant->id,
        ]);
    }

    public function test_removes_favorite_for_authenticated_user()
    {
        $user = Member::factory()->create();
        $restaurant = Restaurant::factory()->create([
            'region_id' => 1,
            'genre_id' => 1,
        ]);

        $favorite = Favorite::create([
            'member_id' => $user->id,
            'restaurant_id' => $restaurant->id,
        ]);

        /** @var \App\Models\Member $user */
        $this->actingAs($user);

        $response = $this->post(route('favorites.store', ['restaurant_id' => $restaurant->id]));
        $response->assertStatus(200)
            ->assertJson(['isFavorite' => false]);

        $this->assertDatabaseMissing('favorites', [
            'id' => $favorite->id,
        ]);
    }
}
