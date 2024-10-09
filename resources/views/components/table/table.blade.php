@props([
    'sortColumn',
    'items',
    'columns',
    'page',
    'sortDirection',
    'isModalEdit' => false,
    'routeEdit' => null,
    'routeView' => null,
])

<div class="w-full">
    <div class="flex flex-col md:flex-row items-center justify-between md:space-x-4">
        <div class="w-full md:w-56 pb-6">
            <label for="search" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg
                        aria-hidden="true"
                        class="w-5 h-5 text-gray-500"
                        fill="currentColor"
                        viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414
                            1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </div>
                <input
                    wire:model.live.debounce.300ms="search"
                    type="text"
                    id="search"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 pl-10 p-2
                    focus:border-blue-500 block w-full"
                    placeholder="Search"
                >
            </div>
        </div>
            <div
                class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center
                justify-end md:space-x-3 flex-shrink-0 pb-6"
            >
                <button
                    wire:click="$set('showCreateModal', true)"
                    type="button"
                    class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:outline-none
                        px-4 py-2 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm"
                >
                    <svg
                        class="h-3.5 w-3.5 mr-2"
                        fill="currentColor"
                        viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                    >
                        <path
                            clip-rule="evenodd"
                            fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        />
                    </svg>
                    Add new Label
                </button>
            </div>
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
            />
        </table>
    </div>
    <div class="pt-6">
        {{ $items->links('components.table.pagination') }}
    </div>
</div>
