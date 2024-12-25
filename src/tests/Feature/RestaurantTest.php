<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RestaurantTest extends TestCase
{
    /** @test */
    public function it_displays_the_restaurant_list_page()
    {
        // ページへアクセス
        $response = $this->get('/');

        // ステータスコード200を確認
        $response->assertStatus(200);

        // 必要なテキストやビューの確認
        $response->assertSee('Rese');
    }
}

