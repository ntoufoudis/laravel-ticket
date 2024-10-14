<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <!-- Header -->
    <div class="sm:flex sm:justify-between sm:items-center mb-8">
        <!-- Title -->
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                Categories
            </h1>
        </div>
        <!-- Actions -->
        <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-4">
            <!-- Search -->
            <x-search search="search" />
            <!-- Add New Button -->
            <x-create-button label="Add new Category" event="'show-create-modal'" />
        </div>
    </div>

    <div class="grid grid-cols-23 gap-6">
        <x-table.table :items="$categories">
            <x-table.table-head>
                <x-table.datatable-column column="id" />
                <x-table.datatable-column column="name" />
                <x-table.datatable-column column="slug" />
                <x-table.datatable-column column="tickets" />
                <th scope="col" class="px-4 py-3">Actions</th>
            </x-table.table-head>
            <x-table.table-body :items="$categories" columns="4">
                @foreach($categories as $key => $category)
                    <tr wire:key="{{ $key . '-' . $page }}" class="border-b">
                        <x-table.table-row :item="$category->id" type="data" />
                        <x-table.table-row :item="$category->name" type="data" />
                        <x-table.table-row :item="$category->slug" type="data" />
                        <x-table.table-row
                            :item="$category->tickets->count()"
                            type="data"
                            link="{{ route('categories.tickets', $category->id) }}"
                        />
                        <x-table.table-row
                            :item="$category->id"
                            type="action"
                            edit="'show-edit-modal'"
                            delete="'show-delete-modal'"
                        />
                    </tr>
                @endforeach
            </x-table.table-body>
        </x-table.table>
    </div>
    <livewire:pages.dashboard.categories.create-modal />
    <livewire:pages.dashboard.categories.edit-modal />
    <livewire:pages.dashboard.categories.delete-modal />
</div>
