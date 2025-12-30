@props([
    'filters' => [],
    'name' => 'species',
    'current' => ''
])

<div {{ $attributes->merge(['class' => 'flex justify-start gap-2 overflow-x-auto hide-scrollbar']) }}>
    @foreach($filters as $filter)
        <label class="relative shrink-0 cursor-pointer group">
            <input
                type="radio"
                name="{{ $name }}"
                value="{{ $filter['id'] }}"
                class="peer sr-only"
                x-on:change.debounce.300ms="$el.form.submit()"
                {{ (string)$current === (string)$filter['id'] ? 'checked' : '' }}
            >
            <span class="block px-4 py-2 rounded-full border-2 text-sm font-medium transition-all duration-200
                         bg-white border-neutral-200 text-neutral-600
                         group-hover:border-primary-surface-default-light group-hover:text-primary-text-link-light
                         peer-checked:bg-primary-surface-default-light
                         peer-checked:border-primary-surface-default-light
                         peer-checked:text-white">
                {{ $filter['label'] }}

                @if(isset($filter['count']))
                    <span class="ml-1 text-xs opacity-70 group-hover:opacity-100 peer-checked:text-white peer-checked:opacity-100">
                        ({{ $filter['count'] }})
                    </span>
                @endif
            </span>
        </label>
    @endforeach
</div>
