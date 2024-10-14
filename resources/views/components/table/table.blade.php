@props(['items'])
<div>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            {{ $slot }}
        </table>
    </div>
    <div class="pt-6">
        {{ $items->links() }}
    </div>
</div>
