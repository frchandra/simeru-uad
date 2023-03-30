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
            "name" => "R.105",
            "quota" => 100,
        ]);
        Room::create([
            "name" => "R.304C",
            "quota" => 100,
        ]);
        Room::create([
            "name" => "R.304B",
            "quota" => 100,
        ]);
        Room::create([
            "name" => "Audit",
            "quota" => 100,
        ]);
        Room::create([
            "name" => "301",
            "quota" => 75,
        ]);
        Room::create([
            "name" => "401",
            "quota" => 75,
        ]);
        Room::create([
            "name" => "303",
            "quota" => 75,
        ]);
        Room::create([
            "name" => "104",
            "quota" => 75,
        ]);
        Room::create([
            "name" => "105",
            "quota" => 75,
        ]);
        Room::create([
            "name" => "313",
            "quota" => 75,
        ]);
        Room::create([
            "name" => "106",
            "quota" => 75,
        ]);
        Room::create([
            "name" => "202A",
            "quota" => 75,
        ]);
        Room::create([
            "name" => "403",
            "quota" => 75,
        ]);
    }
}
