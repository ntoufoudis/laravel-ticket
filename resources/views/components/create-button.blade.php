@props(['label', 'event'])
<x-primary-button @click="$dispatch({{ $event }})">
    <svg class="fill-current shrink-0 xs:hidden" width="16" height="16" viewBox="0 0 16 16">
        <path
            d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4
                            1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z"
        />
    </svg>
    <span class="max-xs:sr-only">{{ $label }}</span>
</x-primary-button>
