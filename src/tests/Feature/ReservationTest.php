<?php

namespace Tests\Feature;

use App\Models\Member;
use App\Models\Reservation;
use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // テーブルが空の状態からシード
        $this->seed(); // DatabaseSeeder 全体を呼ぶ

        // あるいは個別シーダーだけ呼ぶ: 
        // $this->seed(\Database\Seeders\RestaurantSeeder::class);
    }

    public function test_reservation_can_be_updated_with_valid_data()
    {
        /** @var \App\Models\Member $member */
        $member = Member::factory()->create();
        $restaurant = Restaurant::first();
        $reservation = Reservation::factory()->create([
            'member_id' => $member->id,
            'restaurant_id' => $restaurant->id,
        ]);

        $response = $this->actingAs($member)->put('/reservation/' . $reservation->id, [
            'reservation_date' => '2024-12-31',
            'reservation_time' => '18:00',
            'number_of_people' => 4,
        ]);

        $response->assertRedirect(route('mypage'));
        $response->assertSessionHas('success', '予約情報が変更されました。');
    }

    public function test_reservation_update_fails_with_nonexistent_id()
    {
        $member = Member::factory()->create();

        // このIDは存在しない想定
        $nonexistentId = 99999;
        /** @var \App\Models\Member $member */
        $response = $this->actingAs($member)->put('/reservation/' . $nonexistentId, [
            // ルールに合わせて
            'reservation_date' => '2024-12-31',
            'reservation_time' => '18:00',
            'number_of_people' => 4,
        ]);

        // 存在しないIDなので、404を期待
        $response->assertStatus(404);
    }



    public function test_reservation_update_fails_with_invalid_data()
    {
        /** @var \App\Models\Member $member */
        $member = Member::factory()->create();
        $response = $this->actingAs($member)->put('/reservation/99999', [
            'reservation_date' => '2024-12-31',
            'reservation_time' => '18:00',
            'number_of_people' => 4,
        ]);
        $response->assertStatus(404);
    }
}
