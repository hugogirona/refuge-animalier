@props([
    'user',
    'action',
    'target',
    'time',
    'link' => null,
])

<div class="flex items-start justify-between py-3 border-b border-neutral-100 last:border-0">
    <div class="flex-1">
        <p class="text-sm text-grayscale-text-subtitle">
            <span class="font-semibold text-grayscale-text-title">{{ $user }}</span>
            {{ $action }}
            <span class="font-semibold text-grayscale-text-title">{{ $target }}</span>
        </p>
        <p class="text-xs text-grayscale-text-caption mt-1">{{ $time }}</p>
    </div>

    @if($link)
        <a
            href="{{ $link }}"
            class="text-primary-text-link-light hover:text-primary-text-link-dark font-medium text-sm ml-4 flex-shrink-0"
        >
            Voir
        </a>
    @endif
</div>
