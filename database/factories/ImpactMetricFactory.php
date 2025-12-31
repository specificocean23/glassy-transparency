<?php

namespace Database\Factories;

use App\Models\ImpactMetric;
use App\Models\Initiative;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImpactMetricFactory extends Factory
{
    protected $model = ImpactMetric::class;

    public function definition(): array
    {
        return [
            'initiative_id' => Initiative::inRandomOrder()->first()->id ?? Initiative::factory(),
            'metric_name' => fake()->randomElement([
                'CO2 Emissions Reduced (tons)',
                'People Housed',
                'Energy Saved (kWh)',
                'Jobs Created',
                'Families Supported',
                'Green Energy Generated (MWh)',
                'Training Hours Completed',
                'Cost Savings Achieved',
            ]),
            'metric_type' => fake()->randomElement(['numeric', 'percentage', 'text']),
            'current_value' => fake()->numberBetween(10, 10000),
            'target_value' => fake()->numberBetween(15, 15000),
            'unit_of_measurement' => fake()->randomElement(['units', '%', 'hours', 'EUR', 'tons', 'kWh', 'MWh']),
            'measurement_date' => fake()->dateTimeBetween('-6 months'),
            'notes' => fake()->text(100),
        ];
    }
}
