<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\EnergyUsage;

class EnergyPredictionService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getPrediction($features)
    {
        $response = $this->client->post('http://localhost:5000/predict', [
            'json' => ['features' => $features]
        ]);

        return json_decode($response->getBody(), true)['prediction'];
    }

    public function fetchDataFromApi($apiUrl)
    {
        $response = $this->client->get($apiUrl);
        $data = json_decode($response->getBody(), true);

        foreach ($data as $entry) {
            EnergyUsage::create([
                'timestamp' => $entry['timestamp'],
                'energy_consumed' => $entry['energy_consumed'],
            ]);
        }
    }

    public function preprocessData($data)
    {
        // Example normalization process
        return $data->map(function ($item) {
            $item->normalized_value = ($item->energy_consumed - min($data->pluck('energy_consumed'))) / (max($data->pluck('energy_consumed')) - min($data->pluck('energy_consumed')));
            return $item;
        });
    }
}
