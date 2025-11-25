@props([
    'title' => 'Activités récentes',
    'activities' => [],
    'viewAllLink' => null,
])

@php
    $activities = [
            [
                'user' => 'Thomas',
                'action' => 'a créé la fiche de',
                'target' => 'Moka',
                'time' => 'Il y a 2 jours',
                'link' => route('admin-pets.show'),
            ],
            [
                'user' => 'Thomas',
                'action' => 'a créé la fiche de',
                'target' => 'Moka',
                'time' => 'Il y a 2 jours',
                'link' => route('admin-pets.show'),
            ],
            [
                'user' => 'Thomas',
                'action' => 'a créé la fiche de',
                'target' => 'Moka',
                'time' => 'Il y a 2 jours',
                'link' => route('admin-pets.show'),
            ],
            [
                'user' => 'Thomas',
                'action' => 'a créé la fiche de',
                'target' => 'Moka',
                'time' => 'Il y a 2 jours',
                'link' => route('admin-pets.show'),
            ],
        ];
@endphp

<section>
    {{-- Header --}}
        <h2 class="text-2xl font-semibold text-neutral-900 mb-6">{{ $title }}</h2>

    {{-- Activities List --}}
    <div class="divide-y divide-neutral-100 bg-white rounded-xl border border-neutral-200 p-6">
        @forelse($activities as $activity)
            <x-admin.dashboard.activity-item
                :user="$activity['user']"
                :action="$activity['action']"
                :target="$activity['target']"
                :time="$activity['time']"
                :link="$activity['link'] ?? null"
            />
        @empty
            <p class="text-sm

 text-neutral-500 py-4 text-center">Aucune activité récente</p>
        @endforelse
    </div>
</section>
