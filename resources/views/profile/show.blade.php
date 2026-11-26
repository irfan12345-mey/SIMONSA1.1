<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-section-border />
            @endif

            {{-- ======================================================= --}}
            {{-- TAMBAHAN BARU: BAGIAN PENGATURAN TEMA TAMPILAN         --}}
            {{-- ======================================================= --}}
            <div class="mt-10 sm:mt-0">
                <x-form-section submit="dummy">
                    <x-slot name="title">
                        {{ __('Tema Tampilan') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('Ubah mode warna aplikasi sesuai preferensi Anda.') }}
                    </x-slot>

                    <x-slot name="form">
                        {{-- Memanggil komponen tema yang akan kita buat --}}
                        <x-theme-settings />
                    </x-slot>

                    <x-slot name="actions">
                        {{-- Slot ini sengaja dikosongkan karena tema langsung berubah tanpa perlu tombol Save --}}
                    </x-slot>
                </x-form-section>
            </div>
            {{-- ======================================================= --}}
            {{-- AKHIR DARI BAGIAN PENGATURAN TEMA                       --}}
            {{-- ======================================================= --}}

            <x-section-border />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>