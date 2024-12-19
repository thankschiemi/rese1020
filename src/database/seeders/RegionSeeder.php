<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    public function run()
    {
        // 外部キー制約を無効にする
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // すべてのデータを削除
        Region::truncate();

        // 外部キー制約を有効に戻す
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // データの挿入
        $regions = [
            ['name' => '東京都'],
            ['name' => '大阪府'],
            ['name' => '福岡県'],
        ];
        Region::insert($regions);
    }
}
