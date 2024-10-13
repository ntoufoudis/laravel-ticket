@props(['model', 'filters'])
<div class="relative">
    <select
        wire:model.live="{{ $model }}"
        class="rounded-lg block appearance-none w-full bg-white border-gray-400 text-gray-700 text-sm"
    >
        <option value="">All</option>
        @foreach($filters as $filter)
            <option value="{{ $filter['value'] }}">{{ $filter['name'] }}</option>
        @endforeach
    </select>
</div>
