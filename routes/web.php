<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Auth\EnjoydeiseOAuthController;
use App\Http\Controllers\DataImportController;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/timeline', [PublicController::class, 'timelineAll'])->name('timeline');
Route::get('/spending/explorer', [PublicController::class, 'spendingExplorer'])->name('spending.explorer');
Route::get('/environment', [PublicController::class, 'environmentDashboard'])->name('environment');
Route::get('/waterford-council', [PublicController::class, 'waterfordCouncil'])->name('waterford');

// Admin import routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/import', [DataImportController::class, 'index'])->name('import');
    Route::post('/import/upload', [DataImportController::class, 'importBudgets'])->name('import.upload');
    Route::get('/import/template/{type}', [DataImportController::class, 'downloadTemplate'])->name('import.template');
});

// Enjoydeise OAuth Routes
Route::prefix('auth/enjoydeise')->name('auth.enjoydeise.')->group(function () {
    Route::get('redirect', [EnjoydeiseOAuthController::class, 'redirectToProvider'])->name('redirect');
    Route::get('callback', [EnjoydeiseOAuthController::class, 'handleProviderCallback'])->name('callback');
    Route::post('logout', [EnjoydeiseOAuthController::class, 'logout'])->name('logout');
});
