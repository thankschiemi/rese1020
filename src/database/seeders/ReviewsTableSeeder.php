<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // レビューを複数件作成
        Review::factory()->count(10)->create(); // レビューを10件作成
    }
}
