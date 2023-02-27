<?php

namespace Database\Factories\Admin;

use Illuminate\Database\Eloquent\Factories\Factory;

class FinanceFactory extends Factory
{
    public function definition()
    {
        return [
            'type' => rand(0, 1),
            'ammount' => fake()->numberBetween(100000, 50000000),
            'date' => fake()->dateTimeBetween($startDate = '-6 months', $endDate = 'now')
        ];
    }
}
