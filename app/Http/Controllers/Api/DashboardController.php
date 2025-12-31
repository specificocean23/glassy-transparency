<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Budget;
use App\Models\Spending;
use App\Models\Initiative;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    /**
     * Get dashboard summary statistics
     */
    public function stats(): JsonResponse
    {
        $totalBudget = Budget::sum('allocated_amount') ?? 0;
        $totalSpent = Spending::sum('amount') ?? 0;
        $departmentCount = Department::count();
        $initiativeCount = Initiative::count();
        
        $greenEnergySpent = Spending::where('is_green_energy', true)->sum('amount') ?? 0;
        $homelessnessSpent = Spending::where('supports_homelessness_initiative', true)->sum('amount') ?? 0;
        $irishWorkersEmployed = Initiative::sum('irish_workers_employed') ?? 0;

        return response()->json([
            'total_budget' => $totalBudget,
            'total_spent' => $totalSpent,
            'remaining_budget' => $totalBudget - $totalSpent,
            'budget_utilization_percentage' => $totalBudget > 0 ? round(($totalSpent / $totalBudget) * 100, 2) : 0,
            'green_energy_spending' => $greenEnergySpent,
            'homelessness_spending' => $homelessnessSpent,
            'departments_count' => $departmentCount,
            'initiatives_count' => $initiativeCount,
            'irish_workers_employed' => $irishWorkersEmployed,
            'green_energy_percentage' => $totalSpent > 0 ? round(($greenEnergySpent / $totalSpent) * 100, 2) : 0,
        ]);
    }

    /**
     * Get monthly spending trends
     */
    public function monthlySpending(): JsonResponse
    {
        $data = [];
        for ($month = 1; $month <= 12; $month++) {
            $amount = Spending::whereMonth('transaction_date', $month)
                ->sum('amount') ?? 0;
            $data[] = [
                'month' => date('F', mktime(0, 0, 0, $month, 1)),
                'amount' => $amount,
            ];
        }
        return response()->json(['data' => $data]);
    }

    /**
     * Get spending by category
     */
    public function spendingByCategory(): JsonResponse
    {
        $data = Spending::selectRaw('category, SUM(amount) as amount')
            ->groupBy('category')
            ->get();

        return response()->json(['data' => $data]);
    }

    /**
     * Get spending by department
     */
    public function spendingByDepartment(): JsonResponse
    {
        $data = Department::with('budgets', 'spendings')
            ->get()
            ->map(function ($dept) {
                return [
                    'name' => $dept->name,
                    'spending' => $dept->spendings->sum('amount') ?? 0,
                ];
            });

        return response()->json(['data' => $data]);
    }

    /**
     * Get green energy impact
     */
    public function greenEnergyImpact(): JsonResponse
    {
        $greenSpending = Spending::where('is_green_energy', true)->sum('amount') ?? 0;
        $fossilSpending = Spending::where('is_fossil_fuel_related', true)->sum('amount') ?? 0;
        $totalSpent = Spending::sum('amount') ?? 0;

        return response()->json([
            'green_spending' => $greenSpending,
            'fossil_spending' => $fossilSpending,
            'green_percentage' => $totalSpent > 0 ? round(($greenSpending / $totalSpent) * 100, 2) : 0,
            'carbon_reduction_tons' => 450, // Placeholder
            'solar_panels_installed' => 520, // Placeholder
            'renewable_energy_mwh' => 2850, // Placeholder
        ]);
    }

    /**
     * Get homelessness support impact
     */
    public function homelessnessImpact(): JsonResponse
    {
        $allocated = Spending::where('supports_homelessness_initiative', true)->sum('amount') ?? 0;
        $peopleHoused = Initiative::sum('people_impacted') ?? 0;
        $workersEmployed = Initiative::where('category', 'like', '%homelessness%')->sum('irish_workers_employed') ?? 0;

        return response()->json([
            'allocated' => $allocated,
            'spent' => $allocated * 0.7, // Placeholder calculation
            'people_housed' => $peopleHoused,
            'support_programs' => Initiative::count(),
            'workers_employed' => $workersEmployed,
            'effectiveness_percentage' => 71.2,
        ]);
    }
}
