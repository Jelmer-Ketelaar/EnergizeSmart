<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 leading-tight">
            {{ __('Prediction Details') }}
        </h2>
    </x-slot>

    <div class="bg-gray-100 py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">{{ __('Details of Energy Prediction') }}</h3>
                <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden shadow">
                    <tbody class="text-gray-700">
                        <tr class="border-b">
                            <td class="py-3 px-4 font-semibold">{{ __('User') }}</td>
                            <td class="py-3 px-4">{{ $energyPrediction->user->name }}</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-3 px-4 font-semibold">{{ __('Prediction Date') }}</td>
                            <td class="py-3 px-4">{{ \Carbon\Carbon::parse($energyPrediction->prediction_date)->format('M d, Y') }}</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-3 px-4 font-semibold">{{ __('Predicted Value (kWh)') }}</td>
                            <td class="py-3 px-4">{{ number_format($energyPrediction->predicted_value, 2) }} kWh</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-3 px-4 font-semibold">{{ __('Actual Value (kWh)') }}</td>
                            <td class="py-3 px-4">{{ number_format($actualValue, 2) }} kWh</td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">{{ __('Energy Usages on Prediction Date') }}</h3>
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden shadow">
                        <thead class="bg-indigo-600 text-white">
                            <tr>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">{{ __('Timestamp') }}</th>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">{{ __('Energy Consumed (kWh)') }}</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach ($actualUsages as $usage)
                                <tr class="border-b hover:bg-gray-100">
                                    <td class="py-3 px-4">{{ $usage->formatted_timestamp }}</td>
                                    <td class="py-3 px-4">{{ number_format($usage->energy_consumed, 2) }} kWh</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-6 flex justify-between">
                    <a href="{{ route('energy_predictions.index') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow hover:bg-indigo-700">
                        {{ __('Back to List') }}
                    </a>
                    <a href="{{ route('energy_predictions.update_actual', $energyPrediction->id) }}" class="bg-green-600 text-white px-4 py-2 rounded-md shadow hover:bg-green-700">
                        {{ __('Update with Actual Value') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
