<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DepartmentResource;
use App\Http\Resources\SpendingResource;
use App\Http\Resources\InitiativeResource;
use App\Models\Department;
use App\Models\Spending;
use App\Models\Initiative;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TransparencyController extends Controller
{
    /**
     * List all departments with budget information
     */
    public function departments(Request $request): JsonResponse
    {
        $query = Department::with('budgets');
        
        if ($request->get('active')) {
            $query->where('is_active', true);
        }
        
        $departments = $query->paginate(15);

        return response()->json([
            'data' => DepartmentResource::collection($departments),
            'meta' => [
                'current_page' => $departments->currentPage(),
                'total' => $departments->total(),
                'per_page' => $departments->perPage(),
            ],
        ]);
    }

    /**
     * Get department details with spending and initiatives
     */
    public function departmentDetail(Request $request, $id): JsonResponse
    {
        $department = Department::with('budgets')->find($id);
        
        if (!$department) {
            return response()->json(['message' => 'Department not found'], 404);
        }

        $totalBudget = $department->budgets()->sum('allocated_amount') ?? 0;
        $totalSpent = Spending::where('department_id', $department->id)->sum('amount') ?? 0;
        $initiatives = Initiative::where('department_id', $department->id)->get();
        $spendings = Spending::where('department_id', $department->id)->latest()->limit(50)->get();

        return response()->json([
            'department' => new DepartmentResource($department),
            'financial_summary' => [
                'total_budget' => $totalBudget,
                'total_spent' => $totalSpent,
                'remaining' => $totalBudget - $totalSpent,
                'utilization_percentage' => $totalBudget > 0 ? round(($totalSpent / $totalBudget) * 100, 2) : 0,
            ],
            'initiatives' => InitiativeResource::collection($initiatives),
            'recent_spendings' => SpendingResource::collection($spendings),
        ]);
    }

    /**
     * List spending records with filtering
     */
    public function spendings(Request $request): JsonResponse
    {
        $query = Spending::query();

        if ($request->has('department_id')) {
            $query->where('department_id', $request->get('department_id'));
        }

        if ($request->has('category')) {
            $query->where('category', $request->get('category'));
        }

        if ($request->get('green_energy')) {
            $query->where('is_green_energy', true);
        }

        if ($request->get('fossil_fuel')) {
            $query->where('is_fossil_fuel_related', true);
        }

        if ($request->get('homelessness')) {
            $query->where('supports_homelessness_initiative', true);
        }

        $spendings = $query->latest('transaction_date')->paginate(25);

        return response()->json([
            'data' => SpendingResource::collection($spendings),
            'meta' => [
                'current_page' => $spendings->currentPage(),
                'total' => $spendings->total(),
                'per_page' => $spendings->perPage(),
                'total_amount' => $spendings->sum('amount'),
            ],
        ]);
    }

    /**
     * List initiatives
     */
    public function initiatives(Request $request): JsonResponse
    {
        $query = Initiative::query();

        if ($request->has('category')) {
            $query->where('category', $request->get('category'));
        }

        if ($request->get('status')) {
            $query->where('status', $request->get('status'));
        }

        $initiatives = $query->paginate(15);

        return response()->json([
            'data' => InitiativeResource::collection($initiatives),
            'meta' => [
                'current_page' => $initiatives->currentPage(),
                'total' => $initiatives->total(),
                'per_page' => $initiatives->perPage(),
            ],
        ]);
    }

    /**
     * Get initiative details with metrics
     */
    public function initiativeDetail(Request $request, $id): JsonResponse
    {
        $initiative = Initiative::find($id);

        if (!$initiative) {
            return response()->json(['message' => 'Initiative not found'], 404);
        }

        return response()->json([
            'initiative' => new InitiativeResource($initiative),
            'summary' => [
                'budget' => $initiative->budget,
                'spent' => $initiative->spent,
                'remaining' => $initiative->budget - $initiative->spent,
                'status' => $initiative->status,
            ],
        ]);
    }

    /**
     * Generate transparency report
     */
    public function report(): JsonResponse
    {
        $totalBudget = \App\Models\Budget::sum('allocated_amount') ?? 0;
        $totalSpent = Spending::sum('amount') ?? 0;
        $departments = Department::count();
        $initiatives = Initiative::count();

        return response()->json([
            'report' => [
                'period' => date('Y'),
                'total_budget' => $totalBudget,
                'total_spent' => $totalSpent,
                'utilization_percentage' => $totalBudget > 0 ? round(($totalSpent / $totalBudget) * 100, 2) : 0,
                'departments_count' => $departments,
                'initiatives_count' => $initiatives,
                'green_energy_spending' => Spending::where('is_green_energy', true)->sum('amount') ?? 0,
                'homelessness_spending' => Spending::where('supports_homelessness_initiative', true)->sum('amount') ?? 0,
            ],
        ]);
    }
}
            [
                'id' => 1,
                'name' => 'Housing & Homelessness Services',
                'slug' => 'housing-homelessness',
                'description' => 'Department dedicated to providing housing solutions and support for homeless populations',
                'budget' => 1250000,
                'spent' => 890000,
                'is_active' => true,
            ],
            [
                'id' => 2,
                'name' => 'Environment & Green Energy',
                'slug' => 'environment-green-energy',
                'description' => 'Focused on environmental protection and renewable energy initiatives',
                'budget' => 1100000,
                'spent' => 980000,
                'is_active' => true,
            ],
            [
                'id' => 3,
                'name' => 'Transportation & Mobility',
                'slug' => 'transportation-mobility',
                'description' => 'Public transportation and sustainable mobility solutions',
                'budget' => 890000,
                'spent' => 650000,
                'is_active' => true,
            ],
            [
                'id' => 4,
                'name' => 'Parks & Recreation',
                'slug' => 'parks-recreation',
                'description' => 'Community parks, recreational facilities, and outdoor spaces',
                'budget' => 650000,
                'spent' => 450000,
                'is_active' => true,
            ],
            [
                'id' => 5,
                'name' => 'Community & Economic Development',
                'slug' => 'community-economic',
                'description' => 'Economic growth, job creation, and community development programs',
                'budget' => 810000,
                'spent' => 530000,
                'is_active' => true,
            ],
        ];
    }

    private function getSpendings()
    {
        return [
            [
                'id' => 1,
                'department_id' => 1,
                'category' => 'Housing & Homelessness',
                'description' => 'Emergency shelter operations',
                'amount' => 45000,
                'transaction_date' => '2024-01-15',
                'vendor' => 'Safe Haven Services',
                'is_green_energy' => false,
                'is_fossil_fuel_related' => false,
                'supports_homelessness_initiative' => true,
            ],
            [
                'id' => 2,
                'department_id' => 2,
                'category' => 'Green Energy',
                'description' => 'Solar panel installation',
                'amount' => 120000,
                'transaction_date' => '2024-01-10',
                'vendor' => 'Renewable Energy Corp',
                'is_green_energy' => true,
                'is_fossil_fuel_related' => false,
                'supports_homelessness_initiative' => false,
            ],
            [
                'id' => 3,
                'department_id' => 3,
                'category' => 'Transportation',
                'description' => 'Bus fleet maintenance',
                'amount' => 35000,
                'transaction_date' => '2024-01-12',
                'vendor' => 'Transit Services Ltd',
                'is_green_energy' => false,
                'is_fossil_fuel_related' => true,
                'supports_homelessness_initiative' => false,
            ],
            [
                'id' => 4,
                'department_id' => 1,
                'category' => 'Housing & Homelessness',
                'description' => 'Housing program support',
                'amount' => 85000,
                'transaction_date' => '2024-01-18',
                'vendor' => 'Housing Initiatives Ireland',
                'is_green_energy' => false,
                'is_fossil_fuel_related' => false,
                'supports_homelessness_initiative' => true,
            ],
            [
                'id' => 5,
                'department_id' => 4,
                'category' => 'Parks & Recreation',
                'description' => 'Park equipment upgrade',
                'amount' => 28000,
                'transaction_date' => '2024-01-20',
                'vendor' => 'Park Development Co',
                'is_green_energy' => false,
                'is_fossil_fuel_related' => false,
                'supports_homelessness_initiative' => false,
            ],
        ];
    }

    private function getInitiatives()
    {
        return [
            [
                'id' => 1,
                'department_id' => 1,
                'title' => 'Housing First Program',
                'slug' => 'housing-first',
                'description' => 'A comprehensive initiative to provide permanent housing to homeless individuals',
                'category' => 'Housing',
                'status' => 'active',
                'budget' => 450000,
                'spent' => 320000,
                'start_date' => '2023-01-01',
                'end_date' => '2025-12-31',
                'people_impacted' => 127,
                'irish_workers_employed' => 45,
            ],
            [
                'id' => 2,
                'department_id' => 2,
                'title' => 'Green Dublin 2030',
                'slug' => 'green-dublin-2030',
                'description' => 'Initiative to make Dublin carbon-neutral by 2030',
                'category' => 'Energy',
                'status' => 'active',
                'budget' => 850000,
                'spent' => 620000,
                'start_date' => '2023-06-01',
                'end_date' => '2030-12-31',
                'renewable_energy_mwh' => 2850,
                'solar_panels_installed' => 520,
            ],
            [
                'id' => 3,
                'department_id' => 3,
                'title' => 'Sustainable Mobility Program',
                'slug' => 'sustainable-mobility',
                'description' => 'Expansion of public transportation and cycling infrastructure',
                'category' => 'Transportation',
                'status' => 'active',
                'budget' => 650000,
                'spent' => 480000,
                'start_date' => '2023-03-01',
                'end_date' => '2026-02-28',
                'people_impacted' => 250000,
                'irish_workers_employed' => 89,
            ],
            [
                'id' => 4,
                'department_id' => 4,
                'title' => 'Community Green Spaces',
                'slug' => 'community-green-spaces',
                'description' => 'Development of new parks and green spaces in underserved areas',
                'category' => 'Recreation',
                'status' => 'active',
                'budget' => 380000,
                'spent' => 185000,
                'start_date' => '2023-09-01',
                'end_date' => '2025-08-31',
                'people_impacted' => 45000,
                'irish_workers_employed' => 34,
            ],
            [
                'id' => 5,
                'department_id' => 5,
                'title' => 'Dublin Jobs Initiative',
                'slug' => 'dublin-jobs',
                'description' => 'Job creation and skills development program',
                'category' => 'Employment',
                'status' => 'active',
                'budget' => 520000,
                'spent' => 340000,
                'start_date' => '2023-05-01',
                'end_date' => '2025-04-30',
                'people_impacted' => 320,
                'irish_workers_employed' => 26,
            ],
        ];
    }

    /**
     * List all departments with budget information
     */
    public function departments(Request $request): JsonResponse
    {
        $departments = $this->getDepartments();

        if ($request->get('active')) {
            $departments = array_filter($departments, fn($d) => $d['is_active']);
        }

        $page = $request->get('page', 1);
        $perPage = 15;
        $total = count($departments);
        $lastPage = ceil($total / $perPage);
        $offset = ($page - 1) * $perPage;
        $paginated = array_slice($departments, $offset, $perPage);

        return response()->json([
            'data' => $paginated,
            'meta' => [
                'current_page' => $page,
                'total' => $total,
                'per_page' => $perPage,
                'last_page' => $lastPage,
            ],
        ]);
    }

    /**
     * Get department details with spending and initiatives
     */
    public function departmentDetail(Request $request, $id): JsonResponse
    {
        $departments = $this->getDepartments();
        $department = collect($departments)->firstWhere('id', (int)$id);

        if (!$department) {
            return response()->json(['message' => 'Department not found'], 404);
        }

        $spendings = collect($this->getSpendings())->where('department_id', $id)->all();
        $initiatives = collect($this->getInitiatives())->where('department_id', $id)->all();

        return response()->json([
            'department' => $department,
            'financial_summary' => [
                'total_budget' => $department['budget'],
                'total_spent' => $department['spent'],
                'remaining' => $department['budget'] - $department['spent'],
                'utilization_percentage' => round(($department['spent'] / $department['budget']) * 100, 2),
            ],
            'initiatives' => $initiatives,
            'recent_spendings' => array_slice($spendings, 0, 50),
        ]);
    }

    /**
     * List spending records with filtering
     */
    public function spendings(Request $request): JsonResponse
    {
        $spendings = $this->getSpendings();

        // Apply filters
        if ($request->has('department_id')) {
            $spendings = array_filter($spendings, fn($s) => $s['department_id'] == $request->get('department_id'));
        }

        if ($request->has('category')) {
            $spendings = array_filter($spendings, fn($s) => $s['category'] === $request->get('category'));
        }

        if ($request->get('green_energy')) {
            $spendings = array_filter($spendings, fn($s) => $s['is_green_energy']);
        }

        if ($request->get('fossil_fuel')) {
            $spendings = array_filter($spendings, fn($s) => $s['is_fossil_fuel_related']);
        }

        if ($request->get('homelessness')) {
            $spendings = array_filter($spendings, fn($s) => $s['supports_homelessness_initiative']);
        }

        $page = $request->get('page', 1);
        $perPage = 25;
        $total = count($spendings);
        $lastPage = ceil($total / $perPage);
        $offset = ($page - 1) * $perPage;
        $totalAmount = array_sum(array_column($spendings, 'amount'));
        $paginated = array_slice($spendings, $offset, $perPage);

        return response()->json([
            'data' => $paginated,
            'meta' => [
                'current_page' => $page,
                'total' => $total,
                'per_page' => $perPage,
                'last_page' => $lastPage,
                'total_amount' => $totalAmount,
            ],
        ]);
    }

    /**
     * List initiatives
     */
    public function initiatives(Request $request): JsonResponse
    {
        $initiatives = $this->getInitiatives();

        if ($request->has('category')) {
            $initiatives = array_filter($initiatives, fn($i) => $i['category'] === $request->get('category'));
        }

        if ($request->get('status')) {
            $initiatives = array_filter($initiatives, fn($i) => $i['status'] === $request->get('status'));
        }

        $page = $request->get('page', 1);
        $perPage = 15;
        $total = count($initiatives);
        $lastPage = ceil($total / $perPage);
        $offset = ($page - 1) * $perPage;
        $paginated = array_slice($initiatives, $offset, $perPage);

        return response()->json([
            'data' => $paginated,
            'meta' => [
                'current_page' => $page,
                'total' => $total,
                'per_page' => $perPage,
                'last_page' => $lastPage,
            ],
        ]);
    }

    /**
     * Get initiative details with metrics
     */
    public function initiativeDetail(Request $request, $id): JsonResponse
    {
        $initiatives = $this->getInitiatives();
        $initiative = collect($initiatives)->firstWhere('id', (int)$id);

        if (!$initiative) {
            return response()->json(['message' => 'Initiative not found'], 404);
        }

        return response()->json([
            'initiative' => $initiative,
            'summary' => [
                'budget' => $initiative['budget'],
                'spent' => $initiative['spent'],
                'remaining' => $initiative['budget'] - $initiative['spent'],
                'status' => $initiative['status'],
                'utilization_percentage' => round(($initiative['spent'] / $initiative['budget']) * 100, 2),
            ],
        ]);
    }

    /**
     * Generate transparency report
     */
    public function report(): JsonResponse
    {
        $departments = $this->getDepartments();
        $spendings = $this->getSpendings();
        $initiatives = $this->getInitiatives();

        $totalBudget = array_sum(array_column($departments, 'budget'));
        $totalSpent = array_sum(array_column($departments, 'spent'));
        $greenEnergySpending = array_sum(array_map(fn($s) => $s['is_green_energy'] ? $s['amount'] : 0, $spendings));
        $homelessnessSpending = array_sum(array_map(fn($s) => $s['supports_homelessness_initiative'] ? $s['amount'] : 0, $spendings));

        return response()->json([
            'report' => [
                'period' => '2024',
                'total_budget' => $totalBudget,
                'total_spent' => $totalSpent,
                'utilization_percentage' => round(($totalSpent / $totalBudget) * 100, 2),
                'departments_count' => count($departments),
                'initiatives_count' => count($initiatives),
                'green_energy_spending' => $greenEnergySpending,
                'homelessness_spending' => $homelessnessSpending,
                'people_impacted' => array_sum(array_column($initiatives, 'people_impacted')),
                'irish_workers_employed' => array_sum(array_column($initiatives, 'irish_workers_employed')),
            ],
            'departments' => $departments,
            'initiatives' => $initiatives,
        ]);
    }
}
