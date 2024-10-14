<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <!-- Header -->
    <div class="sm:flex sm:justify-between sm:items-center mb-8">
        <!-- Title -->
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                Teams
            </h1>
        </div>
        <!-- Actions -->
        <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-4">
            <!-- Search -->
            <x-search search="search" />
            <!-- Add New Button -->
            <x-create-button label="Add new Team" event="'show-create-modal'" />
        </div>
    </div>

    <div class="grid grid-cols-23 gap-6">
        <x-table.table :items="$teams">
            <x-table.table-head>
                <x-table.datatable-column column="id" />
                <x-table.datatable-column column="name" />
                <x-table.datatable-column column="description" />
                <x-table.datatable-column column="agents" />
                <th scope="col" class="px-4 py-3">Actions</th>
            </x-table.table-head>
            <x-table.table-body :items="$teams" columns="4">
                @foreach($teams as $key => $team)
                    <tr wire:key="{{ $key . '-' . $page }}" class="border-b">
                        <x-table.table-row :item="$team->id" type="data" />
                        <x-table.table-row :item="$team->name" type="data" class="capitalize" />
                        <x-table.table-row :item="$team->description" type="data" />
                        <x-table.table-row
                            :item="$team->agents->count()"
                            type="data"
                            link="{{ route('teams.agents', $team->id) }}"
                        />
                        <x-table.table-row
                            :item="$team->id"
                            type="action"
                            edit="'show-edit-modal'"
                            delete="'show-delete-modal'"
                        />
                    </tr>
                @endforeach
            </x-table.table-body>
        </x-table.table>
    </div>
    <livewire:pages.dashboard.teams.create-modal />
    <livewire:pages.dashboard.teams.edit-modal />
    <livewire:pages.dashboard.teams.delete-modal />
</div>
