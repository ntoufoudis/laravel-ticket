<div class="min-w-fit">
    <!-- Sidebar backdrop (mobile only) -->
    <div
        class="fixed inset-0 bg-gray-900 bg-opacity-30 z-40 lg:hidden lg:z-auto transition-opacity duration-200"
        :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'"
        aria-hidden="true"
        x-cloak
    ></div>

    <!-- Sidebar -->
    <div
        id="sidebar"
        class="flex lg:!flex flex-col absolute z-40 left-0 top-0 lg:static lg:left-auto lg:top-auto lg:translate-x-0
            h-[100dvh] overflow-y-scroll lg:overflow-y-auto no-scrollbar w-64 lg:w-20 lg:sidebar-expanded:!w-64
            2xl:!w-64 shrink-0 bg-white dark:bg-gray-800 p-4 transition-all duration-200 ease-in-out {{ $variant === 'v2' ? 'border-r border-gray-700/60' : 'rounded-r-2xl shadow-sm' }}"
        :class="sidebarOpen ? 'max-lg:translate-x-0' : 'max-lg:-translate-x-64'"
        @click.outside="sidebarOpen = false"
        @keydown.escape.window="sidebarOpen = false"
    >
        <!-- Sidebar Header -->
        <div class="flex justify-between mb-10 pr-3 sm:px-2">
            <!-- Close Button -->
            <button
                class="lg:hidden text-gray-500 hover:text-gray-400"
                @click.stop="sidebarOpen = !sidebarOpen"
                aria-controls="sidebar"
                :aria-expanded="sidebarOpen"
            >
                <span class="sr-only">Close sidebar</span>
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.7 18.7l1.4-1.4L7.8 13H20v-2H7.8l4.3-4.3-1.4-1.4L4 12z" />
                </svg>
            </button>

            <!-- Logo -->
            <a class="block" href="{{ route('dashboard') }}">
                <svg class="fill-violet-500" xmlns="http://www.w3.org/2000/svg" width="32" height="32">
                    <path d="M31.956 14.8C31.372 6.92 25.08.628 17.2.044V5.76a9.04 9.04 0 0 0 9.04 9.04h5.716ZM14.8 26.24v5.716C6.92 31.372.63 25.08.044 17.2H5.76a9.04 9.04 0 0 1 9.04 9.04Zm11.44-9.04h5.716c-.584 7.88-6.876 14.172-14.756 14.756V26.24a9.04 9.04 0 0 1 9.04-9.04ZM.044 14.8C.63 6.92 6.92.628 14.8.044V5.76a9.04 9.04 0 0 1-9.04 9.04H.044Z" />
                </svg>
            </a>
        </div>

        <!-- Links -->
        <div class="space-y-8">
            <!-- Pages Group -->
            <div>
                <ul class="mt-3">
                    <!-- Dashboard -->
{{--                    <li--}}
{{--                        class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0--}}
{{--                            bg-[linear-gradient(135deg,var(--tw-gradient-stops))]--}}
{{--                            @if(Request::segment(1) === 'dashboard'){{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }}@endif"--}}
{{--                        x-data="{ open: {{ Request::segment(1) === 'dashboard' ? 1 : 0 }} }"--}}
{{--                    >--}}
{{--                        <a--}}
{{--                            class="block text-gray-800 dark:text-gray-100 truncate transition--}}
{{--                                @if(Request::segment(1) !== 'dashboard'){{ 'hover:text-gray-900 dark:hover:text-white' }}@endif"--}}
{{--                            href="#"--}}
{{--                            @click.prevent="open = !open; sidebarExpanded = true"--}}
{{--                        >--}}
{{--                            <div class="flex items-center justify-between">--}}
{{--                                <div class="flex items-center">--}}
{{--                                    <svg--}}
{{--                                        class="shrink-0 fill-current--}}
{{--                                            @if(Request::segment(1) === 'dashboard'){{ 'text-violet-500' }}--}}
{{--                                            @else{{ 'text-gray-400 dark:text-gray-500' }}@endif"--}}
{{--                                        xmlns="http://www.w3.org/2000/svg"--}}
{{--                                        width="16"--}}
{{--                                        height="16"--}}
{{--                                        viewBox="0 0 16 16"--}}
{{--                                    >--}}
{{--                                        <path--}}
{{--                                            d="M5.936.278A7.983 7.983 0 0 1 8 0a8 8 0 1 1-8--}}
{{--                                                8c0-.722.104-1.413.278-2.064a1 1 0 1 1 1.932.516A5.99 5.99 0 0 0 2 8a6--}}
{{--                                                6 0 1 0 6-6c-.53 0-1.045.076-1.548.21A1 1 0 1 1 5.936.278Z"--}}
{{--                                        />--}}
{{--                                        <path--}}
{{--                                            d="M6.068 7.482A2.003 2.003 0 0 0 8 10a2 2 0 1 0-.518-3.932L3.707 2.293a1 1--}}
{{--                                                0 0 0-1.414 1.414l3.775 3.775Z"--}}
{{--                                        />--}}
{{--                                    </svg>--}}
{{--                                    <span--}}
{{--                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100--}}
{{--                                            2xl:opacity-100 duration-200"--}}
{{--                                    >--}}
{{--                                        Dashboard--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                                <!-- Icon -->--}}
{{--                                <div--}}
{{--                                    class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100--}}
{{--                                        2xl:opacity-100 duration-200"--}}
{{--                                >--}}
{{--                                    <svg--}}
{{--                                        class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500--}}
{{--                                            @if(Request::segment(1) === 'dashboard'){{ 'rotate-180' }}@endif"--}}
{{--                                        :class="open ? 'rotate-180' : 'rotate-0'"--}}
{{--                                        viewBox="0 0 12 12"--}}
{{--                                    >--}}
{{--                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />--}}
{{--                                    </svg>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">--}}
{{--                            <ul--}}
{{--                                class="pl-8 mt-1 @if(Request::segment(1) !== 'dashboard'){{ 'hidden' }}@endif"--}}
{{--                                :class="open ? '!block' : 'hidden'"--}}
{{--                            >--}}
{{--                                <li class="mb-1 last:mb-0">--}}
{{--                                    <a--}}
{{--                                        class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700--}}
{{--                                            dark:hover:text-gray-200 transition truncate--}}
{{--                                            @if(Route::is('dashboard')){{ '!text-violet-500' }}@endif"--}}
{{--                                        href="{{ route('dashboard') }}"--}}
{{--                                    >--}}
{{--                                        <span--}}
{{--                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100--}}
{{--                                                2xl:opacity-100 duration-200"--}}
{{--                                        >--}}
{{--                                            Main--}}
{{--                                        </span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="mb-1 last:mb-0">--}}
{{--                                    <a--}}
{{--                                        class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700--}}
{{--                                            dark:hover:text-gray-200 transition truncate--}}
{{--                                            @if(Route::is('analytics')){{ '!text-violet-500' }}@endif"--}}
{{--                                        href="{{ route('home') }}"--}}
{{--                                    >--}}
{{--                                        <span--}}
{{--                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100--}}
{{--                                                2xl:opacity-100 duration-200"--}}
{{--                                        >--}}
{{--                                            Analytics--}}
{{--                                        </span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="mb-1 last:mb-0">--}}
{{--                                    <a--}}
{{--                                        class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700--}}
{{--                                            dark:hover:text-gray-200 transition truncate--}}
{{--                                            @if(Route::is('fintech')){{ '!text-violet-500' }}@endif"--}}
{{--                                        href="{{ route('categories.index') }}"--}}
{{--                                    >--}}
{{--                                        <span--}}
{{--                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100--}}
{{--                                                2xl:opacity-100 duration-200"--}}
{{--                                        >--}}
{{--                                            Fintech--}}
{{--                                        </span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </li>--}}
                    <!-- Tickets -->
                    <li
                        class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0
                            bg-[linear-gradient(135deg,var(--tw-gradient-stops))]
                            @if(Request::segment(2) === 'tickets'){{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }}@endif"
                    >
                        <a
                            class="block text-gray-800 dark:text-gray-100 truncate transition
                                @if(Request::segment(2) === 'tickets'){{ 'hover:text-gray-900 dark:hover:text-white' }}@endif"
                            href="{{ route('tickets.index') }}"
                            wire:navigate
                        >
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <iconify-icon icon="mdi:message" class="shrink-0 fill-current"></iconify-icon>
                                    <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100
                                            2xl:opacity-100 duration-200"
                                    >
                                        Tickets
                                    </span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- Categories -->
                    <li
                        class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0
                            bg-[linear-gradient(135deg,var(--tw-gradient-stops))]
                            @if(Request::segment(2) === 'categories'){{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }}@endif"
                    >
                        <a
                            class="block text-gray-800 dark:text-gray-100 truncate transition
                                @if(Request::segment(2) === 'categories'){{ 'hover:text-gray-900 dark:hover:text-white' }}@endif"
                            href="{{ route('categories.index') }}"
                            wire:navigate
                        >
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <iconify-icon icon="mdi:category" class="shrink-0 fill-current"></iconify-icon>
                                    <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100
                                            2xl:opacity-100 duration-200"
                                    >
                                        Categories
                                    </span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- Labels -->
                    <li
                        class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0
                            bg-[linear-gradient(135deg,var(--tw-gradient-stops))]
                            @if(Request::segment(2) === 'labels'){{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }}@endif"
                    >
                        <a
                            class="block text-gray-800 dark:text-gray-100 truncate transition
                                @if(Request::segment(2) === 'labels'){{ 'hover:text-gray-900 dark:hover:text-white' }}@endif"
                            href="{{ route('labels.index') }}"
                            wire:navigate
                        >
                            <div class="flex items-center justify-between">
                                <div class="grow flex items-center">
                                    <iconify-icon icon="mdi:tags" class="shrink-0 fill-current"></iconify-icon>
                                    <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100
                                            2xl:opacity-100 duration-200"
                                    >
                                        Labels
                                    </span>
                                </div>
                                <!-- Badge -->
{{--                                <div class="flex flex-shrink-0 ml-2">--}}
{{--                                    <span --}}
{{--                                        class="inline-flex items-center justify-center h-5 text-xs font-medium --}}
{{--                                            text-white bg-violet-400 px-2 rounded"--}}
{{--                                    >--}}
{{--                                        4--}}
{{--                                    </span>--}}
{{--                                </div>--}}
                            </div>
                        </a>
                    </li>
                    <!-- Teams -->
                    <li
                        class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0
                            bg-[linear-gradient(135deg,var(--tw-gradient-stops))]
                            @if(Request::segment(2) === 'teams'){{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }}@endif"
                    >
                        <a
                            class="block text-gray-800 dark:text-gray-100 truncate transition
                                @if(Request::segment(2) === 'teams'){{ 'hover:text-gray-900 dark:hover:text-white' }}@endif"
                            href="{{ route('teams.index') }}"
                            wire:navigate
                        >
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <iconify-icon icon="mdi:account-group" class="shrink-0 fill-current"></iconify-icon>
                                    <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100
                                            2xl:opacity-100 duration-200"
                                    >
                                        Teams
                                    </span>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Expand / collapse button -->
        <div class="pt-3 hidden lg:inline-flex 2xl:hidden justify-end mt-auto">
            <div class="w-12 pl-4 pr-3 py-2">
                <button class="text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 transition-colors" @click="sidebarExpanded = !sidebarExpanded">
                    <span class="sr-only">Expand / collapse sidebar</span>
                    <svg class="shrink-0 fill-current text-gray-400 dark:text-gray-500 sidebar-expanded:rotate-180" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                        <path d="M15 16a1 1 0 0 1-1-1V1a1 1 0 1 1 2 0v14a1 1 0 0 1-1 1ZM8.586 7H1a1 1 0 1 0 0 2h7.586l-2.793 2.793a1 1 0 1 0 1.414 1.414l4.5-4.5A.997.997 0 0 0 12 8.01M11.924 7.617a.997.997 0 0 0-.217-.324l-4.5-4.5a1 1 0 0 0-1.414 1.414L8.586 7M12 7.99a.996.996 0 0 0-.076-.373Z" />
                    </svg>
                </button>
            </div>
        </div>

    </div>
</div>
