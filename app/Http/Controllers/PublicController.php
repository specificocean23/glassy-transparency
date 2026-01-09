<?php

namespace App\Http\Controllers;

use App\Models\Technology;
use App\Models\Event;
use App\Models\CaseStudy;
use App\Models\AdvocacyCampaign;
use App\Models\EnvironmentalMetric;
use App\Models\County;
use App\Models\FinancialCategory;
use App\Models\SpendingRecord;
use App\Models\Budget;
use App\Models\TimelineEvent;
use App\Models\SpendingItem;
use App\Models\RevenueStream;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function technologies()
    {
        $technologies = Technology::all();
        return view('public.technologies', compact('technologies'));
    }

    public function events()
    {
        $events = Event::where('status', 'published')->orWhere('status', 'active')->get();
        return view('public.events', compact('events'));
    }

    public function caseStudies()
    {
        $caseStudies = CaseStudy::all();
        return view('public.case-studies', compact('caseStudies'));
    }

    public function campaigns()
    {
        $campaigns = AdvocacyCampaign::all();
        return view('public.campaigns', compact('campaigns'));
    }

    public function metrics()
    {
        $year = request()->get('year', 2026);
        $countySlug = request()->get('county', 'all-federal');
        $filter = request()->get('filter', null); // environmental, housing

        $counties = County::orderBy('sort_order')->get();
        $currentCounty = County::where('slug', $countySlug)->first() ?? $counties->first();
        
        $categories = FinancialCategory::orderBy('sort_order')->get();

        // Get spending records for current year and county
        $spendingQuery = SpendingRecord::where('year', $year)
            ->where('county_id', $currentCounty->id)
            ->with('financialCategory');

        // Apply filters
        if ($filter === 'environmental-good') {
            $categoryIds = FinancialCategory::where('is_environmental_positive', true)->pluck('id');
            $spendingQuery->whereIn('financial_category_id', $categoryIds);
        } elseif ($filter === 'environmental-bad') {
            $categoryIds = FinancialCategory::where('is_environmental_negative', true)->pluck('id');
            $spendingQuery->whereIn('financial_category_id', $categoryIds);
        } elseif ($filter === 'new-housing') {
            $categoryIds = FinancialCategory::where('is_new_housing', true)->pluck('id');
            $spendingQuery->whereIn('financial_category_id', $categoryIds);
        } elseif ($filter === 'current-housing') {
            $categoryIds = FinancialCategory::where('is_current_housing', true)->pluck('id');
            $spendingQuery->whereIn('financial_category_id', $categoryIds);
        }

        $spendingRecords = $spendingQuery->get();

        // Get case studies for current county
        $caseStudiesQuery = CaseStudy::query();
        if (!$currentCounty->is_federal) {
            $caseStudiesQuery->where('county_id', $currentCounty->id);
        }
        $caseStudies = $caseStudiesQuery->paginate(12);

        // Get available years
        $availableYears = SpendingRecord::distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('public.transparency', compact(
            'counties',
            'currentCounty',
            'categories',
            'spendingRecords',
            'caseStudies',
            'year',
            'availableYears',
            'filter'
        ));
    }

    public function environment()
    {
        return view('public.environment');
    }

    public function waterfordSpending()
    {
        // This page uses static data shown in the view
        // In the future, you can fetch from a database or API
        return view('waterford-spending');
    }

    public function home()
    {
        // Get current year and last 3 years for rolling 4-year view
        $currentYear = date('Y');
        $years = range($currentYear, $currentYear - 3);
        
        // Get budget summary for 4-year rolling period
        $budgetSummary = Budget::whereIn('year', $years)
            ->selectRaw('year, SUM(allocated_amount) as allocated, SUM(spent_amount) as spent, SUM(predicted_amount) as predicted')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();

        // Get total spending across all years
        $totalSpent = Budget::whereIn('year', $years)->sum('spent_amount');
        $totalAllocated = Budget::whereIn('year', $years)->sum('allocated_amount');

        // Get featured timeline events (controversial and high-impact)
        $featuredEvents = TimelineEvent::where('is_featured', true)
            ->orWhere('is_controversial', true)
            ->orderBy('event_date', 'desc')
            ->limit(6)
            ->get();

        // Get questionable spending items
        $questionableSpending = SpendingItem::where('is_questionable', true)
            ->orWhere('public_interest_score', '>=', 80)
            ->orderBy('amount', 'desc')
            ->limit(10)
            ->get();

        // Get major revenue streams
        $majorRevenue = RevenueStream::orderBy('amount', 'desc')
            ->limit(5)
            ->get();

        // Category breakdown for current year
        $categoryBreakdown = Budget::where('year', $currentYear)
            ->selectRaw('category, SUM(spent_amount) as total')
            ->groupBy('category')
            ->orderBy('total', 'desc')
            ->get();

        // Statistics
        $stats = [
            'total_spent' => $totalSpent,
            'total_allocated' => $totalAllocated,
            'timeline_events' => TimelineEvent::count(),
            'spending_items' => SpendingItem::count(),
            'questionable_items' => SpendingItem::where('is_questionable', true)->count(),
        ];

        return view('welcome-transparency', compact(
            'budgetSummary',
            'featuredEvents',
            'questionableSpending',
            'majorRevenue',
            'categoryBreakdown',
            'stats',
            'years'
        ));
    }

    public function timelineAll()
    {
        $events = TimelineEvent::orderBy('event_date', 'desc')->paginate(50);
        $types = TimelineEvent::distinct()->pluck('event_type');
        
        return view('timeline.index', compact('events', 'types'));
    }

    public function spendingExplorer()
    {
        $items = SpendingItem::orderBy('date', 'desc')->paginate(50);
        $categories = SpendingItem::distinct()->pluck('category');
        
        return view('spending.explorer', compact('items', 'categories'));
    }
}

