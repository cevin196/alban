<?php

namespace Database\Factories\Admin;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\admin\criteria>
 */
class criteriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'criteria ' . fake()->randomNumber,
            'weight' => rand(1, 5),
            'unit' => 'pcs',
            'description' => fake()->paragraph(rand(2, 5))
        ];
    }
}
