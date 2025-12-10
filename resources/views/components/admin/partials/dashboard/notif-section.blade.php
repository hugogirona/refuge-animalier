@props([
    'title' => 'Notifications',
])

@php
    $notifications = [
            [
                'title' => 'Nouvelles demandes d\'adoption',
                'description' => '3 nouvelles demandes à traiter',
                'linkText' => 'Voir les demandes',
                'linkHref' => route('adoptions.index'),
                'count' => 3,
                'color' => 'primary',
            ],
            [
                'title' => 'Fiches en attente de validation',
                'description' => '2 fiches en attente de validation',
                'linkText' => 'Voir les fiches',
                'linkHref' => route('admin-pets.index', ['filter' => 'pending']),
                'count' => 2,
                'color' => 'secondary',
            ],
            [
                'title' => 'Nouveaux messages',
                'description' => '2 messages via le formulaire de contact',
                'linkText' => 'Voir les messages',
                'linkHref' => route('messages.index'),
                'count' => 3,
                'color' => 'success',
            ],
            [
                'title' => 'Tâches non clôturées',
                'description' => '1 tâche nécessite votre attention',
                'linkText' => 'Voir les tâches',
                'linkHref' => '#',
                'count' => 1,
                'color' => 'error',
            ],
        ];
@endphp

<section class="my-8 px-5 md:px-6">
    <h2 class="text-2xl font-bold mb-6">{{ $title }}</h2>

    <div class="grid lg:grid-cols-2 gap-4">
        @foreach($notifications as $notification)
            <x-admin.partials.dashboard.notif-card
                :title="$notification['title']"
                :description="$notification['description']"
                :linkText="$notification['linkText']"
                :linkHref="$notification['linkHref']"
                :count="$notification['count'] ?? null"
                :color="$notification['color'] ?? 'primary'"
            />
        @endforeach
    </div>
</section>

