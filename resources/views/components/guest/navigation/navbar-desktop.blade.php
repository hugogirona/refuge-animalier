<nav class="hidden md:flex gap-4" aria-label="Menu de navigation">
    <ul class="flex items-center space-x-1 lg:space-x-2">
        <li>
            <x-guest.navigation.nav-link
                href="/"
                :active="request()->routeIs('home')"
            >
                Accueil
            </x-guest.navigation.nav-link>
        </li>
        <li>
            <x-guest.navigation.nav-link
                href="/pets"
                :active="request()->routeIs('pets.index')"
            >
                Nos animaux
            </x-guest.navigation.nav-link>
        </li>
        <li>
            <x-guest.navigation.nav-link
                href="/about"
                :active="request()->routeIs('about')"
            >
                À propos
            </x-guest.navigation.nav-link>
        </li>
    </ul>
    <x-cta-button size="sm">
        Nous contacter
    </x-cta-button>
</nav>
