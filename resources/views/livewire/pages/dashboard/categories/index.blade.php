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

            <!-- Filters -->
            <x-filters model="visibility" :filters="$filters" />

            <!-- Add New Button -->
            <x-create-button modal="'showCreateModal'" label="Add new Category" />
        </div>
    </div>

    <div class="grid grid-cols-23 gap-6">
        <x-table.table
            :columns="$columns"
            :page="$page"
            :items="$categories"
            :sortColumn="$sortColumn"
            :sortDirection="$sortDirection"
            edit-modal="openEditModal"
            delete-modal="confirmDelete"
        />
    </div>

{{--    <x-modal wire:model="showCreateModal" close-function="closeModals">--}}
{{--        <x-slot name="header">--}}
{{--            @if($updateMode)--}}
{{--                Edite Category--}}
{{--            @else--}}
{{--                Create new Category--}}
{{--            @endif--}}
{{--        </x-slot>--}}

{{--        <x-slot name="main">--}}
{{--            <form class="p-4 md:p-5" wire:submit="{{ $updateMode === true ? 'edit' : 'store' }}">--}}
{{--                <div class="grid gap-4 mb-4 grid-cols-2">--}}
{{--                    <div class="col-span-2 sm:col-span-1">--}}
{{--                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>--}}
{{--                        <input--}}
{{--                            wire:model="state.name"--}}
{{--                            type="text"--}}
{{--                            name="name"--}}
{{--                            id="name"--}}
{{--                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg--}}
{{--                                focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"--}}
{{--                            placeholder="Type category name"--}}
{{--                            required--}}
{{--                        >--}}
{{--                        @if ($errors->get('name'))--}}
{{--                            <ul class="text-sm text-red-600 space-y-1 mt-2">--}}
{{--                                @foreach ((array) $errors->get('name') as $error)--}}
{{--                                    <li>{{ $error }}</li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <div class="col-span-2 sm:col-span-1">--}}
{{--                        <label for="slug" class="block mb-2 text-sm font-medium text-gray-900">Slug</label>--}}
{{--                        <input--}}
{{--                            wire:model="state.slug"--}}
{{--                            type="text"--}}
{{--                            name="slug"--}}
{{--                            id="slug"--}}
{{--                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg--}}
{{--                                focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"--}}
{{--                            placeholder="Type category slug"--}}
{{--                            required--}}
{{--                        >--}}
{{--                        @if ($errors->get('slug'))--}}
{{--                            <ul class="text-sm text-red-600 space-y-1 mt-2">--}}
{{--                                @foreach ((array) $errors->get('slug') as $error)--}}
{{--                                    <li>{{ $error }}</li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <div class="block mt-2">--}}
{{--                        <label for="is_visible" class="inline-flex items-center">--}}
{{--                            <input--}}
{{--                                wire:model="state.is_visible"--}}
{{--                                id="is_visible"--}}
{{--                                type="checkbox"--}}
{{--                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"--}}
{{--                                name="remember"--}}
{{--                            >--}}
{{--                            <span class="ms-2 text-sm text-gray-600">{{ __('Visible') }}</span>--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <button--}}
{{--                    type="submit"--}}
{{--                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4--}}
{{--                        focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"--}}
{{--                >--}}
{{--                    @if($updateMode)--}}
{{--                        Update--}}
{{--                    @else--}}
{{--                        Add new category--}}
{{--                    @endif--}}
{{--                </button>--}}
{{--            </form>--}}
{{--        </x-slot>--}}
{{--    </x-modal>--}}

{{--    <x-modal wire:model="showConfirmDeleteModal" close-function="closeModals">--}}
{{--        <x-slot name="header">--}}
{{--            <svg--}}
{{--                class="text-gray-400 w-11 h-11 mb-3.5 mx-auto"--}}
{{--                aria-hidden="true"--}}
{{--                fill="currentColor"--}}
{{--                viewBox="0 0 20 20"--}}
{{--                xmlns="http://www.w3.org/2000/svg"--}}
{{--            >--}}
{{--                <path--}}
{{--                    fill-rule="evenodd"--}}
{{--                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0--}}
{{--                        100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1--}}
{{--                        1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"--}}
{{--                />--}}
{{--            </svg>--}}
{{--        </x-slot>--}}
{{--        <x-slot name="header">Delete Category</x-slot>--}}
{{--        <x-slot name="main">--}}
{{--            <p class="mb-4 text-gray-500">--}}
{{--                Are you sure you want to delete <strong>{{ $this->state['name'] ?? '' }}</strong> category?--}}
{{--            </p>--}}
{{--        </x-slot>--}}
{{--        <x-slot name="footer">--}}
{{--            <button--}}
{{--                type="button"--}}
{{--                class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200--}}
{{--                    hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900--}}
{{--                    focus:z-10"--}}
{{--                wire:click="closeModals"--}}
{{--            >--}}
{{--                No, Cancel--}}
{{--            </button>--}}
{{--            <button--}}
{{--                type="button"--}}
{{--                class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700--}}
{{--                    focus:ring-4 focus:outline-none focus:ring-red-300"--}}
{{--                wire:click="delete"--}}
{{--            >--}}
{{--                Yes, I'm sure--}}
{{--            </button>--}}
{{--        </x-slot>--}}
{{--    </x-modal>--}}
</div>
