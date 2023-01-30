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
        for($i=1; $i<=8; $i++){ //room
            for($j=1; $j<=6; $j++){ //hari
                for($k=1; $k<=4; $k++){ // sesi
                    RoomTimeHelper::create([
                        "room_id" => $i,
                        "time_id" => (($j-1)*4)+$k,
                        "academic_year_id" => 1,
                        "is_occupied" => false,
                        "is_possible" => false,
                    ]);
                }

            }

        }
    }
}
