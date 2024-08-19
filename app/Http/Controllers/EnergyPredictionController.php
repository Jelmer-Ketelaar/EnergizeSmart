<?php

namespace App\Http\Controllers;

use App\Models\EnergyPrediction;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class EnergyPredictionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Factory|Application
    {
        $predictions = EnergyPrediction::all();
        return view('energy_predictions.index', compact('predictions'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('energy_predictions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'predicted_value' => 'required|numeric',
        ]);

        $prediction = EnergyPrediction::create([
            'user_id' => $validatedData['user_id'],
            'prediction_date' => now(),
            'predicted_value' => $validatedData['predicted_value'],
        ]);

        return redirect()->route('energy_predictions.index')->with('success', 'Prediction created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(EnergyPrediction $energyPrediction)
    {
        // Get the actual energy usage for the date of the prediction
        $actualUsages = $energyPrediction->usages;

        // Calculate the actual value by summing the energy usage for the predicted date
        $actualValue = $actualUsages->sum('energy_consumed');

        return view('energy_predictions.show', compact('energyPrediction', 'actualUsages', 'actualValue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EnergyPrediction $energyPrediction)
    {
        return view('energy_predictions.edit', compact('energyPrediction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EnergyPrediction $energyPrediction)
    {
        $validatedData = $request->validate([
            'predicted_value' => 'required|numeric',
        ]);

        $energyPrediction->update([
            'predicted_value' => $validatedData['predicted_value'],
        ]);

        return redirect()->route('energy_predictions.index')->with('success', 'Prediction updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EnergyPrediction $energyPrediction)
    {
        $energyPrediction->delete();

        return redirect()->route('energy_predictions.index')->with('success', 'Prediction deleted successfully!');
    }

    public function updatePredictionWithActualValue(EnergyPrediction $energyPrediction)
    {
        // Calculate the actual value using the model method
        $actualValue = $energyPrediction->calculateActualValue();

        // Update the prediction with the calculated actual value
        $energyPrediction->update(['actual_value' => $actualValue]);

        // Redirect back to the show page with a success message
        return redirect()->route('energy_predictions.show', $energyPrediction->id)
            ->with('success', 'Prediction updated with actual value!');
    }
}
