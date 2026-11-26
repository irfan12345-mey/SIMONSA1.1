<x-authentication-layout>
    <!-- Ikon Bulat di Atas -->
    <div style="display: flex; justify-content: center; margin-bottom: 1.5rem;">
        <div style="width: 4.5rem; height: 4.5rem; border-radius: 50%; border: 1px solid rgba(16, 185, 129, 0.4); display: flex; align-items: center; justify-content: center; background-color: rgba(17, 36, 26, 0.8); box-shadow: 0 0 20px rgba(16, 185, 129, 0.15);">
            <img src="{{ asset('images/logo.png') }}" alt="Icon" style="width: 2.5rem; height: 2.5rem; object-fit: contain;" />
        </div>
    </div>

    <!-- Judul -->
    <div style="text-align: center; margin-bottom: 2rem;">
        <h1 style="color: white; font-size: 1.5rem; font-weight: 700; margin: 0 0 0.5rem 0;">Masuk ke Sistem</h1>
        <p style="color: #9ca3af; font-size: 0.875rem; margin: 0;">Akses dashboard monitoring produktivitas panen</p>
    </div>

    @if (session('status'))
    <div style="margin-bottom: 1rem; font-size: 0.875rem; color: #34d399; text-align: center; background-color: rgba(6, 78, 59, 0.3); padding: 0.5rem; border-radius: 0.5rem;">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}" style="display: flex; flex-direction: column; gap: 1.25rem;">
        @csrf
        
        <!-- Username -->
        <div style="position: relative;">
            <div style="position: absolute; top: 0; bottom: 0; left: 0; padding-left: 1rem; display: flex; align-items: center; pointer-events: none;">
                <svg style="height: 1.25rem; width: 1.25rem; color: #6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <input id="username" style="display: block; width: 100%; padding: 0.85rem 1rem 0.85rem 2.75rem; background-color: #05100a !important; border: 1px solid #1f3d2c; border-radius: 0.75rem; color: white !important; font-size: 0.875rem; box-sizing: border-box; outline: none; transition: border 0.2s;" type="text" name="username" value="{{ old('username') }}" required autofocus autocomplete="username" placeholder="Username atau Email" />
            @error('username')
                <div style="font-size: 0.75rem; margin-top: 0.25rem; color: #f87171;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div style="position: relative;">
            <div style="position: absolute; top: 0; bottom: 0; left: 0; padding-left: 1rem; display: flex; align-items: center; pointer-events: none;">
                <svg style="height: 1.25rem; width: 1.25rem; color: #6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <input id="password" style="display: block; width: 100%; padding: 0.85rem 2.75rem 0.85rem 2.75rem; background-color: #05100a !important; border: 1px solid #1f3d2c; border-radius: 0.75rem; color: white !important; font-size: 0.875rem; box-sizing: border-box; outline: none; transition: border 0.2s;" type="password" name="password" required autocomplete="current-password" placeholder="Password" />
            
            <!-- Ikon Mata -->
            <div style="position: absolute; top: 0; bottom: 0; right: 0; padding-right: 1rem; display: flex; align-items: center; cursor: pointer; color: #6b7280;">
                <svg style="height: 1.25rem; width: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
            </div>
            @error('password')
                <div style="font-size: 0.75rem; margin-top: 0.25rem; color: #f87171;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember & Forgot -->
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <label style="display: flex; align-items: center; cursor: pointer;">
                <input type="checkbox" name="remember" style="width: 1rem; height: 1rem; accent-color: #10b981; background-color: #05100a; border: 1px solid #1f3d2c;" />
                <span style="font-size: 0.875rem; margin-left: 0.5rem; color: #d1d5db;">Ingat Saya</span>
            </label>
            
            <!-- 
            @if (Route::has('password.request'))
                <a style="font-size: 0.875rem; font-weight: 500; color: #d4af37; text-decoration: none;" href="{{ route('password.request') }}">
                    Lupa Password?
                </a>
            @endif
            -->
        </div>

        <!-- Tombol -->
        <div style="padding-top: 0.5rem;">
            <button type="submit" style="width: 100%; padding: 0.85rem 1rem; background-color: #10b981; color: #05100a; font-weight: 700; border-radius: 0.75rem; border: none; cursor: pointer; font-size: 1rem; transition: background 0.2s;">
                Masuk
            </button>
        </div>
    </form>

    <!-- Divider -->
    <div style="position: relative; display: flex; padding: 1.25rem 0; align-items: center;">
        <div style="flex-grow: 1; border-top: 1px solid #1f3d2c;"></div>
        <span style="flex-shrink: 0; margin: 0 1rem; color: #6b7280; font-size: 0.75rem; text-transform: uppercase;">Atau</span>
        <div style="flex-grow: 1; border-top: 1px solid #1f3d2c;"></div>
    </div>

    <!-- Google Button -->
    <div style="display: flex; flex-direction: column; gap: 0.75rem;">
        <button type="button" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 0.75rem; padding: 0.75rem 1rem; background-color: #05100a; border: 1px solid #1f3d2c; border-radius: 0.75rem; color: #d1d5db; font-size: 0.875rem; font-weight: 500; cursor: pointer;">
            <svg style="width: 1.25rem; height: 1.25rem;" viewBox="0 0 24 24"><path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" /><path fill="currentColor" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" /><path fill="currentColor" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" /><path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" /></svg>
            Masuk dengan Google
        </button>
    </div>

    <!-- Footer Form -->
    <div style="padding-top: 1.5rem; text-align: center;">
        <div style="font-size: 0.875rem; color: #9ca3af;">
            Belum punya akun? <a style="font-weight: 500; color: #d4af37; text-decoration: none;" href="{{ route('register') }}">Daftar di sini</a>
        </div>
    </div>

</x-authentication-layout>