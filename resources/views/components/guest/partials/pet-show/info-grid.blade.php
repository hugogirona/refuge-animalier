@props(['items' => []])

<div class="grid grid-cols-2 gap-4">
    @foreach($items as $item)
        <x-guest.partials.pet-show.info-item
            :icon="$item['icon'] ?? 'paw'"
            :label="$item['label']"
            :value="$item['value']"
        />
    @endforeach
</div>

