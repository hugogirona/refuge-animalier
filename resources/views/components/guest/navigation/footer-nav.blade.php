<nav class="text-center lg:text-left lg:order-first">
    <h2 class="text-xl md:text-2xl font-bold mb-6 !text-grayscale-text-disabled">Navigation </h2>
    <ul class="flex flex-col items-center space-y-3 text-center lg:items-start">
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
                href="{{ route('pets.index') }}"
                :active="request()->routeIs('pets.index')"
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
