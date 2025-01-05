<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');


        Genre::truncate();


        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $genres = [
            ['name' => '寿司'],
            ['name' => '焼肉'],
            ['name' => '居酒屋'],
            ['name' => 'イタリアン'],
            ['name' => 'ラーメン'],
        ];

        Genre::insert($genres);
    }
}
