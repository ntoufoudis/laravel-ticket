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
        {{ $items->links() }}
    </div>
</div>
