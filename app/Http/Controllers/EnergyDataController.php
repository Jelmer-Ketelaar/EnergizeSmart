<?php

namespace App\Http\Controllers;

use App\Models\EnergyUsage;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Carbon\Carbon;

class EnergyDataController extends Controller
{
    public function showDaily($userId): View|Factory|Application
    {
        $data = EnergyUsage::where('user_id', $userId)
                 ->whereDate('timestamp', Carbon::today())
                 ->get();
    
        return view('energy.daily', compact('data'));
    }    
    
    public function showWeekly($userId): View|Factory|Application
    {
        $data = EnergyUsage::where('user_id', $userId)
                    ->whereBetween('timestamp', [now()->startOfWeek(), now()->endOfWeek()])
                    ->get();
    
        return view('energy.weekly', compact('data'));
    }
    
    public function showMonthly($userId): View|Factory|Application
    {
        $data = EnergyUsage::where('user_id', $userId)
                    ->whereMonth('timestamp', now()->month)
                    ->get();
    
        return view('energy.monthly', compact('data'));
    }
    
public function compareWeeks($userId): View|Factory|Application
{
    $thisWeek = EnergyUsage::where('user_id', $userId)
              ->whereBetween('timestamp', [now()->startOfWeek(), now()->endOfWeek()])
              ->sum('energy_consumed');

    $lastWeek = EnergyUsage::where('user_id', $userId)
              ->whereBetween('timestamp', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])
              ->sum('energy_consumed');


    return view('energy.compare', compact('thisWeek', 'lastWeek'));
}

}
