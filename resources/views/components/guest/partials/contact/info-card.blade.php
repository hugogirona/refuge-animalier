@props([
    'icon',
    'title',
    'link_title',
    'lines' => [],
    'linkText' => null,
    'href' => '#',
    'external' => false,
])

@php
    use App\Enums\IconType;

    $iconEnum = IconType::tryFrom($icon);
    $bgClass = $iconEnum?->bg() ?? 'bg-gray-50';
    $textClass = $iconEnum?->text() ?? 'text-gray-500';
    $svgContent = $iconEnum?->svg() ?? '';

    $linkColor = match($icon) {
        'home' => 'text-primary-text-link-light',
        'phone' => 'text-secondary-text-link-light',
        'email' => 'text-success-text-link-light',
        default => 'text-primary-500',
    };
@endphp

<section class="relative bg-white rounded-xl border border-neutral-200 p-6 hover:shadow transition-all group">

    <a
        href="{{ $href }}"
        @if($external) target="_blank" rel="noopener noreferrer" @endif
        class="absolute inset-0 z-10"
        aria-label="{{ $title }}"
        title="{{ $link_title }}"
    >
        <span class="sr-only">{{ $title }}</span>
    </a>


    <div class="flex items-start gap-4 relative z-0">

        <div class="w-12 h-12 {{ $bgClass }} rounded-lg flex items-center justify-center flex-shrink-0">
            <div class="{{ $textClass }}">
                {!! $svgContent !!}
            </div>
        </div>


        <div class="flex-1">
            <h2 class="font-semibold text-lg text-grayscale-text-body mb-1">{{ $title }}</h2>

            @foreach($lines as $line)
                <p class="text-neutral-600">{{ $line }}</p>
            @endforeach

            @if($linkText)
                <p class="{{ $linkColor }} text-sm mt-2 flex items-center gap-1 group-hover:underline">
                    {{ $linkText }}
                    @if($external)
                        <svg class="w-4 h-4 fill-none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    @endif
                </p>
            @endif
        </div>
    </div>
</section>
