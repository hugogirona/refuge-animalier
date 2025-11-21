
@props([
    'icon' => 'clock',
    'title' => 'Horaires d\'ouverture',
    'schedule' => [],
    'note' => '* Visite sur rendez-vous uniquement',
])

@php
    use App\Enums\IconType;

    $iconEnum = IconType::tryFrom($icon);
    $bgClass = $iconEnum?->bg() ?? 'bg-purple-50';
    $textClass = $iconEnum?->text() ?? 'text-purple-500';
    $svgContent = $iconEnum?->svg() ?? '';
@endphp

<div class="bg-white rounded-xl border border-neutral-200 p-6">
    <section class="flex items-start gap-4">
        {{-- Icon --}}
        <div class="w-12 h-12 {{ $bgClass }} rounded-lg flex items-center justify-center flex-shrink-0">
            <div class="{{ $textClass }}">
                {!! $svgContent !!}
            </div>
        </div>

        {{-- Content --}}
        <div class="flex-1">
            <h2 class="font-semibold text-lg text-neutral-900 mb-3">{{ $title }}</h2>

            <div class="space-y-2 text-sm">
                @foreach($schedule as $day => $hours)
                    <div class="flex justify-between">
                        <span class="text-neutral-600">{{ $day }}</span>
                        <span class="font-medium {{ $hours === 'Fermé' ? 'text-red-500' : 'text-neutral-900' }}">
                            {{ $hours }}
                        </span>
                    </div>
                @endforeach
            </div>

            @if($note)
                <p class="text-xs text-neutral-500 mt-3">
                    {{ $note }}
                </p>
            @endif
        </div>
    </section>
</div>

