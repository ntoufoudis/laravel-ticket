<div
    x-data="{
        value: @entangle($attributes->wire('model')),
         isFocused() { return document.activeElement !== this.$refs.trix },
         setValue() {
            if (this.$refs.trix && this.$refs.trix.editor) {
                this.$refs.trix.editor.loadHTML(this.value);
            }
         },}"
    x-init="setValue();
        $watch('value', () => isFocused() && setValue())"
    x-on:trix-change="value = $event.target.value"
    x-on:trix-initialize="setValue()"
    {{ $attributes->whereDoesntStartWith('wire:model') }}
    wire:ignore
    {{ $attributes->merge(['class' => 'mt-1 rounded-md']) }}
>
    <input id="x" type="hidden">
    <trix-editor x-ref="trix" input="x"></trix-editor>
</div>
<style>
    [data-trix-button-group="file-tools"] {
        display: none !important;
    }
    [data-trix-button-group="history-tools"] {
        display: none !important;
    }
</style>
