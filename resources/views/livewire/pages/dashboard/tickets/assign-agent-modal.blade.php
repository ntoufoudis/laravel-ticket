<x-modals.modal wire:model="showAssign">
    <div class="shadow-md p-4 rounded-lg">
        <x-slot name="header">
            Assign Agent
        </x-slot>
        <main>
            <form class="p-4 md:p-0" wire:submit="assign">
                <div class="col-span-2 sm:col-span-1">
                    <x-input-label for="agent" value="Agent" />
                    <select
                        wire:model="agentId"
                        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500
                            rounded-md shadow-sm"
                    >
                        <option value="">Select</option>
                        @foreach($agents as $agent)
                            <option class="capitalize" value="{{ $agent->id }}">{{ $agent->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('agentId')" class="mt-2" />
                </div>
                <div class="flex items-center justify-center pt-8">
                    <x-primary-button>
                        Assign
                    </x-primary-button>
                </div>
            </form>
        </main>
    </div>
</x-modals.modal>
