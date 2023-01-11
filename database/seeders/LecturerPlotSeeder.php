<?php

namespace Database\Seeders;

use App\Models\LecturerPlot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LecturerPlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        for($i=1; $i<13; $i++){
            LecturerPlot::create([
                'is_held' => false,
                'lecturer_id' => fake()->numberBetween(1,6),
                'sub_class_id' => $i,
                'academic_year_id' => 2
            ]);
        }
    }
}
