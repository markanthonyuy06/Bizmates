<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('locations')->insert([[
            'id' =>'1850147',
            'name' => 'Tokyo',
            'state' => '',
            'country_code'=> "JP",
            'lon'=> '139.691711',
            'lat'=> '35.689499'
        ],
         [
            'id' =>'2127436',
            'name' => 'Yokohama',
            'state' => '',
            'country_code'=> "JP",
            'lon'=> '141.25',
            'lat'=> '41.083328'
        ],[
            'id' =>'1857910',
            'name' => 'Kyoto',
            'state' => '',
            'country_code'=> "JP",
            'lon'=> '135.753845',
            'lat'=> '35.021069'
        ],
        [
            'id' =>'1853908',
            'name' => 'Osaka',
            'state' => '',
            'country_code'=> "JP",
            'lon'=> '137.266663',
            'lat'=> '35.950001'
        ],
        [
            'id' =>'2128295',
            'name' => 'Sapporo',
            'state' => '',
            'country_code'=> "JP",
            'lon'=> '141.346939',
            'lat'=> '43.064171'
        ],
        [
            'id' =>'1856057',
            'name' => 'Nagoya',
            'state' => '',
            'country_code'=> "JP",
            'lon'=> '136.906403',
            'lat'=> '35.181469'
        ]]);
    }
}
