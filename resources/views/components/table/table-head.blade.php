<thead class="text-xs text-gray-700 uppercase bg-gray-50">
    <tr>
        @foreach($columns as $key => $value)
            @if($value['isData'])
                <th
                    wire:click="doSort('{{ $value['column'] }}')"
                    scope="col"
                    class="px-4 py-3"
                >
                    <x-table.datatable-column
                        :sortColumn="$sortColumn"
                        :sort-direction="$sortDirection"
                        column-name="{{ $value['label'] }}"
                    />
                </th>
            @else
                <th scope="col" class="px-4 py-3">{{ $value['label'] }}</th>
            @endif
        @endforeach
    </tr>
</thead>
