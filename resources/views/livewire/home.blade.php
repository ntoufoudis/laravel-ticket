<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Tickets') }}
    </h2>
</x-slot>
<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="w-full">
                    <div class="flex flex-col md:flex-row items-center justify-between md:space-x-4">
                        <x-table.search search="search" />
{{--                        <x-table.add-new :create-modal="$createModal" />--}}
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th
                                        scope="col"
                                        class="px-4 py-3"
                                    >
                                        <div class="flex items-center cursor-pointer">
                                            Id
                                        </div>
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-4 py-3"
                                    >
                                        <div class="flex items-center cursor-pointer">
                                            Subject
                                        </div>
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-4 py-3"
                                    >
                                        <div class="flex items-center cursor-pointer">
                                            Priority
                                        </div>
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-4 py-3"
                                    >
                                        <div class="flex items-center cursor-pointer">
                                            Category
                                        </div>
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-4 py-3"
                                    >
                                        <div class="flex items-center cursor-pointer">
                                            Status
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($tickets->isEmpty())
                                    <tr class="text-center">
                                        <td class="p-5 border text-sm" :colspan="{{ 6 }}">No Data Displayed.</td>
                                    </tr>
                                @endif

                                @foreach($tickets as $key => $ticket)
                                        <tr
                                            wire:key="{{ $ticket->id . '-' . $page}}"
                                            class="border-b"
                                        >
                                            <td class="px-4 py-3">
                                                {{ $ticket->id }}
                                            </td>
                                            <td class="px-4 py-3">
                                                {{ $ticket->subject }}
                                            </td>
                                            <td class="px-4 py-3">
                                                {{ $ticket->priority }}
                                            </td>
                                            <td class="px-4 py-3">
                                                {{ $ticket->category->name }}
                                            </td>
                                            <td class="px-4 py-3">
                                                {{ $ticket->status }}
                                            </td>
                                        </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="pt-6">
                        {{ $tickets->links('components.table.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
