<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    public function run()
    {
        // 外部キー制約を無効にする
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // テーブルをクリアする
        Genre::truncate();

        // 外部キー制約を再び有効にする
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // データの挿入
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
