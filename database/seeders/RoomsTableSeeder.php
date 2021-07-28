<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $roomsNumbers = [1, 2, 3, 4, 5];
    

    public function run()
    {
        //
        $names = DB::table('hotels')->pluck('name');
        foreach($names as $name){
            foreach($this->roomsNumbers as $number){
                DB::table('rooms')->insert([
                    'room_number' => $number,
                    'hotel_id' => DB::table('hotels')->where('name', $name)->value('id'),
                    'price_per_night' => $number * 10,
                    'capacity' => $number > 3 ? 5 : 2
                ]);
            }
        }
        
        
    }
}
