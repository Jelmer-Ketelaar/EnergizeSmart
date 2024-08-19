<?php

use App\Http\Controllers\EnergyPredictionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnergyDataController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/daily/{userId}', [EnergyDataController::class, 'showDaily'])->name('energy.daily');
Route::get('/weekly/{userId}', [EnergyDataController::class, 'showWeekly'])->name('energy.weekly');
Route::get('/monthly/{userId}', [EnergyDataController::class, 'showMonthly'])->name('energy.monthly');
Route::get('/compare-weeks/{userId}', [EnergyDataController::class, 'compareWeeks'])->name('energy.compare');

// These routes should be protected to require authentication
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('energy_predictions', EnergyPredictionController::class);

Route::patch('energy_predictions/{energyPrediction}/update-actual', [EnergyPredictionController::class, 'updatePredictionWithActualValue'])
    ->name('energy_predictions.update_actual');


