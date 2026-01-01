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
        // Call the Waterford Council and Irish Energy seeders
        $this->call([
            WaterfordCouncilSeeder::class,
            IrishFederalEnergySeeder::class,
            IrishEnvironmentalDataSeeder::class,
        ]);
    }
}
