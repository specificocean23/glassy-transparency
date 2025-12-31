<?php

namespace Database\Factories;

use App\Models\Budget;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class BudgetFactory extends Factory
{
    protected $model = Budget::class;

    public function definition(): array
    {
        $allocated = fake()->numberBetween(100000, 2000000);

        return [
            'department_id' => Department::inRandomOrder()->first()->id ?? Department::factory(),
            'fiscal_year' => now()->year,
            'allocated_amount' => $allocated,
            'spent_amount' => fake()->numberBetween(0, $allocated),
            'notes' => fake()->text(100),
        ];
    }
}
