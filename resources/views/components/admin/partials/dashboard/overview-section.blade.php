@props([
    'title' => 'Vue d\'ensemble',
])
@php
    $kpis = [
            [
                'icon' => 'paw',
                'value' => 23,
                'label' => 'Animaux au refuge',
                'trend' => '+2',
                'trendLabel' => 'cette semaine',
            ],
            [
                'icon' => 'sheet',
                'value' => 5,
                'label' => 'Demandes en cours',
            ],
            [
                'icon' => 'people',
                'value' => 12,
                'label' => 'Bénévoles actifs',
                'trendLabel' => 'Ce mois',
            ],
            [
                'icon' => 'heart',
                'value' => 8,
                'label' => 'Adoptions ce mois',
                'trend' => '+2',
                'trendLabel' => 'mois dernier',
            ],
        ];

@endphp

<section class="my-8 px-5 md:px-6">
    <h2 class="text-2xl font-bold mb-6">{{ $title }}</h2>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach($kpis as $kpi)
            <x-admin.partials.dashboard.kpi-card
                :icon="$kpi['icon']"
                :value="$kpi['value']"
                :label="$kpi['label']"
                :trend="$kpi['trend'] ?? null"
                :trendLabel="$kpi['trendLabel'] ?? null"
            />
        @endforeach
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-4">
        <x-admin.partials.dashboard.chart-card title="Évolution des adoptions" chartId="adoptGraph" showPeriodSelector/>
        <x-admin.partials.dashboard.chart-card title="Répartition par espèce" chartId="speciesGraph"/>
    </div>
</section>
