<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Auth\EnjoydeiseOAuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/technologies', [PublicController::class, 'technologies']);
Route::get('/events', [PublicController::class, 'events']);
Route::get('/case-studies', [PublicController::class, 'caseStudies']);
Route::get('/campaigns', [PublicController::class, 'campaigns']);
Route::get('/metrics', [PublicController::class, 'metrics']);
Route::get('/environment', [PublicController::class, 'environment'])->name('environment');
Route::get('/transparency', [PublicController::class, 'metrics'])->name('transparency');
Route::get('/waterford', [PublicController::class, 'waterfordSpending']);

Route::get('/dashboard', function () {
    return redirect('/transparency');
});

// Enjoydeise OAuth Routes
Route::prefix('auth/enjoydeise')->name('auth.enjoydeise.')->group(function () {
    Route::get('redirect', [EnjoydeiseOAuthController::class, 'redirectToProvider'])->name('redirect');
    Route::get('callback', [EnjoydeiseOAuthController::class, 'handleProviderCallback'])->name('callback');
    Route::post('logout', [EnjoydeiseOAuthController::class, 'logout'])->name('logout');
});
