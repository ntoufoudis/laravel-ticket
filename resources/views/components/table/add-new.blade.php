@props(['createModal'])

<div
    class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center
                justify-end md:space-x-3 flex-shrink-0 pb-6"
>
    <button
        wire:click="$set({{$createModal}}, true)"
        type="button"
        class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:outline-none
                        px-4 py-2 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm"
    >
        <svg
            class="h-3.5 w-3.5 mr-2"
            fill="currentColor"
            viewbox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
        >
            <path
                clip-rule="evenodd"
                fill-rule="evenodd"
                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
            />
        </svg>
        Add new Label
    </button>
</div>
