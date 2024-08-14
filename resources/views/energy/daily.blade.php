<x-app-layout>
    <x-slot name="header">
        <h2 class="header-title text-2xl font-semibold text-gray-800 leading-tight">
            {{ __('Daily Energy Usage') }}
        </h2>
    </x-slot>

    <div class="main-container bg-gray-100 py-10">
        <div class="content-container max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow-md rounded-lg p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-lg rounded-lg">
                    <thead class="bg-indigo-600 text-white">
                        <tr>
                            <th class="w-1/2 text-left py-3 px-4 uppercase font-semibold text-sm">Date</th>
                            <th class="w-1/2 text-left py-3 px-4 uppercase font-semibold text-sm">Energy Consumed (kWh)</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($data as $entry)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="py-3 px-4">{{ \Carbon\Carbon::parse($entry->timestamp)->format('M d, Y H:i') }}</td>
                                <td class="py-3 px-4">{{ number_format($entry->energy_consumed, 2) }} kWh</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Energy Consumption Over Time</h3>
                <canvas id="energyChart" class="w-full h-64"></canvas>
            </div>
        </div>
    </div>

    <!-- Include Chart.js from a CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let energyData = @json($data ?? []);

            if (energyData.length > 0) {
                const labels = energyData.map(data => new Date(data.timestamp).toLocaleString('en-US', {
                    month: 'short',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                }));

                const values = energyData.map(data => data.energy_consumed);

                const ctx = document.getElementById('energyChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Energy Consumed (kWh)',
                            data: values,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2,
                            fill: true,
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                type: 'time',
                                time: {
                                    unit: 'day'
                                },
                                title: {
                                    display: true,
                                    text: 'Date and Time'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'kWh'
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                mode: 'index',
                                intersect: false,
                            },
                            title: {
                                display: true,
                                text: 'Energy Consumption Over Time'
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                    }
                });
            } else {
                console.error("Energy data is not available.");
            }
        });
    </script>
</x-app-layout>
