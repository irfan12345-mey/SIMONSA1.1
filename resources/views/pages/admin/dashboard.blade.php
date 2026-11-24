<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Kartu Ringkasan -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-sm font-medium text-gray-500">Total Pengguna</h3>
                    <p class="text-3xl font-bold text-violet-500">{{ $totalPengguna }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-sm font-medium text-gray-500">Total Kebun</h3>
                    <p class="text-3xl font-bold text-blue-500">{{ $totalKebun }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-sm font-medium text-gray-500">Total Blok</h3>
                    <p class="text-3xl font-bold text-green-500">{{ $totalBlok }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-sm font-medium text-gray-500">Total Panen (Kg)</h3>
                    <p class="text-3xl font-bold text-yellow-500">{{ number_format($totalPanen, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Area Konten Utama -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Statistik Catatan Panen</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">Terdapat total <strong>{{ $totalCatatan }}</strong> catatan panen yang telah dimasukkan ke dalam sistem.</p>
                
                <div class="h-64 flex items-center justify-center border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg">
                    <span class="text-gray-500">Area Grafik (Chart.js) Akan Ditaruh di Sini</span>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>