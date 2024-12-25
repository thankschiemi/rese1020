<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Restaurant;
use App\Models\Region;
use App\Models\Genre;
use App\Models\Member; // 認証用モデル

class RestaurantDetailTest extends TestCase
{
    use RefreshDatabase;

    public function testDetailPageDisplaysCorrectly()
    {
        // 認証ユーザーを作成してログイン
        $member = Member::factory()->create(); // 認証用のMemberモデルを作成
        // 型アノテーションを明示
        /** @var \App\Models\Member $member */
        $this->actingAs($member, 'web'); // ログイン状態をシミュレート

        // 必要なデータをシーダーから取得
        $region = Region::firstOrCreate(['name' => '東京都']);
        $genre = Genre::firstOrCreate(['name' => '寿司']);

        // 正常なレストランデータを作成
        $restaurant = Restaurant::factory()->create([
            'name' => '木船',
            'region_id' => $region->id,
            'genre_id' => $genre->id,
            'description' => '毎日店主自ら市場等に出向き、厳選した魚介類が、お鮨をはじめとした繊細な料理に仕立てられます。',
            'image_url' => 'images/sushi-image.jpg',
        ]);

        // 詳細ページが正常に表示されるか
        $response = $this->get('/detail/' . $restaurant->id);
        $response->assertStatus(200);
        $response->assertSee($restaurant->name);

        // 存在しないレストランIDで404が返るか
        $response = $this->get('/detail/99999'); // 存在しないID
        $response->assertStatus(404);
    }
}
