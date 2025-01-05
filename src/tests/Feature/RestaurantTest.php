<?php

namespace Tests\Feature;

use Tests\TestCase;

class RestaurantTest extends TestCase
{

    public function test_displays_the_restaurant_list_page()
    {

        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertSee('Rese');
    }
}
