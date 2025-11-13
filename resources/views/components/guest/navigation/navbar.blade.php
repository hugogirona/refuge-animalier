<nav class="mt-12 space-y-2" x-data>
    <h2 class="hidden">Menu de navigation</h2>
    <ul>
        <li>
            <x-guest.navigation.nav-link
                href="/"
                :active="request()->routeIs('home')"
                mobile
            >
                Accueil
            </x-guest.navigation.nav-link>
        </li>
        <li>
            <x-guest.navigation.nav-link
                href="/animals"
                :active="request()->routeIs('animals.*')"
                mobile
            >
                Nos animaux
            </x-guest.navigation.nav-link>
        </li>
        <li>
            <x-guest.navigation.nav-link
                href="/about"
                :active="request()->routeIs('about')"
                mobile
            >
                À propos
            </x-guest.navigation.nav-link>
        </li>
        <li>
            <x-guest.navigation.nav-link
                href="/contact"
                :active="request()->routeIs('contact')"
                mobile
            >
                Contact
            </x-guest.navigation.nav-link>
        </li>
    </ul>
</nav>
