<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Budget;
use App\Models\Spending;
use App\Models\Initiative;

class WaterfordCouncilSeeder extends Seeder
{
    public function run()
    {
        // Waterford Council Departments
        $departments = [
            [
                'name' => 'Housing & Community Development',
                'slug' => 'housing-community',
                'description' => 'Waterford Council Housing Services and Community Development',
                'is_active' => true,
            ],
            [
                'name' => 'Planning & Development',
                'slug' => 'planning-development',
                'description' => 'Planning, development and building control services',
                'is_active' => true,
            ],
            [
                'name' => 'Roads & Transportation',
                'slug' => 'roads-transportation',
                'description' => 'Road maintenance, transportation and mobility services',
                'is_active' => true,
            ],
            [
                'name' => 'Environment & Water Services',
                'slug' => 'environment-water',
                'description' => 'Environmental protection and water supply services',
                'is_active' => true,
            ],
            [
                'name' => 'Recreation & Culture',
                'slug' => 'recreation-culture',
                'description' => 'Parks, recreation facilities and cultural services',
                'is_active' => true,
            ],
            [
                'name' => 'Finance & Administration',
                'slug' => 'finance-admin',
                'description' => 'Financial management and administrative services',
                'is_active' => true,
            ],
        ];

        foreach ($departments as $dept) {
            $department = Department::create($dept);

            // Add budget for each department (Annual 2025)
            Budget::create([
                'department_id' => $department->id,
                'allocated_amount' => match($department->name) {
                    'Housing & Community Development' => 2850000,
                    'Planning & Development' => 1200000,
                    'Roads & Transportation' => 3500000,
                    'Environment & Water Services' => 2100000,
                    'Recreation & Culture' => 950000,
                    'Finance & Administration' => 800000,
                    default => 1000000,
                },
                'fiscal_year' => 2025,
                'budget_date' => now(),
            ]);
        }

        // Housing & Community Development Spendings
        $this->createSpending(Department::where('slug', 'housing-community')->first()->id, [
            ['description' => 'Waterford Housing Assessment Programme', 'amount' => 450000, 'category' => 'Housing Development', 'date' => '2025-01-15'],
            ['description' => 'Anti-Homelessness Emergency Accommodation', 'amount' => 380000, 'category' => 'Homelessness Support', 'date' => '2025-01-20', 'homelessness' => true],
            ['description' => 'Community Support Worker Training', 'amount' => 125000, 'category' => 'Community Services', 'date' => '2025-02-01'],
            ['description' => 'Social Housing Maintenance & Repairs', 'amount' => 680000, 'category' => 'Housing Maintenance', 'date' => '2025-02-10'],
            ['description' => 'Vulnerable Persons Accommodation Grant', 'amount' => 220000, 'category' => 'Housing Support', 'date' => '2025-03-05', 'homelessness' => true],
        ]);

        // Planning & Development Spendings
        $this->createSpending(Department::where('slug', 'planning-development')->first()->id, [
            ['description' => 'Building Regulation Enforcement', 'amount' => 185000, 'category' => 'Building Control', 'date' => '2025-01-10'],
            ['description' => 'Development Management Software', 'amount' => 95000, 'category' => 'IT & Systems', 'date' => '2025-01-25'],
            ['description' => 'Planning Authority Consultation Process', 'amount' => 145000, 'category' => 'Planning Services', 'date' => '2025-02-15'],
            ['description' => 'Heritage & Conservation Site Surveys', 'amount' => 175000, 'category' => 'Conservation', 'date' => '2025-03-01'],
        ]);

        // Roads & Transportation Spendings
        $this->createSpending(Department::where('slug', 'roads-transportation')->first()->id, [
            ['description' => 'Cork Road Surface Treatment Programme', 'amount' => 580000, 'category' => 'Road Maintenance', 'date' => '2025-01-05'],
            ['description' => 'Dunmore Road Resurfacing Project', 'amount' => 420000, 'category' => 'Road Infrastructure', 'date' => '2025-01-18'],
            ['description' => 'Public Transport Bus Fleet Maintenance', 'amount' => 320000, 'category' => 'Public Transport', 'date' => '2025-02-01'],
            ['description' => 'Traffic Management & Safety Measures', 'amount' => 195000, 'category' => 'Road Safety', 'date' => '2025-02-20'],
            ['description' => 'Cycling Infrastructure Development', 'amount' => 285000, 'category' => 'Sustainable Transport', 'date' => '2025-03-10', 'green_energy' => true],
            ['description' => 'Electric Bus Procurement (Phase 1)', 'amount' => 850000, 'category' => 'Green Transport', 'date' => '2025-03-15', 'green_energy' => true],
        ]);

        // Environment & Water Services Spendings
        $this->createSpending(Department::where('slug', 'environment-water')->first()->id, [
            ['description' => 'Water Supply Infrastructure Upgrade', 'amount' => 680000, 'category' => 'Water Services', 'date' => '2025-01-12'],
            ['description' => 'Wastewater Treatment Plant Operations', 'amount' => 520000, 'category' => 'Environmental Services', 'date' => '2025-01-20'],
            ['description' => 'Waterford Environmental Monitoring Programme', 'amount' => 185000, 'category' => 'Environmental Protection', 'date' => '2025-02-05'],
            ['description' => 'River Suir Flood Defence Works', 'amount' => 450000, 'category' => 'Flood Management', 'date' => '2025-02-15'],
            ['description' => 'Solar Panel Installation on Council Buildings', 'amount' => 325000, 'category' => 'Renewable Energy', 'date' => '2025-03-01', 'green_energy' => true],
        ]);

        // Recreation & Culture Spendings
        $this->createSpending(Department::where('slug', 'recreation-culture')->first()->id, [
            ['description' => 'Waterford Museum of Treasures Operations', 'amount' => 280000, 'category' => 'Cultural Services', 'date' => '2025-01-15'],
            ['description' => 'City Parks Maintenance & Improvements', 'amount' => 195000, 'category' => 'Parks & Recreation', 'date' => '2025-02-01'],
            ['description' => 'Waterford Sports & Recreation Centres', 'amount' => 220000, 'category' => 'Sport & Recreation', 'date' => '2025-02-10'],
            ['description' => 'Dunmore East Cultural Festival Support', 'amount' => 85000, 'category' => 'Cultural Events', 'date' => '2025-03-05'],
            ['description' => 'Green Space Development Programme', 'amount' => 165000, 'category' => 'Parks Development', 'date' => '2025-03-20', 'green_energy' => true],
        ]);

        // Initiatives
        Initiative::create([
            'department_id' => Department::where('slug', 'housing-community')->first()->id,
            'name' => 'Waterford Housing First Initiative',
            'slug' => 'waterford-housing-first',
            'description' => 'Comprehensive programme to provide stable housing and support to homeless individuals and families in Waterford',
            'category' => 'Homelessness',
            'status' => 'active',
            'budget' => 1200000,
            'spent' => 580000,
            'start_date' => now()->subMonths(6),
            'irish_workers_employed' => 38,
        ]);

        Initiative::create([
            'department_id' => Department::where('slug', 'roads-transportation')->first()->id,
            'name' => 'Waterford Sustainable Mobility Programme',
            'slug' => 'waterford-sustainable-mobility',
            'description' => 'Investment in green transport, cycling infrastructure and electric public transport for Waterford region',
            'category' => 'Green Transport',
            'status' => 'active',
            'budget' => 1800000,
            'spent' => 1125000,
            'start_date' => now()->subMonths(10),
            'irish_workers_employed' => 52,
        ]);

        Initiative::create([
            'department_id' => Department::where('slug', 'environment-water')->first()->id,
            'name' => 'River Suir Environmental Restoration',
            'slug' => 'river-suir-restoration',
            'description' => 'Ecological restoration and flood management programme for the River Suir',
            'category' => 'Environmental Protection',
            'status' => 'active',
            'budget' => 950000,
            'spent' => 450000,
            'start_date' => now()->subMonths(14),
            'irish_workers_employed' => 28,
        ]);

        Initiative::create([
            'department_id' => Department::where('slug', 'recreation-culture')->first()->id,
            'name' => 'Waterford Cultural Heritage Preservation',
            'slug' => 'waterford-cultural-heritage',
            'description' => 'Preservation and promotion of Waterford\'s rich cultural heritage and historic sites',
            'category' => 'Cultural Development',
            'status' => 'active',
            'budget' => 580000,
            'spent' => 340000,
            'start_date' => now()->subMonths(6),
            'irish_workers_employed' => 34,
        ]);
    }

    private function createSpending($departmentId, $records)
    {
        foreach ($records as $record) {
            Spending::create([
                'department_id' => $departmentId,
                'budget_id' => Budget::where('department_id', $departmentId)->first()->id,
                'category' => $record['category'],
                'description' => $record['description'],
                'amount' => $record['amount'],
                'transaction_date' => $record['date'],
                'vendor_name' => $this->getVendor($record['category']),
                'is_green_energy' => $record['green_energy'] ?? false,
                'is_fossil_fuel_related' => false,
                'supports_homelessness_initiative' => $record['homelessness'] ?? false,
            ]);
        }
    }

    private function getVendor($category)
    {
        return match($category) {
            'Housing Development' => 'Waterford Housing Association',
            'Homelessness Support' => 'Waterford Homeless Services',
            'Road Maintenance' => 'Irish Road Services Ltd',
            'Public Transport' => 'Bus Eireann',
            'Green Transport' => 'Irish Green Transport Ltd',
            'Sustainable Transport' => 'Waterford Cycling Initiative',
            'Water Services' => 'Irish Water - Waterford',
            'Renewable Energy' => 'SunPower Ireland',
            'Cultural Services' => 'Waterford Museum of Treasures',
            'Parks & Recreation' => 'Waterford Parks Management',
            default => 'Waterford Council Services',
        };
    }
}
