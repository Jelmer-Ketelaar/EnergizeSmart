<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 leading-tight">
            {{ __('Energy Predictions') }}
        </h2>
    </x-slot>

    <div class="bg-gray-100 py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-gray-700">{{ __('All Predictions') }}</h3>
                    <a href="{{ route('energy_predictions.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow hover:bg-indigo-700">
                        {{ __('Create New Prediction') }}
                    </a>
                </div>
                @if ($predictions->isEmpty())
                    <p class="text-gray-500">No predictions available.</p>
                @else
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden shadow">
                        <thead class="bg-indigo-600 text-white">
                            <tr>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">{{ __('User') }}</th>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">{{ __('Prediction Date') }}</th>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">{{ __('Predicted Value (kWh)') }}</th>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach ($predictions as $prediction)
                                <tr class="border-b hover:bg-gray-100">
                                    <td class="py-3 px-4">{{ $prediction->user->name }}</td>
                                    <td class="py-3 px-4">{{ \Carbon\Carbon::parse($prediction->prediction_date)->format('M d, Y') }}</td>
                                    <td class="py-3 px-4">{{ number_format($prediction->predicted_value, 2) }} kWh</td>
                                    <td class="py-3 px-4">
                                        <a href="{{ route('energy_predictions.show', $prediction) }}" class="text-indigo-600 hover:text-indigo-900">{{ __('View') }}</a> |
                                        <a href="{{ route('energy_predictions.edit', $prediction) }}" class="text-indigo-600 hover:text-indigo-900">{{ __('Edit') }}</a> |
                                        <form action="{{ route('energy_predictions.destroy', $prediction) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
