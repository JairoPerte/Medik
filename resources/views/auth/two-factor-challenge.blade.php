<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div x-data="{ recovery: false }">
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400" x-show="! recovery">
                {{ __('Por favor, confirma el acceso a tu cuenta ingresando el código de autenticación proporcionado por tu aplicación de autenticación..') }}
            </div>

            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400" x-cloak x-show="recovery">
                {{ __('Por favor, confirma el acceso a tu cuenta ingresando uno de tus códigos de recuperación de emergencia.') }}
            </div>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf

                <div class="mt-4" x-show="! recovery">
                    <x-label for="code" value="{{ __('Código') }}" />
                    <x-input id="code" class="block mt-1 w-full" type="text" inputmode="numeric" name="code"
                        autofocus x-ref="code" autocomplete="one-time-code" />
                </div>

                <div class="mt-4" x-cloak x-show="recovery">
                    <x-label for="recovery_code" value="{{ __('Código de Recurperación') }}" />
                    <x-input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code"
                        x-ref="recovery_code" autocomplete="one-time-code" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="button"
                        class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 underline cursor-pointer"
                        x-show="! recovery"
                        x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
                                    ">
                        {{ __('Usar un código de recuperación') }}
                    </button>

                    <button type="button"
                        class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 underline cursor-pointer"
                        x-cloak x-show="recovery"
                        x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">
                        {{ __('Usar un código de autentificación') }}
                    </button>

                    <x-button class="ms-4">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
