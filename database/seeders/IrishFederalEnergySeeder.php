<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Budget;
use App\Models\Spending;
use App\Models\Initiative;

class IrishFederalEnergySeeder extends Seeder
{
    public function run()
    {
        // Create Federal Energy Department (if not exists)
        $energyDept = Department::firstOrCreate(
            ['slug' => 'federal-energy-ireland'],
            [
                'name' => 'Department of Enterprise, Trade and Employment - Energy Division',
                'description' => 'Irish Federal Energy Spending and Renewable Energy Initiatives',
                'is_active' => true,
            ]
        );

        // Annual budget for energy division
        Budget::create([
            'department_id' => $energyDept->id,
            'allocated_amount' => 2500000000, // €2.5 billion
            'fiscal_year' => 2025,
        ]);

        // Energy Spendings
        $this->createEnergySpendings($energyDept->id);

        // Major National Energy Initiatives
        Initiative::create([
            'department_id' => $energyDept->id,
            'title' => 'Ireland\'s Climate Action Plan - Energy Transition',
            'slug' => 'ireland-climate-energy-transition',
            'description' => 'National programme to achieve 80% renewable electricity by 2030 and net-zero emissions by 2050',
            'category' => 'Green Energy',
            'status' => 'active',
            'budget' => 850000000,
            'spent' => 520000000,
            'people_impacted' => 5100000, // Ireland population
            'irish_workers_employed' => 14500,
        ]);

        Initiative::create([
            'department_id' => $energyDept->id,
            'title' => 'National Offshore Wind Programme',
            'slug' => 'ireland-offshore-wind',
            'description' => 'Development of offshore wind farms around Irish coast for renewable energy generation',
            'category' => 'Offshore Renewable',
            'status' => 'active',
            'budget' => 1200000000,
            'spent' => 750000000,
            'people_impacted' => 5100000,
            'irish_workers_employed' => 8700,
        ]);

        Initiative::create([
            'department_id' => $energyDept->id,
            'title' => 'Residential Energy Efficiency Programme',
            'slug' => 'ireland-home-energy-upgrade',
            'description' => 'Nationwide programme to upgrade residential buildings with energy-efficient systems and insulation',
            'category' => 'Energy Efficiency',
            'status' => 'active',
            'budget' => 450000000,
            'spent' => 280000000,
            'people_impacted' => 1800000,
            'irish_workers_employed' => 12300,
        ]);

        Initiative::create([
            'department_id' => $energyDept->id,
            'title' => 'Electric Vehicle Infrastructure Rollout',
            'slug' => 'ireland-ev-infrastructure',
            'description' => 'Nationwide installation of 10,000+ electric vehicle charging points',
            'category' => 'Green Transport',
            'status' => 'active',
            'budget' => 280000000,
            'spent' => 165000000,
            'people_impacted' => 850000,
            'irish_workers_employed' => 4200,
        ]);

        Initiative::create([
            'department_id' => $energyDept->id,
            'title' => 'Hydrogen Economy Development',
            'slug' => 'ireland-hydrogen-economy',
            'description' => 'Research and development for green hydrogen production and fuel cell technology',
            'category' => 'Emerging Green Tech',
            'status' => 'active',
            'budget' => 320000000,
            'spent' => 145000000,
            'people_impacted' => 250000,
            'irish_workers_employed' => 3800,
        ]);
    }

    private function createEnergySpendings($departmentId)
    {
        $spendings = [
            // Renewable Energy Infrastructure
            [
                'description' => 'Onshore Wind Farm Development - West Coast',
                'amount' => 285000000,
                'category' => 'Wind Energy',
                'date' => '2025-01-10',
                'vendor' => 'Irish Wind Energy Ltd',
                'green' => true,
            ],
            [
                'description' => 'Solar Farm Implementation - Midlands Region',
                'amount' => 125000000,
                'category' => 'Solar Energy',
                'date' => '2025-01-15',
                'vendor' => 'Bright Solar Ireland',
                'green' => true,
            ],
            [
                'description' => 'Hydroelectric Generation Upgrades',
                'amount' => 95000000,
                'category' => 'Hydro Energy',
                'date' => '2025-01-20',
                'vendor' => 'Irish Water Power Corp',
                'green' => true,
            ],
            [
                'description' => 'Smart Grid Technology Implementation',
                'amount' => 180000000,
                'category' => 'Grid Modernization',
                'date' => '2025-02-01',
                'vendor' => 'EirGrid Digital Systems',
                'green' => true,
            ],
            [
                'description' => 'Battery Storage Systems (Renewable Integration)',
                'amount' => 165000000,
                'category' => 'Energy Storage',
                'date' => '2025-02-10',
                'vendor' => 'Celtic Energy Storage',
                'green' => true,
            ],
            
            // Energy Efficiency
            [
                'description' => 'Building Energy Performance Retrofit Programme',
                'amount' => 220000000,
                'category' => 'Building Efficiency',
                'date' => '2025-02-15',
                'vendor' => 'Irish Energy Efficiency Services',
                'green' => true,
            ],
            [
                'description' => 'District Heating Network Development',
                'amount' => 145000000,
                'category' => 'District Heat',
                'date' => '2025-03-01',
                'vendor' => 'European District Heating Ltd',
                'green' => true,
            ],
            
            // Transportation
            [
                'description' => 'EV Charging Infrastructure Expansion',
                'amount' => 165000000,
                'category' => 'EV Infrastructure',
                'date' => '2025-03-05',
                'vendor' => 'Chargenet Ireland',
                'green' => true,
            ],
            [
                'description' => 'Electric Bus Fleet - Dublin, Cork, Limerick',
                'amount' => 285000000,
                'category' => 'Public Transport',
                'date' => '2025-03-10',
                'vendor' => 'Bus Eireann Green Fleet',
                'green' => true,
            ],
            
            // Research & Development
            [
                'description' => 'Hydrogen Production Research Facility',
                'amount' => 95000000,
                'category' => 'Research & Development',
                'date' => '2025-03-15',
                'vendor' => 'Trinity College Dublin Research',
                'green' => true,
            ],
            [
                'description' => 'Carbon Capture Technology Research',
                'amount' => 75000000,
                'category' => 'Research & Development',
                'date' => '2025-03-20',
                'vendor' => 'University College Dublin',
                'green' => true,
            ],
            
            // Natural Gas (Transition Fuel)
            [
                'description' => 'Natural Gas Network Maintenance & Safety',
                'amount' => 185000000,
                'category' => 'Gas Infrastructure',
                'date' => '2025-01-25',
                'vendor' => 'Gas Networks Ireland',
                'fossil' => true,
            ],
            
            // Nuclear (Planning & Safety)
            [
                'description' => 'Small Modular Reactor Research & Development',
                'amount' => 65000000,
                'category' => 'Nuclear Research',
                'date' => '2025-02-20',
                'vendor' => 'Irish Nuclear Safety Institute',
                'green' => true, // Clean energy but separate category
            ],
            
            // Administrative & Planning
            [
                'description' => 'Energy Policy & Planning Implementation',
                'amount' => 45000000,
                'category' => 'Administration',
                'date' => '2025-01-05',
                'vendor' => 'Department of Enterprise',
                'green' => false,
            ],
        ];

        foreach ($spendings as $spending) {
            Spending::create([
                'department_id' => $departmentId,
                'category' => $spending['category'],
                'description' => $spending['description'],
                'amount' => $spending['amount'],
                'transaction_date' => $spending['date'],
                'vendor' => $spending['vendor'],
                'is_green_energy' => $spending['green'] ?? false,
                'is_fossil_fuel_related' => $spending['fossil'] ?? false,
                'supports_homelessness_initiative' => false,
            ]);
        }
    }
}
