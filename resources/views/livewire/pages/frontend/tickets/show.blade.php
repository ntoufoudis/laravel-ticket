<div class="flex">
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto no-overflow-anchoring">

        <!-- Header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <!-- Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                    Ticket #{{ $ticket->id }} - {{ $ticket->subject }}
                </h1>
            </div>
        </div>

        <div class="flex flex-col gap-4 max-h-[480px] overflow-auto px-4">
            @foreach($this->ticketMessages as $message)
                @if($message->user_id === auth()->user()->id)
                    <x-right-message :name="auth()->user()->name" :message="$message" />
                @else
                    <x-left-message
                        :name="\App\Models\User::where('id', $message->user_id)->first()->name"
                        :message="$message"
                    />
                @endif
            @endforeach
        </div>
        <div class="mt-8">
            <x-trix-editor wire:model="newMessage" />
        </div>
        <div class="mt-4 flex h-20 items-center justify-between">
            <div>
                <x-primary-button wire:click="send" class="h-11">Send</x-primary-button>
            </div>
            <div class="col-span-2 sm:col-span-1">
                <input
                    wire:model="newAttachments"
                    class="border-gray-300 border rounded-md cursor-pointer focus:outline-none p-2 h-11"
                    id="multiple_files"
                    type="file"
                    multiple
                >
                <div wire:loading wire:target="newAttachments">Uploading...</div>
                <x-breeze.input-error :messages="$errors->get('newAttachments')" class="mt-2" />
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div
        class="flex flex-col h-[calc(100dvh-64px)] overflow-y-scroll no-scrollbar w-64 bg-white dark:bg-gray-800 p-4
            space-y-4"
    >
        <!-- Category -->
        <p class="text-sm font-medium text-gray-800 dark:text-gray-100 capitalize">
            Category: <strong>{{ $ticket->category->name }}</strong>
        </p>
        <!-- Status -->
        <p class="text-sm font-medium text-gray-800 dark:text-gray-100 capitalize">
            Status: <strong>{{ $ticket->status }}</strong>
        </p>
        <!-- Closed Date -->
        @if($ticket->status === 'closed')
            <p class="text-sm font-medium text-gray-800 dark:text-gray-100 capitalize">
                Closed At: <strong>{{ $ticket->updated_at }}</strong>
            </p>
        @endif
        <!-- Created Date -->
        <p class="text-sm font-medium text-gray-800 dark:text-gray-100">
            Created At: <strong>{{ $ticket->created_at }}</strong>
        </p>
        <!-- Assigned To -->
        <p class="text-sm font-medium text-gray-800 dark:text-gray-100">
            Assigned To: <strong>{{ $ticket->assigned_to }}</strong>
        </p>
        <!-- Attachments -->
        <p class="text-sm font-bold text-gray-800 dark:text-gray-100">
            Attachments:
        </p>
        @foreach($this->attachments as $attachment)
            <a
                href="{{ Storage::temporaryUrl($attachment->path, now()->addMinutes(50)) }}"
                target="_blank"
                class="text-sm font-medium text-gray-800 dark:text-gray-100"
            >
                {{ $attachment->name }}
            </a>
        @endforeach
    </div>
</div>
