<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <!-- Header -->
    <div class="sm:flex sm:justify-between sm:items-center mb-8">
        <!-- Title -->
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                Agents in Team {{ $team->name }}
            </h1>
        </div>
        <!-- Actions -->
        <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-4">
            <!-- Search -->
            <x-search search="search" />
        </div>
    </div>

    <div class="grid grid-cols-23 gap-6">
        <x-table.table :items="$agents">
            <x-table.table-head>
                <x-table.datatable-column column="id" />
                <x-table.datatable-column column="name" />
                <x-table.datatable-column column="email" />
            </x-table.table-head>
            <x-table.table-body :items="$agents" columns="2">
                @foreach($agents as $key => $agent)
                    <tr wire:key="{{ $key }}" class="border-b">
                        <x-table.table-row :item="$agent->id" type="data" />
                        <x-table.table-row :item="$agent->name" type="data" />
                        <x-table.table-row :item="$agent->email" type="data" />
                    </tr>
                @endforeach
            </x-table.table-body>
        </x-table.table>
    </div>
</div>
