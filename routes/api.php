<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\TransparencyController;
use App\Http\Controllers\Api\EnvironmentalDashboardController;

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

// Public Transparency API
Route::group(['prefix' => 'v1'], function () {
    // Dashboard endpoints
    Route::get('/dashboard/stats', [DashboardController::class, 'stats']);
    Route::get('/dashboard/monthly-spending', [DashboardController::class, 'monthlySpending']);
    Route::get('/dashboard/spending-by-category', [DashboardController::class, 'spendingByCategory']);
    Route::get('/dashboard/spending-by-department', [DashboardController::class, 'spendingByDepartment']);
    Route::get('/dashboard/green-energy', [DashboardController::class, 'greenEnergyImpact']);
    Route::get('/dashboard/homelessness', [DashboardController::class, 'homelessnessImpact']);

    // Environmental Dashboard endpoints
    Route::get('/environmental/stats', [EnvironmentalDashboardController::class, 'getEnvironmentalStats']);
    Route::get('/environmental/technologies', [EnvironmentalDashboardController::class, 'getTechnologyOverview']);
    Route::get('/environmental/impact', [EnvironmentalDashboardController::class, 'getImpactSummary']);
    Route::get('/environmental/climate-projections', [EnvironmentalDashboardController::class, 'getClimateProjections']);
    Route::get('/environmental/policies', [EnvironmentalDashboardController::class, 'getPolicyOverview']);

    // Transparency endpoints
    Route::get('/departments', [TransparencyController::class, 'departments']);
    Route::get('/departments/{department}', [TransparencyController::class, 'departmentDetail']);
    Route::get('/spendings', [TransparencyController::class, 'spendings']);
    Route::get('/initiatives', [TransparencyController::class, 'initiatives']);
    Route::get('/initiatives/{initiative}', [TransparencyController::class, 'initiativeDetail']);
    Route::get('/report', [TransparencyController::class, 'report']);
});

// Admin API (Protected)
Route::group(['prefix' => 'v1/admin', 'middleware' => ['auth:sanctum']], function () {
    // Will be implemented with admin authentication
});
