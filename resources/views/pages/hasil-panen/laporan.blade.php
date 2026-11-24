<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan Hasil Panen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Form Filter Laporan -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 mb-6 no-print">
                <form action="{{ route('hasil-panen.laporan') }}" method="GET" class="flex flex-wrap items-end gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Bulan</label>
                        <select name="bulan" class="form-select w-full">
                            @foreach(range(1, 12) as $m)
                                <option value="{{ sprintf('%02d', $m) }}" {{ $bulan == sprintf('%02d', $m) ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Tahun</label>
                        <input type="number" name="tahun" value="{{ $tahun }}" class="form-input w-full">
                    </div>
                    <div>
                        <button type="submit" class="bg-violet-500 hover:bg-violet-600 text-white px-4 py-2 rounded">
                            Tampilkan
                        </button>
                    </div>
                    <div class="ml-auto">
                        <button type="button" onclick="window.print()" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
                            🖨️ Cetak Laporan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Area Laporan -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <div class="text-center mb-6">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200">Laporan Hasil Panen Kelapa Sawit (SIMONSA)</h3>
                    <p class="text-gray-500">Periode: {{ \Carbon\Carbon::create()->month((int)$bulan)->translatedFormat('F') }} {{ $tahun }}</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border-collapse border border-gray-300">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3 border border-gray-300">No</th>
                                <th class="px-6 py-3 border border-gray-300">Tanggal</th>
                                <th class="px-6 py-3 border border-gray-300">Kebun / Blok</th>
                                <th class="px-6 py-3 border border-gray-300">Petugas</th>
                                <th class="px-6 py-3 border border-gray-300">Berat (Kg)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($laporans as $index => $item)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 border border-gray-300">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 border border-gray-300">{{ \Carbon\Carbon::parse($item->tanggal_panen)->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 border border-gray-300">{{ $item->blok->kebun->nama_kebun ?? '-' }} / {{ $item->blok->kode_blok ?? '-' }}</td>
                                    <td class="px-6 py-4 border border-gray-300">{{ $item->petugas->nama ?? '-' }}</td>
                                    <td class="px-6 py-4 font-bold text-green-600 border border-gray-300">{{ number_format($item->berat_tbs_kg, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center border border-gray-300">Tidak ada data panen pada periode ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr class="bg-gray-100 dark:bg-gray-700 font-bold">
                                <td colspan="4" class="px-6 py-4 text-right border border-gray-300">Total Keseluruhan</td>
                                <td class="px-6 py-4 text-green-600 border border-gray-300">{{ number_format($totalBerat, 0, ',', '.') }} Kg</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS Khusus untuk Print -->
    <style>
        @media print {
            nav, header, .no-print { display: none !important; }
            body { background: white; }
            main { margin: 0; padding: 0; }
        }
    </style>
</x-app-layout>