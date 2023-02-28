<?php

namespace Database\Seeders;

use App\Models\Time;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        for($i=1; $i<=6; $i++){
            for($j=1; $j<=12; $j++){
                Time::create([
                    'day'=>$i,
                    'session'=>$j
                ]);
            }
        }
    }
}
