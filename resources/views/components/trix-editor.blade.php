@props(['entangle'])

@push('head')
@endpush
<div
    wire:ignore
    x-data="{ value: @entangle($entangle) }"
    x-id="['trix']"
    @trix-change="value = $refs.input.value"
    @trix-file-accept.prevent
    class="w-full"
>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.1.6/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.1.6/dist/trix.umd.min.js"></script>

    <input x-ref="input" type="hidden" :id="$id('trix')">

    <trix-editor x-ref="trix" :input="$id('trix')" class="rounded-xl"></trix-editor>
</div>

<style>
    [data-trix-button-group="file-tools"] {
        display: none !important;
    }
    [data-trix-button-group="history-tools"] {
        display: none !important;
    }
</style>
