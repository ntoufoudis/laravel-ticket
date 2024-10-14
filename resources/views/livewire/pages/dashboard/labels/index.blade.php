<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <!-- Header -->
    <div class="sm:flex sm:justify-between sm:items-center mb-8">
        <!-- Title -->
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                Labels
            </h1>
        </div>
        <!-- Actions -->
        <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-4">
            <!-- Search -->
            <x-search search="search" />
            <!-- Add New Button -->
            <x-create-button label="Add new Label" event="'show-create-modal'" />
        </div>
    </div>

    <div class="grid grid-cols-23 gap-6">
        <x-table.table :items="$labels">
            <x-table.table-head>
                <x-table.datatable-column column="id" />
                <x-table.datatable-column column="name" />
                <x-table.datatable-column column="slug" />
                <x-table.datatable-column column="tickets" />
                <x-table.datatable-column column="color" />
                <th scope="col" class="px-4 py-3">Actions</th>
            </x-table.table-head>
            <x-table.table-body :items="$labels" columns="4">
                @foreach($labels as $key => $label)
                    <tr wire:key="{{ $key . '-' . $page }}" class="border-b">
                        <x-table.table-row :item="$label->id" type="data" />
                        <x-table.table-row :item="$label->name" type="data" class="capitalize" />
                        <x-table.table-row :item="$label->slug" type="data" />
                        <x-table.table-row
                            :item="$label->tickets->count()"
                            type="data"
                            link="{{ route('labels.tickets', $label->id) }}"
                        />
                        <x-table.table-row
                            class="{{ $label->color }} text-white w-28 rounded-md p-1 text-center"
                            :item="$label->name"
                            type="data"
                        />
                        <x-table.table-row
                            :item="$label->id"
                            type="action"
                            edit="'show-edit-modal'"
                            delete="'show-delete-modal'"
                        />
                    </tr>
                @endforeach
            </x-table.table-body>
        </x-table.table>
    </div>
    <livewire:pages.dashboard.labels.create-modal />
    <livewire:pages.dashboard.labels.edit-modal />
    <livewire:pages.dashboard.labels.delete-modal />
</div>
