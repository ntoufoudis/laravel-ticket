<x-modals.modal wire:model="showDelete">
    <div class="shadow-md p-4 rounded-lg">
        <x-slot name="header">
            Delete Team
        </x-slot>
        <main>
            <p class="mb-4 text-center">
                Are you sure you want to delete <strong>{{ $this->team->name ?? '' }}</strong> Team?
            </p>
        </main>
        <x-slot name="footer">
            <x-secondary-button @click="$dispatch('closeModal')">
                No, Cancel
            </x-secondary-button>
            <x-danger-button class="ms-3" wire:click="delete">Yes, I'm sure</x-danger-button>
        </x-slot>
    </div>
</x-modals.modal>
