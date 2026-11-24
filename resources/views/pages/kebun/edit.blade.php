<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Data Kebun') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('kebun.update', $kebun->id_kebun) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Nama Kebun</label>
                        <input type="text" name="nama_kebun" class="form-input w-full" required value="{{ old('nama_kebun', $kebun->nama_kebun) }}">
                        @error('nama_kebun') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Lokasi</label>
                        <input type="text" name="lokasi" class="form-input w-full" value="{{ old('lokasi', $kebun->lokasi) }}">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Keterangan</label>
                        <textarea name="keterangan" class="form-textarea w-full">{{ old('keterangan', $kebun->keterangan) }}</textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('kebun.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">Batal</a>
                        <button type="submit" class="bg-violet-500 hover:bg-violet-600 text-white px-4 py-2 rounded">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>