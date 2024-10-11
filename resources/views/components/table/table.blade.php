@props([
    'sortColumn',
    'items',
    'columns',
    'page',
    'sortDirection',
    'search',
    'createModal',
    'editModal',
    'deleteModal',
    'visibility',
    'filters',
])

<div class="w-full">
    <div class="flex flex-col md:flex-row items-center justify-between md:space-x-4">
        <x-table.search :search="$search" />
        <x-table.add-new :create-modal="$createModal" />
        <x-table.filter :filters="$filters" :visibility="$visibility" />
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <x-table.table-head
                :columns="$columns"
                :sortColumn="$sortColumn"
                :sortDirection="$sortDirection"
            />
            <x-table.table-body
                :items="$items"
                :columns="$columns"
                :page="$page"
                :edit-modal="$editModal"
                :delete-modal="$deleteModal"
            />
        </table>
    </div>
    <div class="pt-6">
        {{ $items->links('components.table.pagination') }}
    </div>
</div>
