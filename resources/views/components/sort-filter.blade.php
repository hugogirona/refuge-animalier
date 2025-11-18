@props([
    'sortOptions' => [
        ['value' => 'recent', 'label' => 'Plus récents'],
        ['value' => 'oldest', 'label' => 'Plus anciens'],
        ['value' => 'name_asc', 'label' => 'Nom (A-Z)'],
        ['value' => 'name_desc', 'label' => 'Nom (Z-A)'],
        ['value' => 'age_asc', 'label' => 'Âge ▲'],
        ['value' => 'age_desc', 'label' => 'Âge ▼'],
    ],
    'selectedSort' => 'recent',
    'showFilterButton' => true,
    'filterButtonText' => 'Filtres'
])

<div {{ $attributes->merge(['class' => 'flex items-center gap-2']) }}>
    <!-- Sort Dropdown -->
    <div class="relative flex-1">
        <select
            name="sort"
            class="w-full px-4 py-2 pr-10 border border-neutral-300 rounded-lg appearance-none bg-white text-sm cursor-pointer transition-colors"
        >
            @foreach($sortOptions as $option)
                <option value="{{ $option['value'] }}" {{ $selectedSort === $option['value'] ? 'selected' : '' }}>
                    Trier par: {{ $option['label'] }}
                </option>
            @endforeach
        </select>
        <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-neutral-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </div>

    <!-- Advanced Filters Button -->
    @if($showFilterButton)
        <button
            type="button"
            class="flex-shrink-0 px-4 py-2 border border-amber-500 text-amber-500 rounded-lg font-medium hover:bg-amber-50 transition-colors flex items-center gap-2"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
            </svg>
            <span class="hidden sm:inline">{{ $filterButtonText }}</span>
        </button>
    @endif
</div>
