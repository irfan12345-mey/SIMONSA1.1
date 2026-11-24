<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Pemilik Kebun') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Kartu Ringkasan (P-01) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <h3 class="text-sm font-medium text-gray-500">Total Panen (Kg)</h3>
                    <p class="text-3xl font-bold text-green-500">{{ number_format($totalPanen, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <h3 class="text-sm font-medium text-gray-500">Total Catatan</h3>
                    <p class="text-3xl font-bold text-blue-500">{{ $totalCatatan }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-violet-500">
                    <h3 class="text-sm font-medium text-gray-500">Total Blok</h3>
                    <p class="text-3xl font-bold text-violet-500">{{ $totalBlok }}</p>
                </div>
            </div>

            <!-- Grafik Produktivitas (P-01 & M-04) -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Grafik Produktivitas Panen (6 Bulan Terakhir)</h3>
                
                <div class="h-80 w-full">
                    <canvas id="produktivitasChart" 
                            data-labels="{{ json_encode($labels) }}" 
                            data-panen="{{ json_encode($dataPanen) }}">
                    </canvas>
                </div>
            </div>

            <!-- Perbandingan Antar Blok (P-05) -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Perbandingan Hasil Panen Antar Blok</h3>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Peringkat</th>
                                <th class="px-6 py-3">Kebun / Blok</th>
                                <th class="px-6 py-3">Total Panen (Kg)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($perbandinganBlok as $index => $item)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 font-bold text-lg 
                                        @if($index == 0) text-yellow-500 
                                        @elseif($index == 1) text-gray-400 
                                        @elseif($index == 2) text-orange-600 
                                        @else text-gray-500 @endif">
                                        #{{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->blok->kebun->nama_kebun ?? '-' }} - Blok {{ $item->blok->kode_blok }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-green-600">
                                        {{ number_format($item->total_panen, 0, ',', '.') }} Kg
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center">Belum ada data panen untuk dibandingkan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Script Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const canvas = document.getElementById('produktivitasChart');
            if (!canvas) return;
            
            const ctx = canvas.getContext('2d');
            const labels = JSON.parse(canvas.dataset.labels || '[]');
            const dataPanen = JSON.parse(canvas.dataset.panen || '[]');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels.length > 0 ? labels : ['Belum ada data'],
                    datasets: [{
                        label: 'Total Panen (Kg)',
                        data: dataPanen.length > 0 ? dataPanen : [0],
                        borderColor: 'rgba(139, 92, 246, 1)',
                        backgroundColor: 'rgba(139, 92, 246, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true } }
                }
            });
        });
    </script>
</x-app-layout>