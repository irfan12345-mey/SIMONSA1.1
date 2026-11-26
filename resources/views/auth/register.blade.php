<x-authentication-layout>
    <!-- Ikon Bulat di Atas -->
    <div style="display: flex; justify-content: center; margin-bottom: 1.5rem;">
        <div style="width: 4.5rem; height: 4.5rem; border-radius: 50%; border: 1px solid rgba(16, 185, 129, 0.4); display: flex; align-items: center; justify-content: center; background-color: rgba(17, 36, 26, 0.8); box-shadow: 0 0 20px rgba(16, 185, 129, 0.15);">
            <img src="{{ asset('images/logo.png') }}" alt="Icon" style="width: 2.5rem; height: 2.5rem; object-fit: contain;" />
        </div>
    </div>

    <!-- Judul -->
    <div style="text-align: center; margin-bottom: 2rem;">
        <h1 style="color: white; font-size: 1.5rem; font-weight: 700; margin: 0 0 0.5rem 0;">Daftar Akun</h1>
        <p style="color: #9ca3af; font-size: 0.875rem; margin: 0;">Lengkapi data diri Anda untuk bergabung</p>
    </div>

    <form method="POST" action="{{ route('register') }}" style="display: flex; flex-direction: column; gap: 1rem;">
        @csrf
        
        <!-- Nama Lengkap -->
        <div>
            <label style="display: block; font-size: 0.875rem; color: #d1d5db; margin-bottom: 0.4rem;">Nama Lengkap</label>
            <input id="nama" style="display: block; width: 100%; padding: 0.75rem 1rem; background-color: #05100a !important; border: 1px solid #1f3d2c; border-radius: 0.75rem; color: white !important; font-size: 0.875rem; box-sizing: border-box; outline: none; transition: border 0.2s;" type="text" name="nama" value="{{ old('nama') }}" required autofocus placeholder="Masukkan nama lengkap" onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#1f3d2c'" />
            @error('nama')
                <div style="font-size: 0.75rem; margin-top: 0.25rem; color: #f87171;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Username -->
        <div>
            <label style="display: block; font-size: 0.875rem; color: #d1d5db; margin-bottom: 0.4rem;">Username</label>
            <input id="username" style="display: block; width: 100%; padding: 0.75rem 1rem; background-color: #05100a !important; border: 1px solid #1f3d2c; border-radius: 0.75rem; color: white !important; font-size: 0.875rem; box-sizing: border-box; outline: none; transition: border 0.2s;" type="text" name="username" value="{{ old('username') }}" required placeholder="Pilih username unik" onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#1f3d2c'" />
            @error('username')
                <div style="font-size: 0.75rem; margin-top: 0.25rem; color: #f87171;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Role / Daftar Sebagai (CUSTOM DROPDOWN JS) -->
        <div>
            <label style="display: block; font-size: 0.875rem; color: #d1d5db; margin-bottom: 0.4rem;">Daftar Sebagai</label>
            
            <!-- Hidden input untuk menyimpan value yang akan dikirim ke server -->
            <input type="hidden" name="role" id="role-input" value="{{ old('role') }}" required>
            
            <!-- Tampilan Kotak Dropdown -->
            <div style="position: relative;">
                <button type="button" id="dropdown-button" onclick="toggleDropdown()" style="width: 100%; padding: 0.75rem 1rem; background-color: #05100a !important; border: 1px solid #1f3d2c; border-radius: 0.75rem; color: #9ca3af; font-size: 0.875rem; text-align: left; display: flex; justify-content: space-between; align-items: center; cursor: pointer; outline: none; transition: border 0.2s;">
                    <span id="dropdown-text">
                        @if(old('role') == 'pemilik') Pemilik Kebun
                        @elseif(old('role') == 'petugas') Petugas Panen
                        @else -- Pilih Role -- @endif
                    </span>
                    <svg style="height: 1.25rem; width: 1.25rem; transition: transform 0.2s;" id="dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>

                <!-- Menu Pilihan (Tersembunyi by default) -->
                <div id="dropdown-menu" style="display: none; position: absolute; top: 100%; left: 0; right: 0; margin-top: 0.5rem; background-color: #0c1a13; border: 1px solid #1f3d2c; border-radius: 0.75rem; box-shadow: 0 10px 25px rgba(0,0,0,0.5); z-index: 50; overflow: hidden;">
                    <ul style="list-style: none; margin: 0; padding: 0;">
                        <li onclick="selectRole('pemilik', 'Pemilik Kebun')" style="padding: 0.75rem 1rem; color: #d1d5db; font-size: 0.875rem; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#1f3d2c'" onmouseout="this.style.backgroundColor='transparent'">
                            Pemilik Kebun
                        </li>
                        <li onclick="selectRole('petugas', 'Petugas Panen')" style="padding: 0.75rem 1rem; color: #d1d5db; font-size: 0.875rem; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#1f3d2c'" onmouseout="this.style.backgroundColor='transparent'">
                            Petugas Panen
                        </li>
                    </ul>
                </div>
            </div>
            @error('role')
                <div style="font-size: 0.75rem; margin-top: 0.25rem; color: #f87171;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label style="display: block; font-size: 0.875rem; color: #d1d5db; margin-bottom: 0.4rem;">Password</label>
            <input id="password" style="display: block; width: 100%; padding: 0.75rem 1rem; background-color: #05100a !important; border: 1px solid #1f3d2c; border-radius: 0.75rem; color: white !important; font-size: 0.875rem; box-sizing: border-box; outline: none; transition: border 0.2s;" type="password" name="password" required placeholder="Minimal 8 karakter" onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#1f3d2c'" />
            @error('password')
                <div style="font-size: 0.75rem; margin-top: 0.25rem; color: #f87171;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Konfirmasi Password -->
        <div>
            <label style="display: block; font-size: 0.875rem; color: #d1d5db; margin-bottom: 0.4rem;">Konfirmasi Password</label>
            <input id="password_confirmation" style="display: block; width: 100%; padding: 0.75rem 1rem; background-color: #05100a !important; border: 1px solid #1f3d2c; border-radius: 0.75rem; color: white !important; font-size: 0.875rem; box-sizing: border-box; outline: none; transition: border 0.2s;" type="password" name="password_confirmation" required placeholder="Ketik ulang password" onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#1f3d2c'" />
        </div>

        <!-- Tombol Daftar -->
        <div style="padding-top: 0.5rem;">
            <button type="submit" style="width: 100%; padding: 0.85rem 1rem; background-color: #10b981; color: #05100a; font-weight: 700; border-radius: 0.75rem; border: none; cursor: pointer; font-size: 1rem; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#34d399'" onmouseout="this.style.backgroundColor='#10b981'">
                Daftar Sekarang
            </button>
        </div>
    </form>

    <!-- Garis Pembatas -->
    <div style="position: relative; display: flex; padding: 1.5rem 0; align-items: center;">
        <div style="flex-grow: 1; border-top: 1px solid #1f3d2c;"></div>
    </div>

    <!-- Footer Form -->
    <div style="text-align: center;">
        <div style="font-size: 0.875rem; color: #9ca3af;">
            Sudah punya akun? <a style="font-weight: 500; color: #d4af37; text-decoration: none; transition: color 0.2s;" href="{{ route('login') }}" onmouseover="this.style.color='#fbbf24'" onmouseout="this.style.color='#d4af37'">Masuk di sini</a>
        </div>
    </div>

    <!-- SCRIPT UNTUK CUSTOM DROPDOWN -->
    <script>
        function toggleDropdown() {
            const menu = document.getElementById('dropdown-menu');
            const icon = document.getElementById('dropdown-icon');
            if (menu.style.display === 'none') {
                menu.style.display = 'block';
                icon.style.transform = 'rotate(180deg)';
            } else {
                menu.style.display = 'none';
                icon.style.transform = 'rotate(0deg)';
            }
        }

        function selectRole(value, text) {
            // Set nilai ke input hidden agar bisa dikirim ke server
            document.getElementById('role-input').value = value;
            
            // Ubah teks tombol
            const dropdownText = document.getElementById('dropdown-text');
            dropdownText.innerText = text;
            dropdownText.style.color = 'white'; // Ubah warna teks jadi putih saat dipilih

            // Tutup menu
            document.getElementById('dropdown-menu').style.display = 'none';
            document.getElementById('dropdown-icon').style.transform = 'rotate(0deg)';
        }

        // Menutup dropdown jika user klik di luar area dropdown
        window.onclick = function(event) {
            if (!event.target.closest('#dropdown-button') && !event.target.closest('#dropdown-menu')) {
                document.getElementById('dropdown-menu').style.display = 'none';
                document.getElementById('dropdown-icon').style.transform = 'rotate(0deg)';
            }
        }
    </script>

</x-authentication-layout>