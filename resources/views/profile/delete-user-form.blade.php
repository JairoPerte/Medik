<x-action-section>
    <x-slot name="title">
        {{ __('Eliminar la cuenta') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Eliminar Permanentemente la cuenta.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
            {{ __('Una vez que tu cuenta sea eliminada, todos sus recursos y datos se eliminarán de forma permanente. Antes de eliminar tu cuenta, descarga cualquier dato o información que desees conservar.') }}
        </div>

        <div class="mt-5">
            <x-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Eliminar Cuenta') }}
            </x-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model.live="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Eliminar Cuenta') }}
            </x-slot>

            <x-slot name="content">
                {{ __('¿Estás seguro de que quieres eliminar tu cuenta? Una vez eliminada, todos sus recursos y datos se borrarán de manera permanente. Ingresa tu contraseña para confirmar que deseas eliminar tu cuenta de forma permanente.') }}

                <div class="mt-4" x-data="{}"
                    x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" class="mt-1 block w-3/4" autocomplete="current-password"
                        placeholder="{{ __('Contraseña') }}" x-ref="password" wire:model="password"
                        wire:keydown.enter="deleteUser" />

                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancekar') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Eliminar') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
