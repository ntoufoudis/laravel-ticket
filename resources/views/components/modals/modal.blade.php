<div
    {{ $attributes }}
    x-data="{ show: @entangle($attributes->wire('model')) }"
    x-show="show"
    x-cloak
    x-on:keydown.escape.window="$dispatch('closeModal')"
    class="fixed inset-0 overflow-y-auto px-4 py-6 md:py-24 sm:px-0 z-40"
>
    <div
        x-on:click="$dispatch('closeModal')"
        class="fixed inset-0 transform"
    >
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <div
        class="bg-white dark:bg-gray-900 rounded-lg overflow-hidden transform sm:w-full sm:mx-auto max-w-lg"
    >
        <div class="bg-white dark:bg-gray-800/90 flex items-center justify-between p-4 md:p-5 border-b rounded-t">
            @if(isset($header))
                <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ $header }}
                </h3>
            @endif
            <button
                @click="$dispatch('closeModal')"
                type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8
                ms-auto inline-flex justify-center items-center"
            >
                <iconify-icon icon="mdi:close" />
                <span class="sr-only">Close modal</span>
            </button>
        </div>

        <main class="bg-white dark:bg-gray-900">
            {{ $slot }}
        </main>

        @if(isset($footer))
            <footer class="flex items-center justify-center space-x-8 bg-white dark:bg-gray-900 pb-4">
                {{ $footer }}
            </footer>
        @endif
    </div>
</div>
