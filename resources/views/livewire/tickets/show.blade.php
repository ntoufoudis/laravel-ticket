<div>
{{--    <form wire:submit="store" wire:recaptcha class="grid grid-cols-2 gap-4">--}}
        <!-- Name -->
        <div class="col-span-2 sm:col-span-1">
            <x-breeze.input-label for="name" :value="__('Name')" />
            <x-breeze.text-input
                value="{{ $user->name }}"
                disabled
                id="name"
                class="block mt-1 w-full"
            />
        </div>

        <!-- Email -->
        <div class="col-span-2 sm:col-span-1">
            <x-breeze.input-label for="email" :value="__('Email')" />
            <x-breeze.text-input
                value="{{ $user->email }}"
                disabled
                id="email"
                class="block mt-1 w-full"
            />
        </div>

        <!-- Subject -->
        <div class="col-span-2">
            <x-breeze.input-label for="subject" :value="__('Subject')" />
            <x-breeze.text-input
                value="{{ $ticket->subject }}"
                disabled
                id="subject"
                class="block mt-1 w-full"
            />
        </div>

        <!-- Description -->
        <div class="col-span-2">
            <x-breeze.input-label for="description" :value="__('Description')" />
            <textarea
                value="{{ $ticket->message }}"
                disabled
                id="description"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm"
                style="resize: none;"
                rows="10"
            ></textarea>
        </div>

        <!-- Priority -->
        <div class="col-span-2 sm:col-span-1">
            <x-breeze.input-label for="priority" :value="__('Priority')" />
            <x-breeze.text-input
                value="{{ $ticket->priority }}"
                disabled
                id="priority"
                class="block mt-1 w-full"
            />
        </div>

        <!-- Category -->
        <div class="col-span-2 sm:col-span-1">
            <x-breeze.input-label for="category" :value="__('Category')" />
            <x-breeze.text-input
                value="{{ $ticket->category->name }}"
                disabled
                id="category"
                class="block mt-1 w-full"
            />
        </div>



{{--        <div class="flex items-center justify-end mt-4 col-span-2">--}}

{{--            <x-breeze.primary-button class="ms-3">--}}
{{--                {{ __('Create Ticker') }}--}}
{{--            </x-breeze.primary-button>--}}
{{--            <x-breeze.secondary-button class="ms-3">--}}
{{--                {{ __('Reset') }}--}}
{{--            </x-breeze.secondary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--    @livewireRecaptcha--}}
</div>


