<x-authentication-layout>
    <div class="flex items-center justify-center mb-6">
        <svg class="fill-violet-500 w-10 h-10 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
            <path d="M31.956 14.8C31.372 6.92 25.08.628 17.2.044V5.76a9.04 9.04 0 0 0 9.04 9.04h5.716ZM14.8 26.24v5.716C6.92 31.372.63 25.08.044 17.2H5.76a9.04 9.04 0 0 1 9.04 9.04Zm11.44-9.04h5.716c-.584 7.88-6.876 14.172-14.756 14.756V26.24a9.04 9.04 0 0 1 9.04-9.04ZM.044 14.8C.63 6.92 6.92.628 14.8.044V5.76a9.04 9.04 0 0 1-9.04 9.04H.044Z" />
        </svg>
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Daftar Akun</h1>
    </div>
    
    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" for="nama">{{ __('Nama Lengkap') }}</label>
            <input id="nama" class="form-input w-full" type="text" name="nama" value="{{ old('nama') }}" required autofocus />
            @error('nama') <div class="text-xs mt-1 text-red-500">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" for="username">{{ __('Username') }}</label>
            <input id="username" class="form-input w-full" type="text" name="username" value="{{ old('username') }}" required />
            @error('username') <div class="text-xs mt-1 text-red-500">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" for="role">{{ __('Daftar Sebagai') }}</label>
            <select id="role" name="role" class="form-select w-full" required>
                <option value="">-- Pilih Role --</option>
                <option value="pemilik" {{ old('role') == 'pemilik' ? 'selected' : '' }}>Pemilik Kebun</option>
                <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }}>Petugas Pencatat Panen</option>
            </select>
            @error('role') <div class="text-xs mt-1 text-red-500">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" for="password">{{ __('Password') }}</label>
            <input id="password" class="form-input w-full" type="password" name="password" required />
            @error('password') <div class="text-xs mt-1 text-red-500">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" for="password_confirmation">{{ __('Konfirmasi Password') }}</label>
            <input id="password_confirmation" class="form-input w-full" type="password" name="password_confirmation" required />
        </div>

        <div class="mt-6">
            <button type="submit" class="btn bg-violet-500 hover:bg-violet-600 text-white w-full py-2 rounded">
                {{ __('Daftar Sekarang') }}
            </button>
        </div>
    </form>

    <div class="pt-5 mt-6 border-t border-gray-100 dark:border-gray-700/60 text-center">
        <div class="text-sm text-gray-500">
            Sudah punya akun? <a class="font-medium text-violet-500 hover:text-violet-600" href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </div>
</x-authentication-layout>