@props([
    'title',
    'subtitle' => null,
    'buttonLabel' => null,
    'buttonHref' => null,
    'buttonVariant' => 'primary',
    'buttonIcon' => null,
    'badgeStatus' => null,
    'badgeType' => 'secondary'

])

<div {{ $attributes->merge(['class' => 'max-w-7xl m-auto px-5 py-4 md:px-6 flex items-center gap-4 justify-between flex-wrap']) }}>

    {{-- Title + Subtitle --}}
    <div class="flex flex-col gap-2 grow">
        <h1 class="text-2xl md:text-3xl font-semibold">{{ $title }}</h1>
        <div class="flex justify-start gap-2">
            @if($subtitle)
                <p class="text-grayscale-text-subtitle">{{ $subtitle }}</p>
            @endif
            @if($badgeStatus)
                <x-admin.status-badge status="{{ $badgeStatus }}" type="{{ $badgeType }}"/>
            @endif
        </div>
    </div>

    @if($buttonLabel && $buttonHref)
        <div>
            <x-cta-button
                :href="$buttonHref"
                :variant="$buttonVariant"
                :icon="$buttonIcon"
            >
                {{ $buttonLabel }}
            </x-cta-button>
        </div>
    @endif

</div>
