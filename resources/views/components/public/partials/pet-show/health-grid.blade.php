@props(['items' => []])


<div class="grid grid-cols-1 gap-4">
    @foreach($items as $item)
        <x-public.partials.pet-show.health-item
            :icon="$item['icon'] ?? 'paw'"
            :label="$item['label']"
            :value="$item['value']"
        />
    @endforeach
</div>
