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
        <x-table.table
                :columns="$columns"
                :page="$page"
                :items="$teams"
                :sortColumn="$sortColumn"
                :sortDirection="$sortDirection"
                edit-modal="'show-edit-modal'"
                delete-modal="'show-delete-modal'"
        />
    </div>
    <livewire:pages.dashboard.teams.create-modal />
    <livewire:pages.dashboard.teams.edit-modal />
    <livewire:pages.dashboard.teams.delete-modal />
</div>
