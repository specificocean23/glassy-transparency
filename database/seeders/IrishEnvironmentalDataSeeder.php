<?php

namespace Database\Seeders;

use App\Models\EnvironmentalMetric;
use App\Models\ImpactComparison;
use App\Models\SeaLevelProjection;
use App\Models\Technology;
use App\Models\Event;
use App\Models\CaseStudy;
use App\Models\Policy;
use App\Models\AdvocacyCampaign;
use Illuminate\Database\Seeder;

class IrishEnvironmentalDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedTechnologies();
        $this->seedEnvironmentalMetrics();
        $this->seedImpactComparisons();
        $this->seedSeaLevelProjections();
        $this->seedPolicies();
        $this->seedCaseStudies();
        $this->seedAdvocacyCampaigns();
        $this->seedEvents();
    }

    private function seedTechnologies(): void
    {
        Technology::create([
            'name' => 'Vanadium Redox Flow Battery (VRFB)',
            'slug' => 'vanadium-redox-flow-battery',
            'category' => 'storage',
            'description' => 'Long-duration energy storage ideal for balancing Ireland\'s wind-heavy grid. VRFBs store energy in liquid electrolytes, making them perfect for seasonal storage and grid stabilization.',
            'technical_specs' => [
                'energy_density' => '20-35 Wh/L',
                'power_rating' => '1-200 MW',
                'duration' => '4-12+ hours',
                'response_time' => '<1 second',
            ],
            'advantages' => '• 20-30 year lifespan with no degradation
• Decoupled power and energy capacity (scale independently)
• 100% depth of discharge with no damage
• Non-flammable and inherently safe
• Perfect for long-duration storage (days, weeks)
• Can handle Ireland\'s frequent wind variability',
            'disadvantages' => '• Lower energy density than Li-ion (needs more space)
• Higher upfront capital cost
• Lower round-trip efficiency (65-75% vs 85-95% Li-ion)
• Vanadium supply chain concerns',
            'irish_applications' => 'Ireland\'s wind-rich, low-inertia grid faces increasing periods of surplus wind and "dunkelflaute" (low wind/sun days). VRFBs are ideal for:
• Soaking up excess wind energy during storms
• Discharging over calm periods (days-long storage)
• Providing grid stability for our islanded system
• Supporting offshore wind integration
• Community energy projects with long-term reliability',
            'cost_per_kwh' => 300.00,
            'lifespan_years' => 25,
            'efficiency_percent' => 70.00,
            'is_featured' => true,
        ]);

        Technology::create([
            'name' => 'Lithium-ion Battery',
            'slug' => 'lithium-ion-battery',
            'category' => 'storage',
            'description' => 'High-power, short-duration storage currently dominating the market. Excellent for frequency regulation and rapid response but limited for long-duration needs.',
            'technical_specs' => [
                'energy_density' => '150-250 Wh/kg',
                'power_rating' => '1-100 MW',
                'duration' => '1-4 hours typically',
                'response_time' => 'Milliseconds',
            ],
            'advantages' => '• High energy density (compact)
• High round-trip efficiency (85-95%)
• Falling costs
• Proven technology at scale
• Excellent for frequency regulation',
            'disadvantages' => '• 10-15 year lifespan with degradation
• Fire safety management needed
• Limited to ~4 hours economically
• Supply chain concerns (lithium, cobalt)
• Calendar aging even when not used',
            'irish_applications' => 'Ideal for Ireland\'s immediate grid needs:
• Frequency regulation (grid stability)
• Peak shaving (reduce demand charges)
• 2-4 hour storage for daily cycling
• Integration with solar projects
• Fast response to grid events',
            'cost_per_kwh' => 150.00,
            'lifespan_years' => 12,
            'efficiency_percent' => 90.00,
            'is_featured' => true,
        ]);
    }

    private function seedEnvironmentalMetrics(): void
    {
        EnvironmentalMetric::create([
            'title' => 'Ireland\'s Total CO2 Emissions',
            'metric_type' => 'co2_total',
            'value' => 57900000,
            'unit' => 'tonnes_co2',
            'reference_year' => 2023,
            'data_source' => 'EPA Ireland',
            'description' => 'Total greenhouse gas emissions in Ireland for 2023.',
            'region' => 'Ireland',
            'is_featured' => true,
        ]);
    }

    private function seedImpactComparisons(): void
    {
        ImpactComparison::create([
            'title' => 'Whitegate Power Station Annual Emissions',
            'subject_type' => 'power_station',
            'subject_name' => 'Whitegate Combined Cycle Gas Turbine',
            'co2_tonnes' => 820000,
            'equivalent_cars' => 178000,
            'equivalent_trees_needed' => 41000000,
            'equivalent_area_flooded' => 240,
            'visual_metaphor' => 'Whitegate emits enough CO2 annually to require 41 million trees to absorb it. Equivalent to 178,000 cars driving for a year.',
            'data_sources' => ['EPA Emissions Report 2023'],
            'year' => 2023,
            'is_featured' => true,
        ]);
    }

    private function seedSeaLevelProjections(): void
    {
        SeaLevelProjection::create([
            'region' => 'Dublin Bay',
            'year_2030' => 8,
            'year_2050' => 25,
            'year_2100' => 65,
            'affected_area_km2' => 45,
            'population_at_risk' => 28000,
            'economic_value_at_risk' => 4500000000,
            'description' => 'Dublin Bay faces significant flooding risk. Key areas: Ringsend, Sandymount, Clontarf.',
        ]);
    }

    private function seedPolicies(): void
    {
        Policy::create([
            'title' => 'Climate Action Plan 2024',
            'slug' => 'climate-action-plan-2024',
            'policy_type' => 'strategy',
            'status' => 'active',
            'description' => 'Ireland\'s roadmap to 51% emissions reduction by 2030 and net-zero by 2050.',
            'introduced_date' => '2024-01-15',
            'target_completion_date' => '2030-12-31',
            'eu_mandate' => true,
            'key_metrics' => [
                '51% emissions reduction by 2030',
                '80% renewable electricity by 2030',
            ],
        ]);
    }

    private function seedCaseStudies(): void
    {
        CaseStudy::create([
            'title' => 'Codling Wind Park: Ireland\'s Largest Offshore Project',
            'slug' => 'codling-wind-park',
            'category' => 'energy_security',
            'location' => 'Irish Sea, off Wicklow-Dublin coast',
            'summary' => 'Europe\'s largest offshore wind farm will power 1.8 million Irish homes.',
            'full_content' => '<p>Codling Wind Park is a 1.5 GW offshore wind farm. Powers 1.8 million homes and creates 2,500 jobs.</p>',
            'jobs_created' => 2500,
            'investment_amount' => 3200000000,
            'co2_reduced' => 2400000,
            'energy_generated_mwh' => 6000000,
            'published_at' => now(),
            'is_featured' => true,
        ]);
    }

    private function seedAdvocacyCampaigns(): void
    {
        AdvocacyCampaign::create([
            'title' => 'Stop New Gas Infrastructure',
            'slug' => 'stop-new-gas',
            'goal' => 'Halt public funding for new gas power stations.',
            'description' => 'Ireland is planning new gas infrastructure that will lock us into fossil fuels until 2050.',
            'status' => 'active',
            'petition_count' => 12450,
            'target_signatures' => 25000,
            'call_to_action' => 'Sign the petition to redirect gas spending to renewable storage.',
            'start_date' => now()->subMonths(3),
            'is_featured' => true,
        ]);
    }

    private function seedEvents(): void
    {
        Event::create([
            'title' => 'Irish Grid Storage Challenge 2026',
            'slug' => 'grid-storage-challenge-2026',
            'event_type' => 'competition',
            'description' => 'Annual scientific competition for Irish universities to present innovative solutions for grid-scale energy storage.',
            'start_date' => now()->addMonths(3),
            'end_date' => now()->addMonths(5),
            'location' => 'Trinity College Dublin & Virtual',
            'max_participants' => 50,
            'status' => 'upcoming',
            'featured_speakers' => [
                'Dr. Michael O\'Sullivan - Trinity College Dublin',
            ],
            'is_featured' => true,
        ]);
    }
}
