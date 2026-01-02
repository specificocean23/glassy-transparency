<?php

namespace App\Http\Controllers\Api;

use App\Models\Technology;
use App\Models\Event;
use App\Models\CaseStudy;
use App\Models\EnvironmentalMetric;
use App\Models\SeaLevelProjection;
use App\Models\Policy;
use App\Models\ResearchPaper;
use App\Models\AdvocacyCampaign;
use App\Models\ImpactComparison;
use App\Models\CompetitionEntry;
use Illuminate\Http\JsonResponse;

class EnvironmentalDashboardController extends BaseController
{
    /**
     * Get comprehensive environmental data for the dashboard
     */
    public function getEnvironmentalStats(): JsonResponse
    {
        return $this->sendResponse([
            'technologies' => [
                'total' => Technology::count(),
                'list' => Technology::select('id', 'name', 'category', 'efficiency_percent', 'cost_per_kwh')->limit(5)->get(),
            ],
            'events' => [
                'total' => Event::count(),
                'upcoming' => Event::where('datetime', '>', now())->count(),
                'list' => Event::orderBy('datetime', 'desc')->limit(5)->get(),
            ],
            'case_studies' => [
                'total' => CaseStudy::count(),
                'list' => CaseStudy::select('id', 'title', 'category', 'location', 'jobs_created', 'co2_reduced')->limit(5)->get(),
            ],
            'environmental_metrics' => [
                'total' => EnvironmentalMetric::count(),
                'recent' => EnvironmentalMetric::orderBy('measurement_date', 'desc')->limit(5)->get(),
            ],
            'sea_level_projections' => [
                'total' => SeaLevelProjection::count(),
                'regions' => SeaLevelProjection::distinct('region')->count('region'),
                'list' => SeaLevelProjection::select('region', 'year', 'projected_rise_mm', 'confidence_level')->limit(5)->get(),
            ],
            'policies' => [
                'total' => Policy::count(),
                'active' => Policy::where('status', 'active')->count(),
                'list' => Policy::select('id', 'title', 'policy_type', 'jurisdiction', 'enactment_date')->limit(5)->get(),
            ],
            'research_papers' => [
                'total' => ResearchPaper::count(),
                'list' => ResearchPaper::select('id', 'title', 'authors', 'journal', 'publication_date')->orderBy('publication_date', 'desc')->limit(5)->get(),
            ],
            'campaigns' => [
                'total' => AdvocacyCampaign::count(),
                'active' => AdvocacyCampaign::where('end_date', '>', now())->count(),
                'list' => AdvocacyCampaign::select('id', 'name', 'organization', 'start_date', 'end_date')->limit(5)->get(),
            ],
            'competitions' => [
                'total' => CompetitionEntry::count(),
                'by_status' => CompetitionEntry::selectRaw('status, count(*) as count')->groupBy('status')->get(),
            ],
        ], 'Environmental data retrieved successfully');
    }

    /**
     * Get technology efficiency overview
     */
    public function getTechnologyOverview(): JsonResponse
    {
        $technologies = Technology::selectRaw('category, AVG(efficiency_percent) as avg_efficiency, AVG(cost_per_kwh) as avg_cost, COUNT(*) as count')
            ->groupBy('category')
            ->get();

        return $this->sendResponse($technologies, 'Technology overview retrieved');
    }

    /**
     * Get environmental impact summary
     */
    public function getImpactSummary(): JsonResponse
    {
        $caseStudies = CaseStudy::all();
        
        $totalJobsCreated = $caseStudies->sum('jobs_created') ?? 0;
        $totalInvestment = $caseStudies->sum('investment') ?? 0;
        $totalCO2Reduced = $caseStudies->sum('co2_reduced') ?? 0;

        return $this->sendResponse([
            'total_jobs_created' => $totalJobsCreated,
            'total_investment' => $totalInvestment,
            'total_co2_reduced' => $totalCO2Reduced,
            'average_jobs_per_project' => $caseStudies->count() > 0 ? round($totalJobsCreated / $caseStudies->count(), 2) : 0,
            'case_study_count' => $caseStudies->count(),
        ], 'Impact summary retrieved');
    }

    /**
     * Get climate projections for Ireland
     */
    public function getClimateProjections(): JsonResponse
    {
        $projections = SeaLevelProjection::orderBy('year')->get();

        return $this->sendResponse($projections, 'Climate projections retrieved');
    }

    /**
     * Get policy effectiveness overview
     */
    public function getPolicyOverview(): JsonResponse
    {
        $policies = Policy::selectRaw('policy_type, status, COUNT(*) as count')
            ->groupBy('policy_type', 'status')
            ->get();

        return $this->sendResponse($policies, 'Policy overview retrieved');
    }
}
