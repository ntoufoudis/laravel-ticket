@props(['sort', 'column', 'sortAsc', 'sortable'])
@if(isset($sortable))
    <th
        wire:click="{{$sort}}('{{$column}}')"
        scope="col"
        class="px-4 py-3 cursor-pointer"
    >
        <div class="flex items-center h-6">
            {{ $column }}

            @if ($sortAsc === true)
                <iconify-icon icon="mdi:chevron-down" width="24"></iconify-icon>
            @else
                <iconify-icon icon="mdi:chevron-up" width="24"></iconify-icon>
            @endif
        </div>

    </th>
@else
    <th scope="col" class="px-4 py-3">
        {{ $column }}
    </th>
@endif
