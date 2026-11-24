<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Catat Hasil Panen Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('hasil-panen.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Pilih Blok Kebun</label>
                        <select name="id_blok" class="form-select w-full" required>
                            <option value="">-- Pilih Blok --</option>
                            @foreach($bloks as $blok)
                                <option value="{{ $blok->id_blok }}" {{ old('id_blok') == $blok->id_blok ? 'selected' : '' }}>
                                    {{ $blok->kebun->nama_kebun ?? '-' }} - Blok {{ $blok->kode_blok }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_blok') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Tanggal Panen</label>
                        <input type="date" name="tanggal_panen" class="form-input w-full" required value="{{ old('tanggal_panen', date('Y-m-d')) }}">
                        @error('tanggal_panen') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Berat TBS (Kg)</label>
                        <input type="number" step="0.01" name="berat_tbs_kg" class="form-input w-full" required value="{{ old('berat_tbs_kg') }}" placeholder="Contoh: 1500.50">
                        @error('berat_tbs_kg') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Keterangan (Opsional)</label>
                        <textarea name="keterangan" class="form-textarea w-full">{{ old('keterangan') }}</textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('hasil-panen.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">Batal</a>
                        <button type="submit" class="bg-violet-500 hover:bg-violet-600 text-white px-4 py-2 rounded">Simpan Catatan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>