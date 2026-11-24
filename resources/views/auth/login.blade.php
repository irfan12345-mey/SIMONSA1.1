<x-authentication-layout>
    <!-- Logo dan Judul SIMONSA -->
    <div class="flex items-center justify-center mb-6">
        <svg class="fill-violet-500 w-10 h-10 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
            <path d="M31.956 14.8C31.372 6.92 25.08.628 17.2.044V5.76a9.04 9.04 0 0 0 9.04 9.04h5.716ZM14.8 26.24v5.716C6.92 31.372.63 25.08.044 17.2H5.76a9.04 9.04 0 0 1 9.04 9.04Zm11.44-9.04h5.716c-.584 7.88-6.876 14.172-14.756 14.756V26.24a9.04 9.04 0 0 1 9.04-9.04ZM.044 14.8C.63 6.92 6.92.628 14.8.044V5.76a9.04 9.04 0 0 1-9.04 9.04H.044Z" />
        </svg>
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">SIMONSA</h1>
    </div>
    <p class="text-center text-gray-500 mb-8">Sistem Informasi Monitoring dan Analisis Produktivitas Panen Kelapa Sawit</p>

    @if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
    @endif
    
    <!-- Form Login -->
    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <!-- Username -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" for="username">{{ __('Username') }}</label>
            <input id="username" class="form-input w-full" type="text" name="username" value="{{ old('username') }}" required autofocus autocomplete="username" placeholder="Masukkan username Anda" />
            @error('username')
                <div class="text-xs mt-1 text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" for="password">{{ __('Password') }}</label>
            <input id="password" class="form-input w-full" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan password Anda" />
            @error('password')
                <div class="text-xs mt-1 text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mt-6">
            <label class="flex items-center">
                <input type="checkbox" name="remember" class="form-checkbox" />
                <span class="text-sm ml-2">{{ __('Ingat Saya') }}</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="text-sm font-medium text-violet-500 hover:text-violet-600 dark:hover:text-violet-400" href="{{ route('password.request') }}">
                    {{ __('Lupa Password?') }}
                </a>
            @endif
        </div>

        <!-- Tombol Sign In -->
        <div class="mt-6">
            <button type="submit" class="btn bg-violet-500 hover:bg-violet-600 text-white whitespace-nowrap w-full py-2 rounded">
                {{ __('Masuk') }}
            </button>
        </div>
    </form>

    <!-- Catatan Keterangan Role -->
    <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
        <p class="text-xs text-gray-500 text-center">
            <strong>Informasi:</strong> Sistem akan secara otomatis mendeteksi hak akses Anda (Admin, Pemilik Kebun, atau Petugas Panen) berdasarkan akun yang digunakan.
        </p>
    </div>

    <!-- Footer -->
    <div class="pt-5 mt-6 border-t border-gray-100 dark:border-gray-700/60 text-center">
        <div class="text-sm text-gray-500">
            Belum punya akun? <a class="font-medium text-violet-500 hover:text-violet-600 dark:hover:text-violet-400" href="{{ route('register') }}">
                Daftar di sini
            </a>
        </div>
    </div>

</x-authentication-layout>