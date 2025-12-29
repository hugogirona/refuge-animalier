@props([
    'title' => 'Actions rapides',
    'actions' => []
])

<section>
    <div>
        <h2 class="text-2xl font-bold mb-6">{{ $title }}</h2>
        <div class="flex flex-col gap-4 bg-white rounded-xl border border-neutral-200 p-6">
            @foreach($actions as $action)

                @if(isset($action['action']))
                    <x-cta-button
                        class="grow"
                        role="button"
                        type="button"
                        wire:click="{{ $action['action'] }}"
                        :variant="$action['variant'] ?? 'primary'"
                        :icon="$action['icon'] ?? null"
                    >
                        {{ $action['label'] }}
                    </x-cta-button>

                @else
                    <x-cta-button
                        class="grow"
                        :href="$action['href'] ?? '#'"
                        :variant="$action['variant'] ?? 'primary'"
                        :icon="$action['icon'] ?? null"
                        wire:navigate.hover
                    >
                        {{ $action['label'] }}
                    </x-cta-button>
                @endif

            @endforeach
        </div>
    </div>
</section>
