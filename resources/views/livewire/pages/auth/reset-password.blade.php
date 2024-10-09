<div>
    <form wire:submit="resetPassword">
        <!-- Email Address -->
        <div>
            <x-breeze.input-label for="email" :value="__('Email')" />
            <x-breeze.text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
            <x-breeze.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-breeze.input-label for="password" :value="__('Password')" />
            <x-breeze.text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-breeze.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-breeze.input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-breeze.text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password" />

            <x-breeze.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-breeze.primary-button>
                {{ __('Reset Password') }}
            </x-breeze.primary-button>
        </div>
    </form>
</div>
