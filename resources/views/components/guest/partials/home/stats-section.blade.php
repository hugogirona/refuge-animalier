@props(['stats'])

<section class="stats-section py-16 bg-white">
    <div class="mx-auto px-5 max-w-6xl md:px-8">

        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                {{ __('guest/home.stats.title') }}
            </h2>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            @foreach($stats as $stat)
                <x-guest.partials.home.stat-card
                    :number="$stat['number']"
                    :label="__($stat['label'])"
                    :color="$stat['color']"
                    :icon_name="$stat['icon']"
                />
            @endforeach
        </div>
    </div>
</section>
