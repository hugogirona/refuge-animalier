@props([
    'petPhoto',
    'petName',
    'petBreed',
    'adopterName',
    'adopterEmail',
    'requestDate',
    'status', // 'new', 'pending', 'refused', 'accepted'
    'lastAction',
    'linkUrl'
])

@php
    $statusConfig = [
        'new' => [
            'label' => 'Nouvelle',
            'badgeType' => 'primary',
            'borderColor' => 'border-primary-border-default',
            'buttonVariant' => 'primary'
        ],
        'pending' => [
            'label' => 'En cours',
            'badgeType' => 'secondary',
            'borderColor' => 'border-neutral-200',
            'buttonVariant' => 'secondary'
        ],
        'refused' => [
            'label' => 'Refusée',
            'badgeType' => 'error',
            'borderColor' => 'border-neutral-200',
            'buttonVariant' => 'ghost'
        ],
        'accepted' => [
            'label' => 'Acceptée',
            'badgeType' => 'success',
            'borderColor' => 'border-neutral-200',
            'buttonVariant' => 'secondary'
        ],
    ];

    $config = $statusConfig[$status] ?? $statusConfig['pending'];
@endphp

<article class="bg-white rounded-2xl border-1 {{ $config['borderColor'] }}  transition-all hover:shadow overflow-hidden">
    {{-- Header: Status Badge + Date --}}
    <div class="flex items-center justify-between py-2 px-6 bg-neutral-50">
        <x-admin.status-badge
            :status="$config['label']"
            :type="$config['badgeType']"
        />
        <span class="text-sm text-grayscale-text-subtitle">{{ $requestDate }}</span>
    </div>

    <div class="p-6">

    {{-- Pet Info --}}
    <div class="flex items-center gap-4 mb-6">
        <img
            src="{{ $petPhoto }}"
            alt="{{ $petName }}"
            class="w-14 h-14 rounded-xl object-cover"
        >
        <div>
            <h3 class="text-lg font-bold text-grayscale-text-title">{{ $petName }}</h3>
            <p class="text-sm text-grayscale-text-subtitle">{{ $petBreed }}</p>
        </div>
    </div>

    {{-- Adopter Info --}}
    <div class="mb-4">
        <p class="text-xs text-grayscale-text-subtitle mb-1">Adoptant</p>
        <p class="text-base font-bold text-grayscale-text-title">{{ $adopterName }}</p>
        <p class="text-sm text-grayscale-text-subtitle">{{ $adopterEmail }}</p>
    </div>

    {{-- Last Action --}}
    <div class="mb-6">
        <p class="text-sm text-grayscale-text-subtitle">Dernière action : {{ $lastAction }}</p>
    </div>

    {{-- CTA Button --}}
    <x-cta-button
        :href="$linkUrl"
        :variant="$config['buttonVariant']"
        size="sm"
        class="w-full"
    >
        Voir le dossier
    </x-cta-button>

    </div>
</article>
