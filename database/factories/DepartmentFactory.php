<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    protected $model = Department::class;

    public function definition(): array
    {
        $departments = [
            'Housing & Homelessness',
            'Environment & Green Energy',
            'Parks & Recreation',
            'Transportation',
            'Education & Skills',
            'Health & Wellbeing',
            'Economic Development',
            'Community Services',
        ];

        return [
            'name' => fake()->randomElement($departments),
            'head_of_department' => fake()->name(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'annual_budget' => fake()->numberBetween(500000, 5000000),
            'description' => fake()->text(150),
        ];
    }
}
