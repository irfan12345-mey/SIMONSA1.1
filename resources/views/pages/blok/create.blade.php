<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Data Blok') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('blok.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Pilih Kebun</label>
                        <select name="id_kebun" class="form-select w-full" required>
                            <option value="">-- Pilih Kebun --</option>
                            @foreach($kebuns as $kebun)
                                <option value="{{ $kebun->id_kebun }}" {{ old('id_kebun') == $kebun->id_kebun ? 'selected' : '' }}>{{ $kebun->nama_kebun }}</option>
                            @endforeach
                        </select>
                        @error('id_kebun') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Kode Blok</label>
                        <input type="text" name="kode_blok" class="form-input w-full" required value="{{ old('kode_blok') }}" placeholder="Contoh: A-01">
                        @error('kode_blok') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Nama Blok</label>
                        <input type="text" name="nama_blok" class="form-input w-full" value="{{ old('nama_blok') }}">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Luas (Hektare)</label>
                        <input type="number" step="0.01" name="luas_hektare" class="form-input w-full" value="{{ old('luas_hektare') }}">
                    </div>
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('blok.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">Batal</a>
                        <button type="submit" class="bg-violet-500 hover:bg-violet-600 text-white px-4 py-2 rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>