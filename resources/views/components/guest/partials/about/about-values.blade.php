@props([
    'section_title' => null,
    'section_subtitle' => null,
    'values' => [],
])

@php
    $values = [
        [
            'icon' => 'heart',
            'title' => __('guest/about.values.animal_welfare.title'),
            'description' => __('guest/about.values.animal_welfare.description'),
        ],
        [
            'icon' => 'people',
            'title' => __('guest/about.values.responsible_adoption.title'),
            'description' => __('guest/about.values.responsible_adoption.description'),
        ],
        [
            'icon' => 'check',
            'title' => __('guest/about.values.transparency.title'),
            'description' => __('guest/about.values.transparency.description'),
        ],
        [
            'icon' => 'medicine',
            'title' => __('guest/about.values.professionalism.title'),
            'description' => __('guest/about.values.professionalism.description'),
        ],
        [
            'icon' => 'home',
            'title' => __('guest/about.values.local_commitment.title'),
            'description' => __('guest/about.values.local_commitment.description'),
        ],
        [
            'icon' => 'paw',
            'title' => __('guest/about.values.kindness.title'),
            'description' => __('guest/about.values.kindness.description'),
        ],
    ];
@endphp

<section class="py-16 md:py-20 bg-neutral-50">
    <div class="container mx-auto px-5 md:px-8 max-w-6xl">

        {{-- Section Header --}}
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                {{ $section_title ?? __('guest/about.values.section_title') }}
            </h2>
            <p class="text-lg text-grayscale-text-subtitle max-w-2xl mx-auto">
                {{ $section_subtitle ?? __('guest/about.values.section_subtitle') }}
            </p>
        </div>

        {{-- Values Grid --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($values as $value)
                <x-guest.partials.about.value-card
                    :icon="$value['icon']"
                    :title="$value['title']"
                    :description="$value['description']"
                />
            @endforeach
        </div>

    </div>
</section>
