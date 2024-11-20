<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    public function run()
    {
        // 地域を直接登録（ユニーク制約を回避）
        $regions = ['東京', '大阪', '福岡'];

        foreach ($regions as $region) {
            Region::firstOrCreate(['name' => $region]);
        }
    }
}
