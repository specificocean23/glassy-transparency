<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\Event;
use App\Models\CaseStudy;
use App\Models\AdvocacyCampaign;
use App\Models\EnvironmentalMetric;
use App\Models\SeaLevelProjection;
use App\Models\Policy;
use App\Models\ResearchPaper;
use App\Models\ImpactComparison;
use App\Models\CompetitionEntry;
use Illuminate\Support\Facades\DB;

class DashboardDataController extends Controller
{
    public function index()
    {
        return response()->json([
            'stats' => [
                'technologies' => Technology::count(),
                'events' => Event::count(),
                'case_studies' => CaseStudy::count(),
                'campaigns' => AdvocacyCampaign::count(),
                'metrics' => EnvironmentalMetric::count(),
                'projections' => SeaLevelProjection::count(),
                'policies' => Policy::count(),
                'research_papers' => ResearchPaper::count(),
                'comparisons' => ImpactComparison::count(),
                'competition_entries' => CompetitionEntry::count(),
            ],
            'recent_activity' => [
                'events' => Event::orderBy('created_at', 'desc')->take(5)->get(['id', 'title', 'event_type', 'start_datetime']),
                'case_studies' => CaseStudy::orderBy('created_at', 'desc')->take(5)->get(['id', 'title', 'category']),
                'research_papers' => ResearchPaper::orderBy('created_at', 'desc')->take(3)->get(['id', 'title', 'authors', 'publication_date']),
            ],
            'technology_stats' => [
                'by_category' => Technology::select('category', DB::raw('count(*) as count'))
                    ->groupBy('category')
                    ->get(),
                'avg_efficiency' => Technology::avg('efficiency_percent'),
                'avg_cost' => Technology::avg('cost_per_kwh'),
            ],
            'environmental_trends' => [
                'metrics_by_category' => EnvironmentalMetric::select('category', DB::raw('count(*) as count'))
                    ->groupBy('category')
                    ->get(),
                'recent_metrics' => EnvironmentalMetric::orderBy('measurement_date', 'desc')
                    ->take(10)
                    ->get(['name', 'value', 'unit', 'measurement_date']),
            ],
            'policy_overview' => [
                'by_status' => Policy::select('status', DB::raw('count(*) as count'))
                    ->groupBy('status')
                    ->get(),
                'by_type' => Policy::select('policy_type', DB::raw('count(*) as count'))
                    ->groupBy('policy_type')
                    ->get(),
            ],
        ]);
    }
}
