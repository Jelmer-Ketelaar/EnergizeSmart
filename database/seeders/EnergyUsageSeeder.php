<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EnergyUsage;
use Carbon\Carbon;

class EnergyUsageSeeder extends Seeder
{
    public function run(): void
    {
        EnergyUsage::create([
            'user_id' => 2,
            'timestamp' => Carbon::now()->subDays(7), // Een week geleden
            'energy_consumed' => 30.00
        ]);

        EnergyUsage::create([
            'user_id' => 2,
            'timestamp' => Carbon::now()->subDays(1), // Gisteren
            'energy_consumed' => 25.50
        ]);

        EnergyUsage::create([
            'user_id' => 2,
            'timestamp' => Carbon::now(), // Vandaag
            'energy_consumed' => 20.75
        ]);
    }
}
