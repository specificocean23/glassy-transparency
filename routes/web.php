<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Auth\EnjoydeiseOAuthController;
use App\Http\Controllers\DataImportController;

Route::get('/', [PublicController::class, 'home']);

Route::get('/technologies', [PublicController::class, 'technologies']);
Route::get('/events', [PublicController::class, 'events']);
Route::get('/case-studies', [PublicController::class, 'caseStudies']);
Route::get('/campaigns', [PublicController::class, 'campaigns']);
Route::get('/transparency', [PublicController::class, 'metrics'])->name('transparency');
Route::get('/environment', [PublicController::class, 'environment'])->name('environment');
Route::get('/waterford', [PublicController::class, 'waterfordSpending']);
Route::get('/waterford-spending', [PublicController::class, 'waterfordSpending']);

// New transparency pages
Route::get('/timeline', [PublicController::class, 'timelineAll'])->name('timeline');
Route::get('/spending/explorer', [PublicController::class, 'spendingExplorer'])->name('spending.explorer');

// Admin import routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/import', [DataImportController::class, 'index'])->name('import');
    Route::post('/import/upload', [DataImportController::class, 'importBudgets'])->name('import.upload');
    Route::get('/import/template/{type}', [DataImportController::class, 'downloadTemplate'])->name('import.template');
});

Route::get('/dashboard', function () {
    return redirect('/transparency');
});

// Enjoydeise OAuth Routes
Route::prefix('auth/enjoydeise')->name('auth.enjoydeise.')->group(function () {
    Route::get('redirect', [EnjoydeiseOAuthController::class, 'redirectToProvider'])->name('redirect');
    Route::get('callback', [EnjoydeiseOAuthController::class, 'handleProviderCallback'])->name('callback');
    Route::post('logout', [EnjoydeiseOAuthController::class, 'logout'])->name('logout');
});
