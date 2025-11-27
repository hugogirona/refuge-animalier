@props([
    'name',
    'email',
    'isNew' => false,
    'status' => 'new', // new, pending, approved, rejected
    'href' => '#'
])

@php
    $statusConfig = [
        'new' => [
            'bg' => 'bg-orange-50 border-orange-200',
            'badge' => 'bg-orange-500',
            'label' => 'Nouvelle',
            'button_variant' => 'primary',

        ],
        'pending' => [
            'bg' => 'bg-blue-50 border-blue-200',
            'badge' => 'bg-blue-500',
            'label' => 'En cours',
            'button_variant' => 'secondary',

        ],
        'approved' => [
            'bg' => 'bg-green-50 border-green-200',
            'badge' => 'bg-green-500',
            'label' => 'Approuvée',
            'button_variant' => 'secondary',
        ],
        'rejected' => [
            'bg' => 'bg-gray-50 border-gray-200',
            'badge' => 'bg-gray-500',
            'label' => 'Refusée',
            'button_variant' => 'ghost',
        ],
    ];

    $config = $statusConfig[$status] ?? $statusConfig['new'];
@endphp

<article class="{{ $config['bg'] }} border rounded-lg p-4">
    {{-- Badge statut --}}
    @if($isNew || $status === 'new')
        <span class="inline-flex items-center gap-1 {{ $config['badge'] }} text-white text-sm font-medium px-3 py-1 rounded-full mb-4">
            <span class="w-2 h-2 bg-white rounded-full"></span>
            {{ $config['label'] }}
        </span>
    @else
        <span class="inline-flex items-center {{ $config['badge'] }} text-white text-sm font-medium px-3 py-1 rounded-full mb-4">
            {{ $config['label'] }}
        </span>
    @endif

    {{-- Info adoptant --}}
    <div class="mb-4">
        <h3 class="font-semibold text-grayscale-text-title mb-1">{{ $name }}</h3>
        <p class="text-sm text-grayscale-text-subtitle">{{ $email }}</p>
    </div>

    {{-- CTA --}}
    <x-cta-button
        :href="$href"
        :variant="$config['button_variant']"
        class="w-full"
        size="sm"
    >
        Voir le dossier
    </x-cta-button>
</article>
