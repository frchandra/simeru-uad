<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\LecturerPlot;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        $this->call([
            LecturerSeeder::class,
            SubClassSeeder::class,
            RoomSeeder::class,
            TimeSeeder::class,
            AcademicYearSeeder::class,
//            LecturerPlotSeeder::class,
        ]);
    }
}
