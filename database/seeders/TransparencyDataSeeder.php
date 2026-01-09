<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\County;
use App\Models\FinancialCategory;
use App\Models\SpendingRecord;
use App\Models\Budget;
use App\Models\TimelineEvent;
use App\Models\SpendingItem;
use App\Models\RevenueStream;
use Carbon\Carbon;

class TransparencyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed new transparency data
        $this->seedTransparencyData();
        
        // Keep existing data seeding
        $this->seedCountiesAndCategories();
    }

    private function seedTransparencyData()
    {
        // Baseline Irish Government Spending for 2026 (euros)
        $baseline = [
            'Social Welfare & Family Support' => ['allocated' => 29200000000, 'spent' => 28900000000],
            'Health' => ['allocated' => 23500000000, 'spent' => 22100000000],
            'Education' => ['allocated' => 12800000000, 'spent' => 12400000000],
            'Infrastructure & Transport' => ['allocated' => 8400000000, 'spent' => 7800000000],
            'Housing - New Construction' => ['allocated' => 2800000000, 'spent' => 2600000000],
            'Housing - Existing Stock' => ['allocated' => 2100000000, 'spent' => 2000000000],
            'Justice & Policing (Gardai)' => ['allocated' => 4200000000, 'spent' => 4150000000],
            'Environment & Climate Action' => ['allocated' => 3100000000, 'spent' => 2900000000],
            'Fossil Fuel Phase-Out & Subsidies' => ['allocated' => 2100000000, 'spent' => 1950000000],
            'EU Programmes & Receipts' => ['allocated' => 1800000000, 'spent' => 1700000000],
            'EU Contributions' => ['allocated' => 1500000000, 'spent' => 1500000000],
            'Defence & Security' => ['allocated' => 1500000000, 'spent' => 1450000000],
            'Arts & Culture' => ['allocated' => 850000000, 'spent' => 780000000],
        ];

        $startYear = 2010;
        $endYear = 2026;

        for ($year = $endYear; $year >= $startYear; $year--) {
            $yearsBack = $endYear - $year;
            // Mild decay over time (~1.5% per year, bottoming at 60% of baseline)
            $decay = max(0.60, 1 - (0.015 * $yearsBack));

            foreach ($baseline as $category => $amounts) {
                $allocated = (int) round($amounts['allocated'] * $decay);
                // Spent typically close to allocated with small variance
                $spentVariance = 0.93 + (mt_rand(0, 10) / 100); // 0.93 - 1.03
                $spent = (int) round($allocated * $spentVariance);
                $predicted = (int) round($spent * 1.02);

                Budget::create([
                    'year' => $year,
                    'category' => $category,
                    'department' => $category,
                    'allocated_amount' => $allocated,
                    'spent_amount' => $spent,
                    'predicted_amount' => $predicted,
                    'status' => $spent > $allocated ? 'overbudget' : 'active',
                    'source' => 'Irish Government Budget ' . $year,
                ]);
            }
        }
    }

        // Create Timeline Events
        $events = [
            [
                'event_date' => '2025-12-01',
                'title' => 'Dublin Bike Rack Controversy',
                'description' => 'Two bicycle racks installed at a cost of €140,000, sparking public outrage over excessive spending on basic infrastructure.',
                'event_type' => 'expense',
                'amount' => 140000,
                'category' => 'Infrastructure',
                'department' => 'Department of Transport',
                'impact_level' => 'high',
                'is_featured' => true,
                'is_controversial' => true,
            ],
            [
                'event_date' => '2024-06-15',
                'title' => 'Google Tax Settlement',
                'description' => 'Google Ireland agrees to pay €15 million in back taxes following a multi-year investigation into their tax arrangements.',
                'event_type' => 'income',
                'amount' => 15000000,
                'category' => 'Corporate Tax',
                'department' => 'Department of Finance',
                'impact_level' => 'high',
                'is_featured' => true,
                'is_controversial' => false,
            ],
            [
                'event_date' => '2025-03-10',
                'title' => 'National Children\'s Hospital Cost Overrun',
                'description' => 'Budget for National Children\'s Hospital increases by another €200 million, bringing total to over €2 billion.',
                'event_type' => 'expense',
                'amount' => 200000000,
                'category' => 'Health',
                'department' => 'Department of Health',
                'impact_level' => 'critical',
                'is_featured' => true,
                'is_controversial' => true,
            ],
            [
                'event_date' => '2024-11-20',
                'title' => 'Apple Tax Windfall',
                'description' => 'Ireland receives €13.1 billion in back taxes from Apple following EU court ruling.',
                'event_type' => 'income',
                'amount' => 13100000000,
                'category' => 'Corporate Tax',
                'department' => 'Department of Finance',
                'impact_level' => 'critical',
                'is_featured' => true,
                'is_controversial' => false,
            ],
            [
                'event_date' => '2025-08-05',
                'title' => 'RTÉ Executive Expenses Scandal',
                'description' => 'Revelations of excessive spending on RTÉ executive perks including luxury travel and entertainment expenses.',
                'event_type' => 'expense',
                'amount' => 500000,
                'category' => 'Media',
                'department' => 'Department of Tourism, Culture, Arts',
                'impact_level' => 'high',
                'is_featured' => true,
                'is_controversial' => true,
            ],
            [
                'event_date' => '2025-01-15',
                'title' => 'COVID-19 Support Payment Overspend',
                'description' => 'Audit reveals €50 million in potentially fraudulent COVID-19 support payments.',
                'event_type' => 'expense',
                'amount' => 50000000,
                'category' => 'Social Welfare',
                'department' => 'Department of Social Protection',
                'impact_level' => 'critical',
                'is_featured' => true,
                'is_controversial' => true,
            ],
        ];

        foreach ($events as $event) {
            TimelineEvent::create($event);
        }

        // Create Questionable Spending Items
        $spendingItems = [
            [
                'date' => '2025-12-01',
                'title' => 'Two Bike Racks - Dublin City Centre',
                'description' => 'Installation of two standard bike racks in Dublin city centre at an extraordinary cost of €140,000. Public questioning extreme pricing.',
                'amount' => 140000,
                'category' => 'Infrastructure',
                'department' => 'Department of Transport',
                'vendor' => 'City Infrastructure Ltd',
                'location' => 'Dublin',
                'status' => 'completed',
                'is_questionable' => true,
                'public_interest_score' => 98,
            ],
            [
                'date' => '2025-10-15',
                'title' => 'Printer Toner - Department of Finance',
                'description' => '50 printer toner cartridges purchased at €500 each, far above market rate.',
                'amount' => 25000,
                'category' => 'Office Supplies',
                'department' => 'Department of Finance',
                'vendor' => 'Office Supplies Express',
                'location' => 'Dublin',
                'status' => 'completed',
                'is_questionable' => true,
                'public_interest_score' => 85,
            ],
            [
                'date' => '2025-09-20',
                'title' => 'Executive Travel - Minister Visit',
                'description' => 'Single round-trip business class travel to New York for ministerial delegation.',
                'amount' => 45000,
                'category' => 'Travel',
                'department' => 'Department of Foreign Affairs',
                'vendor' => 'Luxury Travel Ltd',
                'location' => 'New York',
                'status' => 'completed',
                'is_questionable' => true,
                'public_interest_score' => 75,
            ],
            [
                'date' => '2025-08-10',
                'title' => 'Consultancy Services - Restructuring',
                'description' => 'External consultants hired to advise on departmental restructuring at premium rates.',
                'amount' => 2500000,
                'category' => 'Consultancy',
                'department' => 'Department of Public Expenditure',
                'vendor' => 'Global Consulting Group',
                'location' => 'Dublin',
                'status' => 'completed',
                'is_questionable' => true,
                'public_interest_score' => 92,
            ],
        ];

        foreach ($spendingItems as $item) {
            SpendingItem::create($item);
        }

        // Create Revenue Streams
        $revenueStreams = [
            [
                'date' => '2024-11-20',
                'title' => 'Apple Tax Windfall',
                'description' => 'Back taxes from Apple following EU court ruling.',
                'amount' => 13100000000,
                'source_type' => 'settlement',
                'source_name' => 'Apple Inc.',
                'category' => 'Corporate Tax',
                'is_recurring' => false,
                'frequency' => 'one-time',
            ],
            [
                'date' => '2024-06-15',
                'title' => 'Google Tax Settlement',
                'description' => 'Settlement agreement for back taxes.',
                'amount' => 15000000,
                'source_type' => 'settlement',
                'source_name' => 'Google Ireland',
                'category' => 'Corporate Tax',
                'is_recurring' => false,
                'frequency' => 'one-time',
            ],
        ];

        foreach ($revenueStreams as $revenue) {
            RevenueStream::create($revenue);
        }

        $this->command->info('✅ Transparency data seeded successfully!');
        $this->command->info('   - ' . Budget::count() . ' budget records');
        $this->command->info('   - ' . TimelineEvent::count() . ' timeline events');
        $this->command->info('   - ' . SpendingItem::count() . ' spending items');
        $this->command->info('   - ' . RevenueStream::count() . ' revenue streams');
    }

    private function seedCountiesAndCategories()
    {
        // Create Counties
        $federal = County::create([
            'name' => 'All (Federal)',
            'slug' => 'all-federal',
            'is_federal' => true,
            'sort_order' => 0,
        ]);

        $waterford = County::create([
            'name' => 'Waterford',
            'slug' => 'waterford',
            'is_federal' => false,
            'sort_order' => 1,
        ]);

        $counties = ['Cork', 'Dublin', 'Galway', 'Limerick', 'Kerry', 'Mayo', 'Donegal', 'Clare', 'Tipperary', 'Wexford', 'Kilkenny', 'Meath', 'Louth', 'Wicklow', 'Sligo', 'Laois', 'Offaly', 'Westmeath', 'Carlow', 'Kildare', 'Cavan', 'Monaghan', 'Roscommon', 'Leitrim', 'Longford'];
        
        $order = 2;
        foreach ($counties as $countyName) {
            County::create([
                'name' => $countyName,
                'slug' => strtolower($countyName),
                'is_federal' => false,
                'sort_order' => $order++,
            ]);
        }

        // Create Financial Categories
        $categories = [
            [
                'name' => 'Fossil Fuels (Gas for Energy)',
                'slug' => 'fossil-fuels-gas',
                'description' => 'Spending on natural gas for energy production',
                'icon' => '⛽',
                'color' => '#ef4444',
                'is_environmental_negative' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Fossil Fuels (Oil)',
                'slug' => 'fossil-fuels-oil',
                'description' => 'Spending on oil and petroleum products',
                'icon' => '🛢️',
                'color' => '#dc2626',
                'is_environmental_negative' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Roads & Infrastructure',
                'slug' => 'roads-infrastructure',
                'description' => 'Investment in roads, highways, and transport infrastructure',
                'icon' => '🛣️',
                'color' => '#64748b',
                'sort_order' => 3,
            ],
            [
                'name' => 'Gardaí & Law Enforcement',
                'slug' => 'gardai-law-enforcement',
                'description' => 'Funding for police and law enforcement services',
                'icon' => '👮',
                'color' => '#3b82f6',
                'sort_order' => 4,
            ],
            [
                'name' => 'Current Housing (Maintenance)',
                'slug' => 'current-housing-maintenance',
                'description' => 'Maintenance and improvement of existing housing',
                'icon' => '🏠',
                'color' => '#f59e0b',
                'is_current_housing' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'New Housing Development',
                'slug' => 'new-housing-development',
                'description' => 'Construction of new housing units',
                'icon' => '🏗️',
                'color' => '#10b981',
                'is_new_housing' => true,
                'sort_order' => 6,
            ],
            [
                'name' => 'Wind Energy Projects',
                'slug' => 'wind-energy',
                'description' => 'Investment in wind turbine installations and wind farms',
                'icon' => '💨',
                'color' => '#06b6d4',
                'is_environmental_positive' => true,
                'sort_order' => 7,
            ],
            [
                'name' => 'Solar Energy Projects',
                'slug' => 'solar-energy',
                'description' => 'Investment in solar panels and solar energy infrastructure',
                'icon' => '☀️',
                'color' => '#eab308',
                'is_environmental_positive' => true,
                'sort_order' => 8,
            ],
            [
                'name' => 'Environmental Protection',
                'slug' => 'environmental-protection',
                'description' => 'Funding for conservation, biodiversity, and environmental programs',
                'icon' => '🌳',
                'color' => '#22c55e',
                'is_environmental_positive' => true,
                'sort_order' => 9,
            ],
            [
                'name' => 'Public Transport',
                'slug' => 'public-transport',
                'description' => 'Investment in buses, trains, and public transportation',
                'icon' => '🚌',
                'color' => '#8b5cf6',
                'is_environmental_positive' => true,
                'sort_order' => 10,
            ],
        ];

        foreach ($categories as $categoryData) {
            FinancialCategory::create($categoryData);
        }

        // Get all categories for creating spending records
        $allCategories = FinancialCategory::all();

        // Federal spending for 2026
        $federalSpending = [
            'fossil-fuels-gas' => 3000000000,
            'fossil-fuels-oil' => 2500000000,
            'roads-infrastructure' => 4000000000,
            'gardai-law-enforcement' => 2000000000,
            'current-housing-maintenance' => 1500000000,
            'new-housing-development' => 800000000,
            'wind-energy' => 600000000,
            'solar-energy' => 400000000,
            'environmental-protection' => 500000000,
            'public-transport' => 1200000000,
        ];

        foreach ($federalSpending as $slug => $amount) {
            $category = $allCategories->firstWhere('slug', $slug);
            SpendingRecord::create([
                'financial_category_id' => $category->id,
                'county_id' => $federal->id,
                'year' => 2026,
                'amount' => $amount,
            ]);
        }

        // Waterford specific spending for 2026
        $waterfordSpending = [
            'roads-infrastructure' => 70000000,
            'gardai-law-enforcement' => 35000000,
            'current-housing-maintenance' => 45000000,
            'new-housing-development' => 0,
            'wind-energy' => 15000000,
            'solar-energy' => 10000000,
            'environmental-protection' => 12000000,
            'public-transport' => 20000000,
        ];

        foreach ($waterfordSpending as $slug => $amount) {
            $category = $allCategories->firstWhere('slug', $slug);
            SpendingRecord::create([
                'financial_category_id' => $category->id,
                'county_id' => $waterford->id,
                'year' => 2026,
                'amount' => $amount,
            ]);
        }

        // Historical data for 2025
        foreach ($federalSpending as $slug => $amount) {
            $category = $allCategories->firstWhere('slug', $slug);
            SpendingRecord::create([
                'financial_category_id' => $category->id,
                'county_id' => $federal->id,
                'year' => 2025,
                'amount' => $amount * 0.95,
            ]);
        }

        foreach ($waterfordSpending as $slug => $amount) {
            $category = $allCategories->firstWhere('slug', $slug);
            SpendingRecord::create([
                'financial_category_id' => $category->id,
                'county_id' => $waterford->id,
                'year' => 2025,
                'amount' => $amount * 0.93,
            ]);
        }

        // Historical data for 2024
        foreach ($federalSpending as $slug => $amount) {
            $category = $allCategories->firstWhere('slug', $slug);
            SpendingRecord::create([
                'financial_category_id' => $category->id,
                'county_id' => $federal->id,
                'year' => 2024,
                'amount' => $amount * 0.90,
            ]);
        }

        foreach ($waterfordSpending as $slug => $amount) {
            $category = $allCategories->firstWhere('slug', $slug);
            SpendingRecord::create([
                'financial_category_id' => $category->id,
                'county_id' => $waterford->id,
                'year' => 2024,
                'amount' => $amount * 0.88,
            ]);
        }
    }
}

