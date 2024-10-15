@props(['name', 'message'])
<div class="flex items-start gap-2.5">
    <img
        class="w-8 h-8 rounded-full"
        src="{{ Avatar::create($name)->toBase64() }}"
        alt="{{ $name }}"
    >
    <div
        class="flex flex-col w-full max-w-[500px] leading-1.5 p-4 border-gray-200 bg-gray-200 rounded-e-xl rounded-es-xl
            dark:bg-gray-700"
    >
        <div class="flex items-center space-x-2 rtl:space-x-reverse">
            <span class="text-sm font-semibold text-gray-900 dark:text-white">
                {{ $name }}
            </span>
            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                {{ $message->created_at->diffForHumans() }}
            </span>
        </div>
        <p class="text-sm font-normal py-2.5 text-gray-900 dark:text-white">
            {!! $message->message !!}
        </p>
    </div>
</div>
