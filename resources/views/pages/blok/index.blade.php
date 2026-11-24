<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Blok Kebun') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Daftar Blok</h3>
                    @if(!$isAdmin)
                    <a href="{{ route('blok.create') }}" class="bg-violet-500 hover:bg-violet-600 text-white px-4 py-2 rounded">
                        + Tambah Blok
                    </a>
                    @endif
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Nama Kebun</th>
                                <th class="px-6 py-3">Kode Blok</th>
                                <th class="px-6 py-3">Nama Blok</th>
                                <th class="px-6 py-3">Luas (Ha)</th>
                                @if(!$isAdmin)
                                <th class="px-6 py-3">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bloks as $blok)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $blok->kebun->nama_kebun ?? '-' }}</td>
                                    <td class="px-6 py-4">{{ $blok->kode_blok }}</td>
                                    <td class="px-6 py-4">{{ $blok->nama_blok ?? '-' }}</td>
                                    <td class="px-6 py-4">{{ $blok->luas_hektare ?? '-' }}</td>
                                    @if(!$isAdmin)
                                    <td class="px-6 py-4 flex gap-2">
                                        <a href="{{ route('blok.edit', $blok->id_blok) }}" class="text-blue-500 hover:underline">Edit</a>
                                        <form action="{{ route('blok.destroy', $blok->id_blok) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ $isAdmin ? 4 : 5 }}" class="px-6 py-4 text-center">Belum ada data blok.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>