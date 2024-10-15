<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <!-- Header -->
    <div class="sm:flex sm:justify-between sm:items-center mb-8">
        <!-- Title -->
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                Ticket #{{ $ticket->id }} - {{ $ticket->subject }}
            </h1>
        </div>
    </div>

    <div class="flex flex-col gap-4">
        @foreach($ticket->messages as $message)
            @if($message->user_id === auth()->user()->id)
                <x-right-message :name="auth()->user()->name" :message="$message" />
            @else
                <x-left-message
                    :name="\App\Models\User::where('id', $message->user_id)->first()->name"
                    :message="$message"
                />
            @endif
        @endforeach
        <div class="pt-8">
            <x-trix-editor entangle="message" />
        </div>
        <div>
            <x-primary-button wire:click="send">Send</x-primary-button>
        </div>

    </div>
</div>


{{--    <!-- Name -->--}}
{{--        <div class="col-span-2 sm:col-span-1">--}}
{{--            <x-breeze.input-label for="name" :value="__('Name')" />--}}
{{--            <x-breeze.text-input--}}
{{--                value="{{ $user->name }}"--}}
{{--                disabled--}}
{{--                id="name"--}}
{{--                class="block mt-1 w-full"--}}
{{--            />--}}
{{--        </div>--}}

{{--        <!-- Email -->--}}
{{--        <div class="col-span-2 sm:col-span-1">--}}
{{--            <x-breeze.input-label for="email" :value="__('Email')" />--}}
{{--            <x-breeze.text-input--}}
{{--                value="{{ $user->email }}"--}}
{{--                disabled--}}
{{--                id="email"--}}
{{--                class="block mt-1 w-full"--}}
{{--            />--}}
{{--        </div>--}}

{{--        <!-- Subject -->--}}
{{--        <div class="col-span-2">--}}
{{--            <x-breeze.input-label for="subject" :value="__('Subject')" />--}}
{{--            <x-breeze.text-input--}}
{{--                value="{{ $ticket->subject }}"--}}
{{--                disabled--}}
{{--                id="subject"--}}
{{--                class="block mt-1 w-full"--}}
{{--            />--}}
{{--        </div>--}}

<!-- Description -->
{{--        <div class="col-span-2">--}}
{{--            <x-breeze.input-label for="description" :value="__('Description')" />--}}
{{--            <textarea--}}
{{--                value="{{ $ticket->message }}"--}}
{{--                disabled--}}
{{--                id="description"--}}
{{--                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm"--}}
{{--                style="resize: none;"--}}
{{--                rows="10"--}}
{{--            ></textarea>--}}
{{--        </div>--}}

{{--        <!-- Priority -->--}}
{{--        <div class="col-span-2 sm:col-span-1">--}}
{{--            <x-breeze.input-label for="priority" :value="__('Priority')" />--}}
{{--            <x-breeze.text-input--}}
{{--                value="{{ $ticket->priority }}"--}}
{{--                disabled--}}
{{--                id="priority"--}}
{{--                class="block mt-1 w-full"--}}
{{--            />--}}
{{--        </div>--}}

{{--        <!-- Category -->--}}
{{--        <div class="col-span-2 sm:col-span-1">--}}
{{--            <x-breeze.input-label for="category" :value="__('Category')" />--}}
{{--            <x-breeze.text-input--}}
{{--                value="{{ $ticket->category->name }}"--}}
{{--                disabled--}}
{{--                id="category"--}}
{{--                class="block mt-1 w-full"--}}
{{--            />--}}
{{--        </div>--}}
{{--</div>--}}


