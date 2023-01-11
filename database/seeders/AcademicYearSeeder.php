<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        for($i=2022; $i<2025; $i++){
            for($j=0; $j<2; $j++){
                AcademicYear::create([
                    'start_year' => $i,
                    'end_year' => $i+1,
                    'semester' => $j,
                ]);
            }
        }

    }
}
