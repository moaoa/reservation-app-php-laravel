<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
                
    }
}
/*

select * from rooms where id not in (select room_id from reservations where "2021-07-15"  between start_date and end_date OR "2021-07-20" BETWEEN start_date and end_date);

*/