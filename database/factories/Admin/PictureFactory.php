<?php

namespace Database\Factories\Admin;

use Illuminate\Database\Eloquent\Factories\Factory;

class PictureFactory extends Factory
{
    public function definition()
    {
        return [
            'description' => fake()->paragraph($nbSentences = rand(1, 4)),
            'path' => 'images/conditionReport/conditionReportDefault.jpeg',
            // 'condition_report_id' => 1,
        ];
    }
}
