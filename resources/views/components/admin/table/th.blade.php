@props([
    'sortable' => false,
    'sortField' => null,
    'sortDirection' => null,
    'currentSort' => null,
])

@php
    $classes = 'px-6 py-3 text-left text-xs font-medium text-neutral-700 uppercase tracking-wider';

    if ($sortable) {
        $classes .= ' cursor-pointer hover:bg-neutral-100 select-none';
    }
@endphp

<th {{ $attributes->merge(['class' => $classes]) }}>
    <div class="flex items-center gap-2">
        <span>{{ $slot }}</span>

        @if($sortable)
            <div class="flex flex-col">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.22488 3.35999L3.36487 1.5L1.50488 3.35999" stroke="#52525B" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M3.36475 10.5V1.5" stroke="#52525B" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.7749 8.64001L8.63492 10.5L10.4949 8.64001" stroke="#52525B" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8.63477 1.5V10.5" stroke="#52525B" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
            </div>
        @endif
    </div>
</th>
