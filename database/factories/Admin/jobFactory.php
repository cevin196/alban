<?php

namespace Database\Factories\Admin;

use Illuminate\Database\Eloquent\Factories\Factory;

class jobFactory extends Factory
{
    public function definition()
    {
        return [
            'unit_part_number' => fake()->name(),
        ];
    }
}
