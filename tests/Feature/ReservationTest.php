<?php

namespace Tests\Feature;

use App\Models\Member;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\Region;
use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
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
            'reservation_date' => now()->addDay()->format('Y-m-d'),
            'reservation_time' => '18:00',
            'number_of_people' => 4,
        ]);

        $response->assertRedirect(route('mypage'));
        $response->assertSessionHas('success', '予約情報が変更されました。');
    }

    public function test_reservation_update_fails_with_nonexistent_id()
    {
        $this->actingAs(Member::factory()->create());

        $response = $this->put('/reservation/9999', [
            'reservation_date' => '2025-12-31',
            'reservation_time' => '18:00',
            'number_of_people' => 4,
        ]);

        $response->assertStatus(404);
    }

    public function test_reservation_update_fails_with_invalid_data()
    {
        $region = Region::where('name', '東京都')->first();
        $genre = Genre::where('name', '寿司')->first();

        $member = Member::factory()->create();

        $restaurant = Restaurant::factory()->create([
            'region_id' => $region->id,
            'genre_id' => $genre->id,
        ]);

        $reservation = Reservation::factory()->create([
            'member_id' => $member->id,
            'restaurant_id' => $restaurant->id,
        ]);

        $response = $this->actingAs($member)->put('/reservation/' . $reservation->id, [
            'reservation_date' => '',
            'reservation_time' => 'invalid-time',
            'number_of_people' => -1,
        ]);

        $response->assertSessionHasErrors([
            'reservation_date',
            'reservation_time',
            'number_of_people',
        ]);
    }
}
