<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <!-- Header -->
    <div class="sm:flex sm:justify-between sm:items-center mb-8">
        <!-- Title -->
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                Tickets
            </h1>
        </div>
        <!-- Actions -->
        <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-4">
            <!-- Search -->
            <x-search search="search" />
            <!-- Add New Button -->
            <x-primary-button>
                <a href="{{ route('tickets.create') }}" wire:navigate>
                    <svg class="fill-current shrink-0 xs:hidden" width="16" height="16" viewBox="0 0 16 16">
                        <path
                            d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4
                            1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z"
                        />
                    </svg>
                    <span class="max-xs:sr-only">Create new Ticket</span>
                </a>
            </x-primary-button>
        </div>
    </div>

    <div class="grid grid-cols-23 gap-6">
        <x-table.table :items="$tickets">
            <x-table.table-head>
                <x-table.datatable-column column="id" />
                <x-table.datatable-column column="subject" />
                <x-table.datatable-column column="category" />
                <x-table.datatable-column column="priority" />
                <x-table.datatable-column column="status" />
            </x-table.table-head>
            <x-table.table-body :items="$tickets" columns="4">
                @foreach($tickets as $key => $ticket)
                    <tr wire:key="{{ $key }}" class="border-b">
                        <x-table.table-row :item="$ticket->id" type="data" />
                        <x-table.table-row :item="$ticket->subject" type="data" />
                        <x-table.table-row :item="$ticket->category->name" type="data" />
                        <x-table.table-row :item="$ticket->priority" type="data" class="capitalize" />
                        <x-table.table-row :item="$ticket->status" type="data" class="capitalize" />
                    </tr>
                @endforeach
            </x-table.table-body>
        </x-table.table>
    </div>
</div>
