<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/technologies', [PublicController::class, 'technologies']);
Route::get('/events', [PublicController::class, 'events']);
Route::get('/case-studies', [PublicController::class, 'caseStudies']);
Route::get('/campaigns', [PublicController::class, 'campaigns']);
Route::get('/metrics', [PublicController::class, 'metrics']);

Route::get('/dashboard', function () {
    return view('dashboard');
});
