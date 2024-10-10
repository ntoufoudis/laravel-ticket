@props(['closeFunction'])

<div
    {{ $attributes }}
    x-data="{ show: @entangle($attributes->wire('model')) }"
    x-show="show"
    x-cloak
>
    <div
        class="fixed inset-0 bg-gray-900 opacity-90"
        wire:click="{{ $closeFunction }}"
        @keydown.escape.window="{{ $closeFunction }}"
    ></div>

    <div class="bg-white shadow-md p-4 max-w-md h-fit m-auto rounded-lg fixed inset-0">
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
            @if(isset($header))
                <h3 class="text-lg font-semibold text-gray-900">
                    {{ $header }}
                </h3>
            @endif
            <button
                wire:click="{{ $closeFunction }}"
                type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8
                    ms-auto inline-flex justify-center items-center"
            >
                <svg
                    class="w-3 h-3"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 14 14"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                    />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>

        <main>
            {{ $main }}
        </main>

        @if(isset($footer))
            <footer class="flex items-center justify-center space-x-8">
                {{ $footer }}
            </footer>
        @endif
    </div>
</div>
