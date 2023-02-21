<?php

namespace Database\Factories\Admin;

use Illuminate\Database\Eloquent\Factories\Factory;

class SparePartFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'qty' => rand(1, 5),
            'ammount' => fake()->randomNumber(6),
            'job_id' => 1,
        ];
    }
}
