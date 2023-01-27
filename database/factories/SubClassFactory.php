<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubClass>
 */
class SubClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(){
        return [
            'name' => fake()->sentence(3),
            'quota' => fake()->numberBetween(60, 70),
            'credit' => 2,//fake()->numberBetween(1,3),
            'semester' => fake()->numberBetween(1,8)
        ];
    }
}
