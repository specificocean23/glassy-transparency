<?php

namespace Database\Factories;

use App\Models\Spending;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpendingFactory extends Factory
{
    protected $model = Spending::class;

    public function definition(): array
    {
        return [
            'department_id' => Department::inRandomOrder()->first()->id ?? Department::factory(),
            'amount' => fake()->numberBetween(1000, 100000),
            'description' => fake()->text(100),
            'date' => fake()->dateTimeBetween('-12 months'),
            'green_energy_related' => fake()->boolean(30),
            'fossil_fuel_related' => fake()->boolean(15),
            'supports_homelessness_initiative' => fake()->boolean(25),
            'vendor_name' => fake()->company(),
            'reference_number' => fake()->bothify('REF-###-####'),
        ];
    }
}
