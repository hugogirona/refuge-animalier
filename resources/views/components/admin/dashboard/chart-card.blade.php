@props([
    'title',
    'chartId',
    'height' => 'h-64',
    'showPeriodSelector' => false,
])

<article class="bg-white rounded-xl border border-neutral-200 p-6">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold">{{ $title }}</h3>

        @if($showPeriodSelector)
            <select class="px-3 py-1.5 text-sm border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-surface-default-light">
                <option>6 derniers mois</option>
                <option>1 an</option>
                <option>Tout</option>
            </select>
        @endif
    </div>

    {{-- Chart Canvas --}}
    <div class="{{ $height }}">
        <canvas class="" id="{{ $chartId }}"></canvas>
    </div>
</article>
