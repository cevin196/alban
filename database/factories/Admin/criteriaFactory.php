<?php

namespace Database\Factories\Admin;

use Illuminate\Database\Eloquent\Factories\Factory;

class criteriaFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => 'criteria ' . fake()->randomNumber,
            'weight' => rand(1, 5),
            'unit' => 'pcs',
            'description' => fake()->paragraph(rand(2, 5)),
            'type' => rand(0, 1)
        ];
    }
}
