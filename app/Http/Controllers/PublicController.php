<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\TimelineEvent;
use App\Models\SpendingItem;
use App\Models\RevenueStream;
use App\Models\CouncilAllowance;

class PublicController extends Controller
{
    public function home()
    {
        $minYear = 2010;
        $currentYear = 2026;
        $availableYears = Budget::distinct()->orderBy('year', 'desc')->pluck('year')->toArray();
        $selectedYear = (int) request()->get('year', $currentYear);
        $selectedYear = in_array($selectedYear, $availableYears) ? $selectedYear : $currentYear;
        $filter = request()->get('filter', 'all');

        // Build bar chart years: selected year + two previous (bounded by minYear)
        $barYears = array_values(array_filter($availableYears, fn ($y) => $y <= $selectedYear));
        $barYears = array_slice($barYears, 0, 3);

        // Full budget summary for all years (for chart recomputation client-side)
        $budgetSummaryAll = Budget::selectRaw('year, SUM(allocated_amount) as allocated, SUM(spent_amount) as spent, SUM(predicted_amount) as predicted')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();

        // Per-year category breakdown (allocated + spent + predicted) for client-side filters
        $allBudgetsByYear = [];
        foreach ($availableYears as $year) {
            $categoryData = Budget::where('year', $year)
                ->selectRaw('category, SUM(allocated_amount) as allocated, SUM(spent_amount) as spent, SUM(predicted_amount) as predicted')
                ->groupBy('category')
                ->orderBy('spent', 'desc')
                ->get();
            $allBudgetsByYear[$year] = $categoryData;
        }

        // Category breakdown for selected year (no filter applied yet; filters handled client-side)
        $categoryBreakdown = $allBudgetsByYear[$selectedYear] ?? collect();

        // Totals (all data, unfiltered)
        $totalSpent = Budget::sum('spent_amount');
        $totalAllocated = Budget::sum('allocated_amount');

        // Featured content
        $featuredEvents = TimelineEvent::where('is_featured', true)
            ->orWhere('is_controversial', true)
            ->orderBy('event_date', 'desc')
            ->limit(6)
            ->get();

        $questionableSpending = SpendingItem::where('is_questionable', true)
            ->orWhere('public_interest_score', '>=', 80)
            ->orderBy('amount', 'desc')
            ->limit(10)
            ->get();

        $majorRevenue = RevenueStream::orderBy('amount', 'desc')
            ->limit(5)
            ->get();

        $stats = [
            'total_spent' => $totalSpent,
            'total_allocated' => $totalAllocated,
            'timeline_events' => TimelineEvent::count(),
            'spending_items' => SpendingItem::count(),
            'questionable_items' => SpendingItem::where('is_questionable', true)->count(),
        ];

        return view('welcome-transparency', compact(
            'budgetSummaryAll',
            'featuredEvents',
            'questionableSpending',
            'majorRevenue',
            'categoryBreakdown',
            'stats',
            'availableYears',
            'allBudgetsByYear',
            'selectedYear',
            'barYears',
            'filter'
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

    public function environmentDashboard()
    {
        $availableYears = Budget::distinct()->orderBy('year', 'desc')->pluck('year')->toArray();
        if (empty($availableYears)) {
            $availableYears = [2026, 2025, 2024, 2023];
        }
        $currentYear = max($availableYears);
        $selectedYear = (int) request()->get('year', $currentYear);
        $selectedYear = in_array($selectedYear, $availableYears) ? $selectedYear : $currentYear;

        $envByYear = Budget::where('category', 'Environment')
            ->selectRaw('year, SUM(spent_amount) as spent')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();

        $fossilByYear = Budget::where('category', 'Fossil Fuel')
            ->selectRaw('year, SUM(spent_amount) as spent')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();

        $selectedEnv = Budget::where('year', $selectedYear)
            ->whereIn('category', ['Environment', 'Fossil Fuel'])
            ->selectRaw('category, SUM(spent_amount) as spent')
            ->groupBy('category')
            ->orderBy('spent', 'desc')
            ->get();

        // Fallback demo data if DB categories are missing
        if ($envByYear->isEmpty() && $fossilByYear->isEmpty()) {
            $envByYear = collect([
                (object)['year' => 2026, 'spent' => 200_000_000],
                (object)['year' => 2025, 'spent' => 180_000_000],
                (object)['year' => 2024, 'spent' => 150_000_000],
            ]);
            $fossilByYear = collect([
                (object)['year' => 2026, 'spent' => 500_000_000],
                (object)['year' => 2025, 'spent' => 550_000_000],
                (object)['year' => 2024, 'spent' => 600_000_000],
            ]);
        }

        if ($selectedEnv->isEmpty()) {
            $selectedEnv = collect([
                (object)['category' => 'Environment', 'spent' => 200_000_000],
                (object)['category' => 'Fossil Fuel', 'spent' => 500_000_000],
            ]);
        }

        return view('environment.index', compact(
            'availableYears',
            'selectedYear',
            'envByYear',
            'fossilByYear',
            'selectedEnv'
        ));
    }

    public function waterfordCouncil()
    {
        // Filter spending items by location containing Waterford
        $availableYears = SpendingItem::where('location', 'like', '%Waterford%')
            ->selectRaw('EXTRACT(YEAR FROM date) as y')
            ->distinct()
            ->orderBy('y', 'desc')
            ->pluck('y')
            ->map(fn($y) => (int)$y)
            ->toArray();

        if (empty($availableYears)) {
            $availableYears = [2026];
        }

        $currentYear = max($availableYears);
        $selectedYear = (int) request()->get('year', $currentYear);
        $selectedYear = in_array($selectedYear, $availableYears) ? $selectedYear : $currentYear;

        $items = SpendingItem::where('location', 'like', '%Waterford%')
            ->whereYear('date', $selectedYear)
            ->orderBy('date', 'desc')
            ->paginate(50);

        $categories = SpendingItem::where('location', 'like', '%Waterford%')
            ->distinct()
            ->pluck('category');

        $categoryBreakdown = SpendingItem::where('location', 'like', '%Waterford%')
            ->whereYear('date', $selectedYear)
            ->selectRaw('category, SUM(amount) as total')
            ->groupBy('category')
            ->orderBy('total', 'desc')
            ->get();

        $totalSpent = SpendingItem::where('location', 'like', '%Waterford%')
            ->whereYear('date', $selectedYear)
            ->sum('amount');

        $allowanceRecord = CouncilAllowance::forCounty('Waterford')->forYear($selectedYear)->first();
        $allowance = $allowanceRecord ? $allowanceRecord->amount : null;

        return view('waterford-council', compact(
            'availableYears',
            'selectedYear',
            'items',
            'categories',
            'categoryBreakdown',
            'totalSpent',
            'allowance'
        ));
    }
}

