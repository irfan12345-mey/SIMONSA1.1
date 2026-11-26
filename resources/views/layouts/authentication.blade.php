<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'SIMONSA') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* CSS Paksa untuk memastikan layout tidak berantakan */
            body {
                margin: 0;
                padding: 0;
                font-family: 'Inter', sans-serif;
                background-color: #05100a;
                color: #d1d5db;
                overflow: hidden; /* Mencegah scrollbar aneh */
            }
            .bg-image-wrapper {
                position: fixed;
                top: 0; left: 0; right: 0; bottom: 0;
                z-index: 0;
            }
            .bg-image-wrapper img {
                width: 100%; height: 100%; object-fit: cover; opacity: 0.5;
            }
            .bg-overlay {
                position: absolute;
                top: 0; left: 0; right: 0; bottom: 0;
                background: linear-gradient(to right, #05100a, rgba(5, 16, 10, 0.8), #05100a);
            }
            .main-container {
                position: relative;
                z-index: 10;
                display: flex;
                min-height: 100vh;
                width: 100%;
            }
            .left-panel {
                display: none; /* Sembunyikan di HP */
                flex-direction: column;
                justify-content: space-between;
                padding: 3rem;
                width: 50%;
                box-sizing: border-box;
            }
            .right-panel {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 100%;
                padding: 1rem;
                box-sizing: border-box;
            }
            .login-card {
                width: 100%;
                max-width: 400px; /* KUNCI: Membatasi lebar form agar tidak meluber */
                background-color: rgba(12, 26, 19, 0.9);
                backdrop-filter: blur(12px);
                border: 1px solid #1f3d2c;
                border-radius: 1.5rem;
                padding: 2rem;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
                box-sizing: border-box;
            }

            /* Tampilan Desktop */
            @media (min-width: 1024px) {
                .left-panel { display: flex; }
                .right-panel { width: 50%; }
            }
        </style>
    </head>
    <body>
        
        <!-- Background Image -->
        <div class="bg-image-wrapper">
            <img src="{{ asset('images/bg-sawit.jpg') }}" alt="Background" />
            <div class="bg-overlay"></div>
        </div>

        <!-- Main Layout -->
        <div class="main-container">
            
            <!-- Kiri (Logo & Teks) -->
            <div class="left-panel">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 3rem; width: auto;" />
                    <div>
                        <div style="color: white; font-weight: bold; font-size: 1.5rem; letter-spacing: 0.1em;">SIMONSA</div>
                        <div style="color: #9ca3af; font-size: 0.75rem;">Sistem Monitoring & Analisis Panen</div>
                    </div>
                </div>
                <div style="max-width: 28rem;">
                    <p style="color: white; font-size: 1.25rem; font-weight: 300; line-height: 1.625; margin-bottom: 1rem;">
                        "Produktivitas kelapa sawit adalah kunci kemajuan perkebunan berkelanjutan."
                    </p>
                    <p style="color: #d4af37; font-size: 0.875rem;">— SIMONSA Platform</p>
                </div>
            </div>

            <!-- Kanan (Form) -->
            <div class="right-panel">
                <div class="login-card">
                    {{ $slot }}
                </div>
            </div>

        </div>
    </body>
</html>