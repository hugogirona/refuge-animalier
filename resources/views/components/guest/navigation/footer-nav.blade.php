<nav>
    <h2 class="hidden">Navigation de pied de page</h2>
    <ul class="flex flex-col items-center space-y-3 text-center">
        <li>
            <x-guest.navigation.footer-link
                href="{{ route('home') }}"
                :active="request()->routeIs('home')"
            >
                Accueil
            </x-guest.navigation.footer-link>
        </li>
        <li>
            <x-guest.navigation.footer-link
                href="{{ route('animals.index') }}"
                :active="request()->routeIs('animals.*')"
            >
                Nos animaux
            </x-guest.navigation.footer-link>
        </li>
        <li>
            <x-guest.navigation.footer-link
                href="{{ route('about') }}"
                :active="request()->routeIs('about')"
            >
                À propos
            </x-guest.navigation.footer-link>
        </li>
        <li>
            <x-guest.navigation.footer-link
                href="{{ route('contact') }}"
                :active="request()->routeIs('contact')"
            >
                Contact
            </x-guest.navigation.footer-link>
        </li>
    </ul>
</nav>
