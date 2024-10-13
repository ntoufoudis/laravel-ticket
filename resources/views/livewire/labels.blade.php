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

            <!-- Filters -->
            <x-filters model="visibility" :filters="$filters" />

            <!-- Add New Button -->
            <x-create-button modal="'showCreateModal'" label="Add new Label" />
        </div>
    </div>

    <div class="grid grid-cols-23 gap-6">
        <x-table.table
            :columns="$columns"
            :page="$page"
            :items="$labels"
            :sortColumn="$sortColumn"
            :sortDirection="$sortDirection"
            edit-modal="openEditModal"
            delete-modal="confirmDelete"
        />
    </div>
</div>
