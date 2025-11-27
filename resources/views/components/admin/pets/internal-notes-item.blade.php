@props(['author', 'time',])

<div class="flex gap-4">
    <img
        src="{{asset('storage/images/team/marc_1x.webp')}}"
        alt="{{ $author }}"
        class="w-12 h-12 rounded-full flex-shrink-0"
    >
    <div class="flex-1">
        <div class="flex items-center gap-2 mb-1">
            <span class="font-semibold text-grayscale-text-title">{{ $author }}</span>
            <span class="text-sm text-grayscale-text-caption">{{ $time }}</span>
        </div>
        <p class="text-gray-700">
            {{ $slot }}
        </p>
    </div>
</div>

