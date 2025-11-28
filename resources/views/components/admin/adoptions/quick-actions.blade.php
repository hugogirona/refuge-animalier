@props([
    'title' => 'Actions rapides',
    'actions' => []
])

<section class="flex-1">
    <div>
        <div class="flex flex-col gap-4 bg-white rounded-xl border border-neutral-200 p-6">
        <h2 class="text-xl font-bold mb-6">{{ $title }}</h2>
            @foreach($actions as $action)
                <x-cta-button
                    class="grow"
                    :href="$action['href']"
                    :variant="$action['variant'] ?? 'primary'"
                    :icon="$action['icon'] ?? null"
                >
                    {{ $action['label'] }}
                </x-cta-button>
            @endforeach
        </div>
    </div>
</section>
