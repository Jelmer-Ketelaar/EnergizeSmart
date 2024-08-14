<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnergyDataController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('daily/{userId}', [EnergyDataController::class, 'showDaily'])->name('energy.daily');
Route::get('/compare-weeks/{userId}', [EnergyDataController::class, 'compareWeeks'])->name('energy.weekly');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
