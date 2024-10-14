<x-modals.modal wire:model="showCreate">
    <div class="shadow-md p-4 rounded-lg">
        <x-slot name="header">
            Create new Label
        </x-slot>
        <main>
            <form class="p-4 md:p-0" wire:submit="store">
                <div class="grid gap-4 md-4 grid-cols-2">
                    <div class="col-span-2 sm:col-span-1">
                        <x-input-label for="name" value="Name" />
                        <x-text-input
                            wire:model="state.name"
                            id="name"
                            name="name"
                            type="text"
                            class="block mt-1 w-full"
                            placeholder="Type team name"
                            required
                            autofocus
                        />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <x-input-label for="slug" value="Slug" />
                        <x-text-input
                            wire:model="state.slug"
                            id="slug"
                            name="slug"
                            type="text"
                            class="block mt-1 w-full"
                            placeholder="Type team slug"
                            required
                        />
                        <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <x-input-label for="color" value="Color" />
                        <select
                            wire:model="state.color"
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500
                                rounded-md shadow-sm"
                        >
                            <option value="">Select</option>
                            @foreach($colors as $color)
                                <option class="capitalize" value="{{ $color }}">{{ $color->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('color')" class="mt-2" />
                    </div>
                </div>
                <div class="flex items-center justify-center pt-8">
                    <x-primary-button>
                        Add new Label
                    </x-primary-button>
                </div>
            </form>
        </main>
    </div>
</x-modals.modal>
