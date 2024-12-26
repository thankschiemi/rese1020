<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Member;
use App\Models\Restaurant;
use App\Models\Reservation;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // ここで「DatabaseSeeder」を呼び出すので、テーブルが空でも初期データが再投入される
        $this->seed();
        // もし DatabaseSeeder の中で RestaurantSeeder を呼んでいれば
        // restaurants テーブルにデータが入るようになる
    }

    public function test_review_can_be_created_with_valid_data()
    {
        $member = Member::factory()->create();
        $restaurant = Restaurant::first();
        $reservation = Reservation::factory()->create([
            'member_id' => $member->id,
            'restaurant_id' => $restaurant->id,
        ]);

        /** @var \App\Models\Member $member */
        $response = $this->actingAs($member)->post('/reviews', [
            'reservation_id' => $reservation->id,
            'restaurant_id' => $restaurant->id,
            'rating'         => 5,
            'comment'        => 'Excellent service!',
        ]);

        // 成功時はmypageへリダイレクト(302)なので
        $response->assertRedirect(route('mypage'));
        // セッションメッセージの確認なども可能
        $response->assertSessionHas('success', '評価を送信しました！下記の評価ボタンをクリックすると、作成した評価を確認できます。');

        // DBにレコードが保存されていることを確認
        $this->assertDatabaseHas('reviews', [
            'reservation_id' => $reservation->id,
            'rating'         => 5,
            'comment'        => 'Excellent service!',
        ]);
    }


    public function test_review_creation_fails_with_invalid_data()
    {
        $member = Member::factory()->create();
        $restaurant = Restaurant::first();

        $reservation = Reservation::factory()->create([
            'member_id' => $member->id,
            'restaurant_id' => $restaurant->id,
        ]);

        /** @var \App\Models\Member $member */
        $response = $this->actingAs($member)->postJson('/reviews', [
            'reservation_id' => $reservation->id,
            'restaurant_id'  => $reservation->restaurant_id,
            'rating'         => 6, // バリデーションNG値
            'comment'        => str_repeat('a', 1001), // 1000文字超
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['rating', 'comment']);
    }
}
