<div>
    <form wire:submit="store" wire:recaptcha class="grid grid-cols-2 gap-4">
        <!-- Name -->
        <div class="col-span-2 sm:col-span-1">
            <x-breeze.input-label for="name" :value="__('Name')" />
            <x-breeze.text-input
                wire:model="ticket.name"
                id="name"
                class="block mt-1 w-full"
                type="text"
                name="name"
                required
                autofocus
            />
            <x-breeze.input-error :messages="$errors->get('ticket.email')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-2 sm:col-span-1">
            <x-breeze.input-label for="email" :value="__('Email')" />
            <x-breeze.text-input
                wire:model="ticket.email"
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                required
            />
            <x-breeze.input-error :messages="$errors->get('ticket.email')" class="mt-2" />
        </div>

        <!-- Subject -->
        <div class="col-span-2">
            <x-breeze.input-label for="subject" :value="__('Subject')" />
            <x-breeze.text-input
                wire:model="ticket.subject"
                id="subject"
                class="block mt-1 w-full"
                type="text"
                name="subject"
                required
            />
            <x-breeze.input-error :messages="$errors->get('ticket.subject')" class="mt-2" />
        </div>

        <!-- Description -->
        <div class="col-span-2">
            <x-breeze.input-label for="description" :value="__('Description')" />
            <textarea
                wire:model="ticket.description"
                id="description"
                name="description"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm"
                style="resize: none;"
                rows="10"
                required
            ></textarea>
            <x-breeze.input-error :messages="$errors->get('ticket.description')" class="mt-2" />
        </div>

        <!-- Priority -->
        <div class="col-span-2 sm:col-span-1">
            <x-breeze.input-label for="priority" :value="__('Priority')" />
            <select
                wire:model="ticket.priority"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md
                    shadow-sm"
            >
                <option disabled value="">Select</option>
                <option value="low">Low</option>
                <option value="normal">Normal</option>
                <option value="high">High</option>
                <option value="urgent">Urgent</option>
            </select>
            <x-breeze.input-error :messages="$errors->get('ticket.priority')" class="mt-2" />
        </div>

        <!-- Category -->
        <div class="col-span-2 sm:col-span-1">
            <x-breeze.input-label for="category" :value="__('Category')" />
            <select
                wire:model="ticket.category"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md
                shadow-sm"
            >
                <option disabled value="">Select</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <x-breeze.input-error :messages="$errors->get('ticket.category')" class="mt-2" />
        </div>

        <!-- Attachments -->
        <div class="col-span-2 sm:col-span-1">
            <x-breeze.input-label for="attachments" :value="__('Attachments')" />
            <input
                wire:model="ticket.attachments"
                class="block mt-1 w-full border-gray-300 border rounded-md cursor-pointer focus:outline-none -mb-2 px-2 py-2 h-11"
                id="multiple_files"
                type="file"
                multiple
            >
            <div wire:loading wire:target="ticket.attachments">Uploading...</div>
            <x-breeze.input-error :messages="$errors->get('ticket.attachments')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4 col-span-2">

            <x-breeze.primary-button class="ms-3">
                {{ __('Create Ticker') }}
            </x-breeze.primary-button>
            <x-breeze.secondary-button class="ms-3">
                {{ __('Reset') }}
            </x-breeze.secondary-button>
        </div>
    </form>
    @livewireRecaptcha
</div>


