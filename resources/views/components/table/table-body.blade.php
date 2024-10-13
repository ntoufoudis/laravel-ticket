@props(['items', 'columns', 'page', 'editModal', 'deleteModal'])

<tbody>
    @if ($items->isEmpty())
        <tr class="text-center">
            <td class="p-5 border text-sm" :colspan="{{ count($columns) + 1 }}">No Data Displayed.</td>
        </tr>
    @endif

    @foreach($items as $key => $item)
        <x-table.table-row :item="$item" :columns="$columns" :key="$key" :page="$page" :edit-modal="$editModal" :delete-modal="$deleteModal" />
    @endforeach

</tbody>
