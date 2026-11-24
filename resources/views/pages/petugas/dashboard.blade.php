<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Petugas Panen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <h3 class="text-sm font-medium text-gray-500">Total TBS Saya (Kg)</h3>
                    <p class="text-3xl font-bold text-green-500">{{ number_format($totalPanenSaya, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <h3 class="text-sm font-medium text-gray-500">Total Catatan Saya</h3>
                    <p class="text-3xl font-bold text-blue-500">{{ $totalCatatanSaya }}</p>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">5 Catatan Terakhir Saya</h3>
                    <a href="{{ route('hasil-panen.create') }}" class="bg-violet-500 hover:bg-violet-600 text-white px-4 py-2 rounded text-sm">
                        + Catat Panen Baru
                    </a>
                </div>
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-3">Tanggal</th>
                            <th class="px-6 py-3">Kebun / Blok</th>
                            <th class="px-6 py-3">Berat (Kg)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($catatanTerakhir as $catatan)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($catatan->tanggal_panen)->format('d M Y') }}</td>
                            <td class="px-6 py-4">{{ $catatan->blok->kebun->nama_kebun ?? '-' }} / {{ $catatan->blok->kode_blok ?? '-' }}</td>
                            <td class="px-6 py-4 font-bold text-green-600">{{ number_format($catatan->berat_tbs_kg, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center">Belum ada catatan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>