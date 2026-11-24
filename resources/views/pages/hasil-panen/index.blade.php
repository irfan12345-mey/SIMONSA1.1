<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Hasil Panen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">{{ session('success') }}</div>
            @endif

            <!-- Area Filter & Pencarian (T-04) -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-4 mb-6">
                <form action="/hasil-panen" method="GET" class="flex flex-wrap items-end gap-4">
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-sm font-medium mb-1">Cari Kebun / Blok</label>
                        <input type="text" name="search" class="form-input w-full" placeholder="Ketik nama kebun atau kode blok..." value="{{ request('search') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Dari Tanggal</label>
                        <input type="date" name="dari_tanggal" class="form-input w-full" value="{{ request('dari_tanggal') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Sampai Tanggal</label>
                        <input type="date" name="sampai_tanggal" class="form-input w-full" value="{{ request('sampai_tanggal') }}">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-violet-500 hover:bg-violet-600 text-white px-4 py-2 rounded">
                            Terapkan Filter
                        </button>
                        <a href="{{ route('hasil-panen.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Tabel Data -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Daftar Catatan Panen</h3>
                    
                    <div class="flex gap-2">
                        <a href="{{ route('hasil-panen.laporan') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
                            📄 Lihat Laporan
                        </a>
                        
                        @if(auth()->user()->role === 'petugas')
                        <a href="{{ route('hasil-panen.create') }}" class="bg-violet-500 hover:bg-violet-600 text-white px-4 py-2 rounded">
                            + Catat Hasil Panen
                        </a>
                        @endif
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Tanggal</th>
                                <th class="px-6 py-3">Kebun / Blok</th>
                                <th class="px-6 py-3">Berat TBS (Kg)</th>
                                <th class="px-6 py-3">Petugas</th>
                                <th class="px-6 py-3">Keterangan</th>
                                @if(auth()->user()->role === 'petugas')
                                <th class="px-6 py-3">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($hasilPanens as $item)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->tanggal_panen)->format('d M Y') }}</td>
                                    <td class="px-6 py-4">{{ $item->blok->kebun->nama_kebun ?? '-' }} / {{ $item->blok->kode_blok ?? '-' }}</td>
                                    <td class="px-6 py-4 font-bold text-green-600">{{ number_format($item->berat_tbs_kg, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">{{ $item->petugas->nama ?? '-' }}</td>
                                    <td class="px-6 py-4">{{ $item->keterangan ?? '-' }}</td>
                                    
                                    @if(auth()->user()->role === 'petugas')
                                    <td class="px-6 py-4 flex gap-2">
                                        <a href="{{ route('hasil-panen.edit', $item->id_hasil) }}" class="text-blue-500 hover:underline">Edit</a>
                                        <form action="{{ route('hasil-panen.destroy', $item->id_hasil) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ auth()->user()->role === 'petugas' ? 6 : 5 }}" class="px-6 py-4 text-center">Tidak ada data yang cocok dengan pencarian Anda.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>