<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Budget;
use App\Models\Spending;
use App\Models\Initiative;
use App\Models\ImpactMetric;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create specific departments
        $departments = [
            [
                'name' => 'Housing & Homelessness Services',
                'head_of_department' => 'Dr. Sarah O\'Neill',
                'email' => 'sarah.oneill@city.ie',
                'phone' => '+353 1 234 5678',
                'annual_budget' => 2500000,
                'description' => 'Focused on providing housing solutions and support for homeless individuals in the community.',
            ],
            [
                'name' => 'Environment & Green Energy',
                'head_of_department' => 'Michael Byrne',
                'email' => 'michael.byrne@city.ie',
                'phone' => '+353 1 234 5679',
                'annual_budget' => 1800000,
                'description' => 'Driving the transition to renewable energy and sustainable environmental practices.',
            ],
            [
                'name' => 'Parks & Recreation',
                'head_of_department' => 'Emma Murphy',
                'email' => 'emma.murphy@city.ie',
                'phone' => '+353 1 234 5680',
                'annual_budget' => 1200000,
                'description' => 'Managing public spaces and recreational facilities for community wellbeing.',
            ],
            [
                'name' => 'Transportation & Mobility',
                'head_of_department' => 'James Sullivan',
                'email' => 'james.sullivan@city.ie',
                'phone' => '+353 1 234 5681',
                'annual_budget' => 3200000,
                'description' => 'Improving public transport and sustainable mobility solutions.',
            ],
            [
                'name' => 'Community & Economic Development',
                'head_of_department' => 'Patricia Quinn',
                'email' => 'patricia.quinn@city.ie',
                'phone' => '+353 1 234 5682',
                'annual_budget' => 1500000,
                'description' => 'Supporting local businesses and community employment programs.',
            ],
        ];

        foreach ($departments as $dept) {
            Department::create($dept);
        }

        // Create budgets for each department
        Department::all()->each(function ($dept) {
            Budget::factory(3)->create(['department_id' => $dept->id]);
        });

        // Create spending records
        Department::all()->each(function ($dept) {
            Spending::factory(12)->create(['department_id' => $dept->id]);
        });

        // Create initiatives with realistic data
        $initiatives = [
            [
                'name' => 'Solar Dublin Initiative',
                'description' => 'Installing 500+ solar panels across city buildings to reduce carbon footprint.',
                'green_energy_initiative' => true,
                'homelessness_related' => false,
                'irish_workers_employed' => 45,
            ],
            [
                'name' => 'Housing First Programme',
                'description' => 'Providing permanent housing with wrap-around support services for homeless individuals.',
                'green_energy_initiative' => false,
                'homelessness_related' => true,
                'irish_workers_employed' => 32,
            ],
            [
                'name' => 'Green Energy Transition 2025',
                'description' => 'Converting all municipal fleet vehicles to electric power.',
                'green_energy_initiative' => true,
                'homelessness_related' => false,
                'irish_workers_employed' => 28,
            ],
            [
                'name' => 'Community Support Services',
                'description' => 'Expanding mental health and addiction support for vulnerable populations.',
                'green_energy_initiative' => false,
                'homelessness_related' => true,
                'irish_workers_employed' => 22,
            ],
            [
                'name' => 'Sustainable Transport Hub',
                'description' => 'Building bike lanes and improved public transport infrastructure.',
                'green_energy_initiative' => true,
                'homelessness_related' => false,
                'irish_workers_employed' => 67,
            ],
        ];

        foreach ($initiatives as $init) {
            $budget = fake()->numberBetween(100000, 400000);
            Initiative::create([
                'department_id' => Department::inRandomOrder()->first()->id,
                'name' => $init['name'],
                'description' => $init['description'],
                'start_date' => now()->subMonths(12),
                'end_date' => now()->addMonths(24),
                'budget_allocated' => $budget,
                'budget_spent' => fake()->numberBetween((int)($budget * 0.3), $budget),
                'irish_workers_employed' => $init['irish_workers_employed'],
                'green_energy_initiative' => $init['green_energy_initiative'],
                'homelessness_related' => $init['homelessness_related'],
                'status' => fake()->randomElement(['planning', 'active', 'completed']),
            ]);
        }

        // Create impact metrics for each initiative
        Initiative::all()->each(function ($initiative) {
            ImpactMetric::factory(3)->create(['initiative_id' => $initiative->id]);
        });
    }
}
