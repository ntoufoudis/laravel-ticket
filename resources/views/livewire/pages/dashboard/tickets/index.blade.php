<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    <!-- Header -->
    <div class="sm:flex sm:justify-between sm:items-center mb-8">
        <!-- Title -->
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                Tickets
            </h1>
        </div>

        <!-- Actions -->
        <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-4">
            <!-- Search -->
            <x-search search="search" />

            <!-- Filters -->
            <x-filters model="status" :filters="$filters" />

            <!-- Add New Button -->
{{--            <x-create-button modal="'showCreateModal'" label="Add new Label" />--}}
        </div>
    </div>

    <div class="grid grid-cols-23 gap-6">
        <x-table.table
            :columns="$columns"
            :page="$page"
            :items="$tickets"
            :sortColumn="$sortColumn"
            :sortDirection="$sortDirection"
            edit-modal="openModal"
            delete-modal="confirmDelete"
        />
    </div>

    <x-modal wire:model="showModal" close-function="closeModals">
        <x-slot name="header">
            Assign Agent
        </x-slot>

        <x-slot name="main">
            <form class="p-4 md:p-5" wire:submit="assign">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2 sm:col-span-1 mt-2">
                        <label for="agents" class="block mb-2 text-sm font-medium text-gray-900">Agent</label>
                        <select
                            wire:model="state.assigned_to"
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md
                    shadow-sm"
                        >
                            <option value="">Select</option>
                            @foreach($agents as $agent)
                                <option class="capitalize" value="{{ $agent->id }}">{{ $agent->name }}</option>
                            @endforeach

                        </select>
                        @if ($errors->get('assigned_to'))
                            <ul class="text-sm text-red-600 space-y-1 mt-2">
                                @foreach ((array) $errors->get('assigned_to') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <button
                    type="submit"
                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4
                        focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                >
                    Assign
                </button>
            </form>
        </x-slot>
    </x-modal>
</div>
