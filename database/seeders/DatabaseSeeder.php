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
        // Call transparency data seeder (includes new budget structure)
        $this->call([
            TransparencyDataSeeder::class,
        ]);
    }
}
