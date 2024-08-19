<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 leading-tight">
            {{ __('Create New Prediction') }}
        </h2>
    </x-slot>

    <div class="bg-gray-100 py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">{{ __('New Energy Prediction') }}</h3>
                <form action="{{ route('energy_predictions.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="user_id" class="block text-sm font-medium text-gray-700">{{ __('User ID') }}</label>
                        <input type="number" id="user_id" name="user_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="predicted_value" class="block text-sm font-medium text-gray-700">{{ __('Predicted Value (kWh)') }}</label>
                        <input type="number" step="0.01" id="predicted_value" name="predicted_value" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow hover:bg-indigo-700">
                            {{ __('Create Prediction') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
