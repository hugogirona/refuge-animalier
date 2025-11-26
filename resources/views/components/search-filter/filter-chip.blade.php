@props([
    'filters' => [
        ['id' => 'all', 'label' => 'Tous', 'count' => 23],
        ['id' => 'chien', 'label' => 'Chiens', 'count' => 12],
        ['id' => 'chat', 'label' => 'Chats', 'count' => 9],
        ['id' => 'lapin', 'label' => 'Lapins', 'count' => 2],
    ],
    'name' => 'filters'
])

<div {{ $attributes->merge(['class' => 'flex justify-start gap-2 overflow-x-auto hide-scrollbar']) }}>
    @foreach($filters as $filter)
        <label
            @class([
                'filter-chip flex-shrink-0 px-4 py-2 rounded-full border-2 text-sm font-medium transition-colors cursor-pointer',
                'border-neutral-300 bg-white text-neutral-700 hover:border-amber-500 hover:text-amber-500',
            ])
        >
            <input
                type="checkbox"
                name="{{ $name }}[]"
                value="{{ $filter['id'] }}"
                class="hidden filter-checkbox"
                data-filter="{{ $filter['id'] }}"
                {{ $filter['id'] === 'all' ? 'checked' : '' }}
            >
            <span class="filter-label">
                {{ $filter['label'] }}
                @if(isset($filter['count']))
                    <span class="ml-1">({{ $filter['count'] }})</span>
                @endif
            </span>
        </label>
    @endforeach
</div>
