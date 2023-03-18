<?php

namespace Database\Seeders;

use App\Models\RoomTimeHelper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTimeHelperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($h=1; $h<=2; $h++) {//academic year id
            for($i=1; $i<=8; $i++){ //room
                for($j=1; $j<=6; $j++){ //hari
                    for($k=1; $k<=12; $k++){ // sesi
                        RoomTimeHelper::create([
                            "room_id" => $i,
                            "time_id" => (($j-1)*12)+$k,
                            "academic_year_id" => $h,
                            "is_occupied" => false,
                            "is_possible" => false,
                        ]);
                    }

                }
            }
        }
    }
}
