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
        for($i=1; $i<4; $i++){
            for($j=1; $j<12; $j+=2){
                RoomTime::create([
                    'room_id' => $i,
                    'time_id' => $j,
                    'academic_year_id' => 1,
                    'is_occupied' => false,
                ]);
            }
        }
    }
}
