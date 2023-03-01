<?php

namespace Database\Factories\Admin;

use Illuminate\Database\Eloquent\Factories\Factory;

class FinanceFactory extends Factory
{
    public function definition()
    {
        return [
            'description' => fake()->paragraph(1),
            'type' => rand(0, 1),
            'ammount' => fake()->numberBetween(100000, 10000000),
            'date' => fake()->dateTimeBetween($startDate = '-7 months', $endDate = 'now')
        ];
    }
}
