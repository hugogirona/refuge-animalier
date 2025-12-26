@php
    $user = auth()->user();
    $isAdmin = $user && $user->isAdmin();

    $navItems = [];

    if ($isAdmin) {
        $navItems[] = [
            'id' => 'shelter-info',
            'label' => 'Coordonnées du refuge',
            'href' => '#shelter-info',
        ];
    }

    $navItems[] = [
        'id' => 'my-profile',
        'label' => 'Mon profil',
        'href' => '#my-profile',
    ];

    if ($isAdmin) {
        $navItems[] = [
            'id' => 'notifications',
            'label' => 'Notifications du refuge',
            'href' => '#notifications',
        ];
    }

    $navItems[] = [
        'id' => 'security',
        'label' => 'Sécurité',
        'href' => '#security',
    ];
@endphp

<nav
    class="bg-white rounded-xl border border-neutral-200 p-6 lg:sticky lg:top-6"
    aria-label="Navigation des paramètres"
>
    <h2 class="text-lg font-bold mb-4">Sur cette page</h2>

    <ul class="space-y-2">
        @foreach($navItems as $item)
            <li>
                <a
                    href="{{ $item['href'] }}"
                    class="block px-4 py-2 rounded-lg text-grayscale-text-subtitle hover:text-primary-text-link-light transition-colors"
                >
                    {{ $item['label'] }}
                </a>
            </li>
        @endforeach
    </ul>
</nav>
