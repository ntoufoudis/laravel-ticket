@props(['items', 'columns'])

<tbody>
    @if ($items->isEmpty())
        <tr class="text-center">
            <td class="p-5 border text-sm" :colspan="{{ $columns + 1 }}">No records found.</td>
        </tr>
    @endif
    {{ $slot }}
</tbody>
