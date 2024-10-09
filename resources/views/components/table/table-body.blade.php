@props(['items', 'columns', 'page', 'isModalEdit' => false, 'routeEdit'=> null, 'routeView' => null])

<tbody>
    @if ($items->isEmpty())
        <tr class="text-center">
            <td class="p-5 border text-sm" :colspan="{{ count($columns) + 1 }}">No Data Displayed.</td>
        </tr>
    @endif

    @foreach($items as $key => $item)
        <x-table.table-row :routeView="$routeView" :routeEdit="$routeEdit" :isModalEdit="$isModalEdit" :item="$item" :columns="$columns" :key="$key" :page="$page" />
    @endforeach

</tbody>
