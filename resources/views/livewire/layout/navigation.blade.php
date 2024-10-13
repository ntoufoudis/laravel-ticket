<div class="relative inline-flex" x-data="{ open: false }">
    <button
        class="inline-flex justify-center items-center group"
        aria-haspopup="true"
        @click.prevent="open = !open"
        :aria-expanded="open"
    >
        {{--        <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}" width="32" height="32" alt="{{ Auth::user()->name }}" />--}}
        <div class="flex items-center truncate">
            <span
                x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                x-text="name"
                x-on:profile-updated.window="name = $event.detail.name"
                class="truncate ml-2 text-sm font-medium text-gray-600 dark:text-gray-100 group-hover:text-gray-800
                    dark:group-hover:text-white"
            >
            </span>
            <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500" viewBox="0 0 12 12">
                <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
            </svg>
        </div>
    </button>
    <div
        class="origin-top-right z-10 absolute top-full min-w-44 bg-white dark:bg-gray-800 border border-gray-200
            dark:border-gray-700/60 py-1.5 rounded-lg shadow-lg overflow-hidden mt-1 right-0"
        @click.outside="open = false"
        @keydown.escape.window="open = false"
        x-show="open"
        x-transition:enter="transition ease-out duration-200 transform"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-out duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-cloak
    >
        <div class="pt-0.5 pb-2 px-3 mb-1 border-b border-gray-200 dark:border-gray-700/60">
            <div
                x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                x-text="name"
                x-on:profile-updated.window="name = $event.detail.name"
                class="font-medium text-gray-800 dark:text-gray-100"
            >
            </div>
            <div
                x-data="{{ json_encode(['role' => auth()->user()->getRoleNames()]) }}"
                x-text="role"
                x-on:profile-updated.window="role = $event.detail.role"
                class="text-xs text-gray-500 dark:text-gray-400 italic"
            >
                Administrator
            </div>
        </div>
        <ul>
            <li>
                <a
                    class="font-medium text-sm text-violet-500 hover:text-violet-600 dark:hover:text-violet-400 flex
                        items-center py-1 px-3"
                    href="{{ route('profile') }}"
                    wire:navigate
                >
                    Profile
                </a>
            </li>
            <li>
                <button wire:click="logout" class="w-full text-start">
                    <a class="font-medium text-sm text-violet-500 hover:text-violet-600 dark:hover:text-violet-400 flex
                        items-center py-1 px-3"
                    >
                        {{ __('Log Out') }}
                    </a>
                </button>
            </li>
        </ul>
    </div>
</div>
