<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;
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
