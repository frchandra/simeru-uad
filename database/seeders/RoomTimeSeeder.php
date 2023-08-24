<?php

namespace Database\Seeders;

use App\Models\RoomTime;
use Illuminate\Database\Seeder;

class RoomTimeSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        for($i=1; $i<=13; $i++){//room
            for($j=1; $j<=6; $j++){ //hari
                for($k=1; $k<=12; $k++){ // sesi
                    RoomTime::create([
                        'room_id' => $i,
                        'time_id' => (($j-1)*12)+$k,
                        'academic_year_id' => 1,
                        'is_occupied' => false,
                    ]);
                }
            }
        }
    }
}
