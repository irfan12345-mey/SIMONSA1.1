<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" id="photo" class="hidden"
                            wire:model.live="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <!-- PERBAIKAN: Gunakan auth()->user() -->
                    <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->nama }}" class="rounded-full h-20 w-20 object-cover border-2 border-gray-200">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center border-2 border-blue-500"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <div class="flex items-center mt-3 gap-2">
                    <x-secondary-button type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Pilih Foto Baru') }}
                    </x-secondary-button>

                    <!-- PERBAIKAN: Gunakan auth()->user() -->
                    @if (auth()->user()->profile_photo_path)
                        <x-danger-button type="button" wire:click="deleteProfilePhoto">
                            {{ __('Hapus Foto') }}
                        </x-danger-button>
                    @endif
                </div>

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Nama -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="nama" value="{{ __('Nama') }}" />
            <x-input id="nama" type="text" class="mt-1 block w-full" wire:model.live="state.nama" required autocomplete="name" />
            <x-input-error for="nama" class="mt-2" />
        </div>

        <!-- Username -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="username" value="{{ __('Username') }}" />
            <x-input id="username" type="text" class="mt-1 block w-full" wire:model.live="state.username" required autocomplete="username" />
            <x-input-error for="username" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Tersimpan.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Simpan') }}
        </x-button>
    </x-slot>
</x-form-section>