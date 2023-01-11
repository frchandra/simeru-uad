<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LecturerPlotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(){
        return [
            'is_held' => false,
            'lecturer_id' => fake()->numberBetween(1,10),
            'sub_class_id' => fake()->numberBetween(1,30),
            'academic_year_id' => fake()->numberBetween(1,6)
        ];
    }
}
