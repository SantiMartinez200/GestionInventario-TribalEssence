<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-dark light:text-dark">
            {{ __('Borrar cuenta') }}
        </h2>

        <p class="mt-1 text-sm text-dark light:text-dark">
            {{ __('Una vez que borres tu cuenta perderás todos tus datos.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Borrar cuenta') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-dark dark:text-dark">
                {{ __('¿Estás seguro de BORRAR TU CUENTA?') }}
            </h2>

            <p class="mt-1 text-sm text-dark dark:text-dark">
                {{ __('Una vez que borres tu cuenta perderás todos tus datos.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 text-light"
                    placeholder="{{ __('Confirmá con tu contraseña') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Borrar cuenta') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
