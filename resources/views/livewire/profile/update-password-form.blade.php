<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form wire:submit="updatePassword" class="mt-6 space-y-6">
        <div>
            <x-breeze.input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-breeze.text-input wire:model="current_password" id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-breeze.input-error :messages="$errors->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-breeze.input-label for="update_password_password" :value="__('New Password')" />
            <x-breeze.text-input wire:model="password" id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-breeze.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-breeze.input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-breeze.text-input wire:model="password_confirmation" id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-breeze.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-breeze.primary-button>{{ __('Save') }}</x-breeze.primary-button>

            <x-breeze.action-message class="me-3" on="password-updated">
                {{ __('Saved.') }}
            </x-breeze.action-message>
        </div>
    </form>
</section>
