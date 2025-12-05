<nav class="mt-12 space-y-2" aria-label="{{ __('guest/navigation.aria_labels.mobile_menu') }}">
    <ul>
        <li>
            <x-guest.navigation.nav-link
                href="{{ route('home') }}"
                :active="request()->routeIs('home')"
                :title="__('guest/navigation.titles.home')"
                mobile
            >
                {{ __('guest/navigation.menu.home') }}
            </x-guest.navigation.nav-link>
        </li>
        <li>
            <x-guest.navigation.nav-link
                href="{{ route('pets.index') }}"
                :active="request()->routeIs('pets.index')"
                :title="__('guest/navigation.titles.pets')"
                mobile
            >
                {{ __('guest/navigation.menu.pets') }}
            </x-guest.navigation.nav-link>
        </li>
        <li>
            <x-guest.navigation.nav-link
                href="{{ route('about') }}"
                :active="request()->routeIs('about')"
                :title="__('guest/navigation.titles.about')"
                mobile
            >
                {{ __('guest/navigation.menu.about') }}
            </x-guest.navigation.nav-link>
        </li>
        <li>
            <x-guest.navigation.nav-link
                href="{{ route('contact') }}"
                :active="request()->routeIs('contact')"
                :title="__('guest/navigation.titles.contact')"
                mobile
            >
                {{ __('guest/navigation.menu.contact') }}
            </x-guest.navigation.nav-link>
        </li>
    </ul>
</nav>
