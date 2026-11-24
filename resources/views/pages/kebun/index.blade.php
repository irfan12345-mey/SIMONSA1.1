<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Kebun') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Area Pencarian -->
                <div class="mb-4">
                    <form action="/kebun" method="GET" class="flex gap-2">
                        <input type="text" name="search" class="form-input w-full md:w-1/3" placeholder="Cari nama kebun atau lokasi..." value="{{ request('search') }}">
                        <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
                            Cari
                        </button>
                        <a href="/kebun" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                            Reset
                        </a>
                    </form>
                </div>

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Daftar Kebun</h3>
                    @if(!$isAdmin)
                    <a href="{{ route('kebun.create') }}" class="bg-violet-500 hover:bg-violet-600 text-white px-4 py-2 rounded">
                        + Tambah Kebun
                    </a>
                    @endif
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Nama Kebun</th>
                                <th class="px-6 py-3">Pemilik</th> <!-- Tambahan untuk Admin -->
                                <th class="px-6 py-3">Lokasi</th>
                                <th class="px-6 py-3">Keterangan</th>
                                <!-- KOLOM AKSI DISEMBUNYIKAN UNTUK ADMIN -->
                                @if(!$isAdmin)
                                <th class="px-6 py-3">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kebuns as $kebun)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $kebun->nama_kebun }}</td>
                                    <td class="px-6 py-4">{{ $kebun->pemilik->nama ?? '-' }}</td> <!-- Tampilkan Nama Pemilik -->
                                    <td class="px-6 py-4">{{ $kebun->lokasi ?? '-' }}</td>
                                    <td class="px-6 py-4">{{ $kebun->keterangan ?? '-' }}</td>
                                    
                                    @if(!$isAdmin)
                                    <td class="px-6 py-4 flex gap-2">
                                        <a href="{{ route('kebun.edit', $kebun->id_kebun) }}" class="text-blue-500 hover:underline">Edit</a>
                                        <form action="{{ route('kebun.destroy', $kebun->id_kebun) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ $isAdmin ? 4 : 5 }}" class="px-6 py-4 text-center">Belum ada data kebun.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>