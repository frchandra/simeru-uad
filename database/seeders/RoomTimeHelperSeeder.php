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
        for($i=1; $i<=6; $i++){ //hari
            for($j=1; $j<=4; $j++){ //sesi
                for($k=1; $k<=8; $k++){ // room
                    RoomTimeHelper::create([
                        "room_id" => $k,
                        "time_id" => $i*$j,
                        "academic_year_id" => 1,
                        "is_occupied" => false,
                        "is_possible" => false,
                    ]);
                }

            }

        }
    }
}
