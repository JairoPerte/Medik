<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Información del Perfil') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Actualizar Datos que se muestran en tus informes médico.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @user
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                    <!-- Profile Photo File Input -->
                    <input type="file" id="photo" class="hidden" wire:model.live="photo" x-ref="photo"
                        x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                    <x-label for="photo" value="{{ __('Foto') }}" />

                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="! photoPreview">
                        <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                            class="rounded-full size-20 object-cover">
                    </div>

                    <!-- New Profile Photo Preview -->
                    <div class="mt-2" x-show="photoPreview" style="display: none;">
                        <span class="block rounded-full size-20 bg-cover bg-no-repeat bg-center"
                            x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>

                    <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Seleccionar una Nueva Foto') }}
                    </x-secondary-button>

                    @if ($this->user->profile_photo_path)
                        <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                            {{ __('Quitar Foto') }}
                        </x-secondary-button>
                    @endif

                    <x-input-error for="photo" class="mt-2" />
                </div>
            @endif
        @enduser

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Nombre') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" required
                autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- NIF -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="nif" value="{{ __('NIF') }}" />
            <x-input id="nif" type="text" class="mt-1 block w-full" wire:model="state.nif" required
                autocomplete="nif" />
            <x-input-error for="nif" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required
                autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @user
                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                        !$this->user->hasVerifiedEmail())
                    <p class="text-sm mt-2 dark:text-white">
                        {{ __('Tu email no está verificado.') }}

                        <button type="button"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                            wire:click.prevent="sendEmailVerification">
                            {{ __('Clicka aquí para enviar un código de verificación.') }}
                        </button>
                    </p>

                    @if ($this->verificationLinkSent)
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('Un nuevo código de verificación se ha mandado al correo.') }}
                        </p>
                    @endif
                @endif
            @enduser
        </div>

        @user
            <!-- Edad -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="edad" value="{{ __('Edad') }}" />
                <x-input id="edad" type="text" class="mt-1 block w-full" wire:model="state.edad"
                    autocomplete="edad" />
                <x-input-error for="edad" class="mt-2" />
            </div>
            <!-- Peso -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="peso" value="{{ __('Peso') }}" />
                <x-input id="peso" type="text" class="mt-1 block w-full" wire:model="state.peso"
                    autocomplete="peso" />
                <x-input-error for="peso" class="mt-2" />
            </div>
            <!-- Altura -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="altura" value="{{ __('Altura') }}" />
                <x-input id="altura" type="text" class="mt-1 block w-full" wire:model="state.altura"
                    autocomplete="altura" />
                <x-input-error for="altura" class="mt-2" />
            </div>
            <!-- Numtel -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="numtel" value="{{ __('Número de Telefono') }}" />
                <x-input id="numtel" type="text" class="mt-1 block w-full" wire:model="state.numtel" required
                    autocomplete="numtel" />
                <x-input-error for="numtel" class="mt-2" />
            </div>
        @enduser
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Actualizado.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Actualizar') }}
        </x-button>
    </x-slot>
</x-form-section>
