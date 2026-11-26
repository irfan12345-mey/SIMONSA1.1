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
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background-color: #05100a;
            color: #d1d5db;
        }

        .bg-image-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 0;
            background-color: #05100a;
            /* Warna dasar jika gambar tidak menutupi layar */
            display: flex;
            align-items: center;
            /* Posisikan gambar di tengah secara vertikal */
            justify-content: center;
        }

        /* GANTI CSS GAMBAR */
        .bg-image-wrapper img {
            width: 100%;
            height: auto;
            /* Biarkan tinggi mengikuti proporsi asli */
            min-height: 100%;
            /* Minimal setinggi layar */
            /* 'contain' membuat gambar utuh tanpa terpotong/zoom berlebihan */
            object-fit: cover;
            object-position: center center;
            opacity: 1;
        }

        /* Overlay dibuat memutar/melengkung agar bayangan lebih merata */
        .bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            /* Gradasi lebih halus agar gambar lebih kelihatan terang */
            background: linear-gradient(90deg, rgba(5, 16, 10, 0.9) 0%, rgba(5, 16, 10, 0.4) 50%, rgba(5, 16, 10, 0.6) 100%);
        }

        .main-container {
            position: relative;
            z-index: 10;
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        .left-panel {
            display: none;
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
            /* Memastikan form di tengah area kanan */
            width: 100%;
            padding: 2rem;
            /* Padding agar tidak mentok layar */
            box-sizing: border-box;
        }

        /* Card Form diubah: lebih transparan dan ukuran pas */
        .login-card {
            width: 100%;
            max-width: 420px;
            /* Background transparan gelap */
            background-color: rgba(8, 20, 14, 0.75) !important;
            backdrop-filter: blur(16px);
            border: 1px solid rgba(42, 75, 56, 0.8);
            border-radius: 1.5rem;
            padding: 2.5rem 2rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7);
            box-sizing: border-box;
        }

        @media (min-width: 1024px) {
            .left-panel {
                display: flex;
            }

            .right-panel {
                width: 50%;
                padding-right: 5rem;
                /* Memberi jarak dari kanan layar */
            }
        }
    </style>
</head>

<body>

    <div class="bg-image-wrapper">
        <!-- Pastikan gambar ini ada di public/images/ -->
        <img src="{{ asset('images/bg-sawit3.webp') }}" alt="Background" />
        <div class="bg-overlay"></div>
    </div>

    <div class="main-container">

        <!-- Kiri (Logo & Teks) -->
        <div class="left-panel">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 3.5rem; width: auto;" />
                <div>
                    <div style="color: white; font-weight: 700; font-size: 1.5rem; letter-spacing: 0.05em;">SIMONSA
                    </div>
                    <div style="color: #9ca3af; font-size: 0.75rem;">Sistem Monitoring & Analisis Panen</div>
                </div>
            </div>
            <div style="max-width: 28rem; margin-bottom: 2rem;">
                <p style="color: white; font-size: 1.25rem; font-weight: 400; line-height: 1.6; margin-bottom: 1rem;">
                    "Produktivitas kelapa sawit adalah kunci kemajuan perkebunan berkelanjutan."
                </p>
                <p style="color: #d4af37; font-size: 0.875rem;">-SIMONSA</p>
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