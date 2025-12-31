<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    /**
     * Get dashboard summary statistics with demo data
     */
    public function stats(): JsonResponse
    {
        return response()->json([
            'total_budget' => 9700000,
            'total_spent' => 4500000,
            'green_energy_percentage' => 45.2,
            'homelessness_count' => 127,
            'departments_count' => 5,
            'initiatives_count' => 5,
            'irish_workers_employed' => 194,
        ]);
    }

    /**
     * Get monthly spending trends
     */
    public function monthlySpending(): JsonResponse
    {
        return response()->json([
            'data' => [
                ['month' => 'January', 'amount' => 380000],
                ['month' => 'February', 'amount' => 420000],
                ['month' => 'March', 'amount' => 395000],
                ['month' => 'April', 'amount' => 450000],
                ['month' => 'May', 'amount' => 380000],
                ['month' => 'June', 'amount' => 420000],
                ['month' => 'July', 'amount' => 410000],
                ['month' => 'August', 'amount' => 390000],
                ['month' => 'September', 'amount' => 430000],
                ['month' => 'October', 'amount' => 405000],
                ['month' => 'November', 'amount' => 440000],
                ['month' => 'December', 'amount' => 370000],
            ]
        ]);
    }

    /**
     * Get spending by category
     */
    public function spendingByCategory(): JsonResponse
    {
        return response()->json([
            'data' => [
                ['category' => 'Housing & Homelessness', 'amount' => 1250000],
                ['category' => 'Green Energy', 'amount' => 1100000],
                ['category' => 'Transportation', 'amount' => 890000],
                ['category' => 'Parks & Recreation', 'amount' => 650000],
                ['category' => 'Community Services', 'amount' => 610000],
            ]
        ]);
    }

    /**
     * Get spending by department
     */
    public function spendingByDepartment(): JsonResponse
    {
        return response()->json([
            'data' => [
                ['name' => 'Housing & Homelessness Services', 'spending' => 1250000],
                ['name' => 'Environment & Green Energy', 'spending' => 1100000],
                ['name' => 'Transportation & Mobility', 'spending' => 890000],
                ['name' => 'Parks & Recreation', 'spending' => 650000],
                ['name' => 'Community & Economic Development', 'spending' => 610000],
            ]
        ]);
    }

    /**
     * Get green energy impact
     */
    public function greenEnergyImpact(): JsonResponse
    {
        return response()->json([
            'green_spending' => 1100000,
            'fossil_spending' => 890000,
            'green_percentage' => 45.2,
            'carbon_reduction_tons' => 450,
            'solar_panels_installed' => 520,
            'renewable_energy_mwh' => 2850,
        ]);
    }

    /**
     * Get homelessness support impact
     */
    public function homelessnessImpact(): JsonResponse
    {
        return response()->json([
            'allocated' => 1250000,
            'spent' => 890000,
            'people_housed' => 127,
            'support_programs' => 5,
            'workers_employed' => 76,
            'effectiveness_percentage' => 71.2,
        ]);
    }
}
