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
        for($i=1; $i<31; $i++){
            LecturerPlot::create([
                'is_held' => false,
                'lecturer_id' => fake()->numberBetween(1,10),
                'sub_class_id' => $i,
                'academic_year_id' => 2
            ]);
        }
    }
}
