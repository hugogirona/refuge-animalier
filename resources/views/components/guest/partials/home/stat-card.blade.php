@props([
    'number',
    'label',
    'color' => 'orange',
    'icon_name' => 'heart'
])

@php
    $colors = [
        'orange' => [
            'bg' => 'bg-warning-surface-default-subtle',
            'border' => 'border-warning-border-default-subtle',
            'icon' => 'fill-warning-surface-default',
            'text' => 'text-warning-text-link-light',
        ],
        'green' => [
           'bg' => 'bg-success-surface-default-subtle',
            'border' => 'border-success-border-default-subtle',
            'icon' => 'fill-success-surface-default',
            'text' => 'text-success-text-link-light',
        ],
        'blue' => [
           'bg' => 'bg-secondary-surface-default-subtle',
            'border' => 'border-secondary-border-default-subtle',
            'icon' => 'fill-secondary-surface-default',
            'text' => 'text-secondary-text-link-light',
        ],
        'purple' => [
          'bg' => 'bg-purple-surface-default-subtle',
            'border' => 'border-purple-border-default-subtle',
            'icon' => 'fill-purple-surface-default',
            'text' => 'text-purple-text-link-light',
        ],
    ];

    $icons = [
        'heart' => '<svg class="w-10 h-10 md:w-16 md:h-16 mx-auto" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>',
        'users' => '<svg class="w-10 h-10 md:w-16 md:h-16 mx-auto" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>',
        'calendar' => '<svg class="w-10 h-10 md:w-16 md:h-16 mx-auto" viewBox="0 0 24 24"><path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2z"/></svg>',
        'paw' => '<svg class="w-10 h-10 md:w-16 md:h-16 mx-auto" viewBox="-2 -2 24 24" fill="none"><path d="M5.72421 7.29064C5.72421 5.65793 4.44244 4.33398 2.86182 4.33398C1.2812 4.33398 0 5.65793 0 7.29064C0 8.92451 1.28092 10.2479 2.86182 10.2479C4.44273 10.2479 5.72421 8.92451 5.72421 7.29064Z" fill="#3B82F6"/> <path d="M17.1379 4.91162C15.5576 4.91162 14.2761 6.23557 14.2761 7.86827C14.2761 9.50214 15.5576 10.8249 17.1379 10.8249C18.7186 10.8249 20.0001 9.50214 20.0001 7.86827C20.0001 6.23557 18.7188 4.91162 17.1379 4.91162Z" fill="#3B82F6"/><path d="M14.5385 11.1595C14.3396 10.9061 14.0579 10.6128 13.7345 10.3052C12.8715 9.14977 11.5218 8.40222 10.0001 8.40222C8.64583 8.40222 7.42841 8.99466 6.56797 9.93871C6.07919 10.3781 5.6446 10.807 5.36804 11.1597L5.18292 11.3933C4.31937 12.4811 3.24446 13.8345 3.25236 16.131C3.25998 18.2638 4.94107 20 6.99946 20C8.17512 20 9.25257 19.4384 9.95328 18.4958C10.6534 19.4384 11.7312 20 12.9079 20C14.9655 20 16.6463 18.264 16.6542 16.131C16.6621 13.8345 15.5869 12.4811 14.7236 11.3933L14.5385 11.1595Z" fill="#3B82F6"/><path d="M10.1985 6.51624C11.9402 6.51624 13.3522 5.05753 13.3522 3.25812C13.3522 1.45871 11.9402 0 10.1985 0C8.45685 0 7.04492 1.45871 7.04492 3.25812C7.04492 5.05753 8.45685 6.51624 10.1985 6.51624Z" fill="#3B82F6"/></svg>',
    ];

    $colorClass = $colors[$color] ?? $colors['orange'];
    $iconSvg = $icons[$icon_name] ?? $icons['heart'];
@endphp

<div class="{{ $colorClass['bg'] }} border-2 {{ $colorClass['border'] }} rounded-2xl p-6 md:p-8 text-center space-y-3 hover:shadow transition-shadow">
    {{-- Icon (directement colorée) --}}
    <div class="{{ $colorClass['icon'] }}">
        {!! $iconSvg !!}
    </div>

    {{-- Number --}}
    <p class="text-4xl md:text-5xl font-bold {{ $colorClass['text'] }}">
        {{ $number }}
    </p>

    {{-- Label --}}
    <p class="text-sm md:text-base text-grayscale-text-subtle font-medium">
        {{ $label }}
    </p>
</div>
