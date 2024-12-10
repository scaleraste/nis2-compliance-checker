<section class="space-y-6">
    <header>
        <h1 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('strings.delete_account_title') }}
        </h1>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('strings.delete_account_description') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('strings.delete_account_button') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h1 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('strings.confirm_account_deletion_title') }}
            </h1>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('strings.confirm_account_deletion_description') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" :value="__('strings.password')" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('strings.password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('strings.cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('strings.delete_account_button') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
