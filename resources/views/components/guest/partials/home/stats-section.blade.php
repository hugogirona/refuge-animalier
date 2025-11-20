@props(['stats'])

<section class="stats-section py-16 bg-white">
    <div class="container mx-auto px-5 max-w-6xl md:px-8">

        <div class="text-center mb-12">
            <h2 class="text-2xl font-semibold">
                Notre impact
            </h2>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            @foreach($stats as $stat)
                <x-guest.partials.home.stat-card
                    :number="$stat['number']"
                    :label="$stat['label']"
                    :color="$stat['color']"
                    :icon_name="$stat['icon']"
                />
            @endforeach
        </div>
    </div>
</section>
