<?php

namespace Database\Factories;

use App\Models\Initiative;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class InitiativeFactory extends Factory
{
    protected $model = Initiative::class;

    public function definition(): array
    {
        $initiatives = [
            'Solar Panel Installation Program',
            'Green Energy Transition',
            'Homelessness Support Services',
            'Housing First Initiative',
            'Irish Employment Boost',
            'Renewable Energy Transition',
            'Community Support Services',
            'Sustainable Transport Program',
            'Skills Training Initiative',
            'Energy Efficiency Retrofit',
        ];

        $budget = fake()->numberBetween(50000, 500000);

        return [
            'department_id' => Department::inRandomOrder()->first()->id ?? Department::factory(),
            'name' => fake()->randomElement($initiatives),
            'description' => fake()->text(200),
            'start_date' => fake()->dateTimeBetween('-24 months'),
            'end_date' => fake()->dateTimeBetween('now', '+12 months'),
            'budget_allocated' => $budget,
            'budget_spent' => fake()->numberBetween(0, $budget),
            'irish_workers_employed' => fake()->numberBetween(5, 150),
            'green_energy_initiative' => fake()->boolean(60),
            'homelessness_related' => fake()->boolean(40),
            'status' => fake()->randomElement(['planning', 'active', 'completed']),
        ];
    }
}
