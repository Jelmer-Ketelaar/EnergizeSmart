<x-app-layout>
    <x-slot name="header">
        <h2 class="header-title text-2xl font-semibold text-gray-800 leading-tight">
            {{ __('Comparison of Energy Usage') }}
        </h2>
    </x-slot>

    <div class="main-container bg-gray-100 py-10">
        <div class="content-container max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow-md rounded-lg p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Compare Weekly Usage</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-green-100 p-6 rounded-lg shadow">
                    <h4 class="text-lg font-medium text-green-800 mb-2">This Week</h4>
                    <p class="text-2xl font-bold text-green-800">{{ number_format($thisWeek, 2) }} kWh</p>
                </div>

                <div class="bg-blue-100 p-6 rounded-lg shadow">
                    <h4 class="text-lg font-medium text-blue-800 mb-2">Last Week</h4>
                    <p class="text-2xl font-bold text-blue-800">{{ number_format($lastWeek, 2) }} kWh</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
