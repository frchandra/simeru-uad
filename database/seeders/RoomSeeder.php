<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
//        Room::factory(3)->create();
        Room::create([
            "name" => "E1",
            "quota" => 75,
        ]);
        Room::create([
            "name" => "E2",
            "quota" => 75,
        ]);
        Room::create([
            "name" => "E3",
            "quota" => 75,
        ]);
        Room::create([
            "name" => "E4",
            "quota" => 75,
        ]);
        Room::create([
            "name" => "E5",
            "quota" => 75,
        ]);
        Room::create([
            "name" => "E6",
            "quota" => 75,
        ]);
        Room::create([
            "name" => "E7",
            "quota" => 75,
        ]);
        Room::create([
            "name" => "E8",
            "quota" => 75,
        ]);
    }
}
