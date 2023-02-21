<?php

namespace Database\Factories\Admin;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\ConditionReport>
 */
class ConditionReportFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'date' => fake()->dateTimeBetween($startDate = '-6 months', $endDate = 'now'),
            'job_id' => 1,
        ];
    }
}
