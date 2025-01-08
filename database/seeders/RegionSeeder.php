<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Region::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $regions = [
            ['name' => '東京都'],
            ['name' => '大阪府'],
            ['name' => '福岡県'],
        ];
        Region::insert($regions);
    }
}
