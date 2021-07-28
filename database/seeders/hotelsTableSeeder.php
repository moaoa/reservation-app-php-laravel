<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class hotelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $hotelsNames = "Crowne Plaza--Emerald Bay Inn--Hotel Bliss--University Inn--The New View--Ramada Limited & Suites--Sunset Lodge--Hotel Elite--Lake Place Inn--Beacon Motel--Comfort";
    public function run()
    {
        //
        $arr = explode('--', $this->hotelsNames);
        foreach($arr as $hotelName){
            DB::table('hotels')->insert([
                'name' => $hotelName
            ]);
        }
    }
}
