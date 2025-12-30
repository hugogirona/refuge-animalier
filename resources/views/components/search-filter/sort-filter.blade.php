@props([
    'name',
    'label' => '',
    'options' => [],
    'selected' => '',
    'autoSubmit' => true
])

<div class="relative w-full sm:w-auto min-w-[180px]">
    <select
        name="{{ $name }}"
        @if($autoSubmit)  x-on:change.debounce.300ms="$el.form.submit()"  @endif
        class="w-full pl-4 pr-10 py-2 border border-neutral-300 rounded-lg appearance-none bg-white text-sm text-neutral-700 font-medium cursor-pointer focus:border-primary-border-default transition-colors"
    >
        {{-- Option par défaut (vide) --}}
        <option value="">{{ $label ?: 'Sélectionner...' }}</option>

        @foreach($options as $value => $optionLabel)
            <option value="{{ $value }}" {{ (string)$selected === (string)$value ? 'selected' : '' }}>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>

    {{-- Icône Chevron --}}
    <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-neutral-500 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
    </svg>
</div>
