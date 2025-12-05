<nav class="hidden md:flex gap-4" aria-label="{{ __('guest/navigation.aria_labels.main_menu') }}">
    <ul class="flex items-center space-x-1 lg:space-x-2">
        <li>
            <x-guest.navigation.nav-link
                href="{{ route('home') }}"
                :active="request()->routeIs('home')"
                :title="__('guest/navigation.titles.home')"
            >
                {{ __('guest/navigation.menu.home') }}
            </x-guest.navigation.nav-link>
        </li>
        <li>
            <x-guest.navigation.nav-link
                href="{{ route('pets.index') }}"
                :title="__('guest/navigation.titles.pets')"
                :active="request()->routeIs('pets.index')"
            >
                {{ __('guest/navigation.menu.pets') }}
            </x-guest.navigation.nav-link>
        </li>
        <li>
            <x-guest.navigation.nav-link
                href="{{ route('about') }}"
                :active="request()->routeIs('about')"
                :title="__('guest/navigation.titles.about')"
            >
                {{ __('guest/navigation.menu.about') }}
            </x-guest.navigation.nav-link>
        </li>
    </ul>
    <x-cta-button
        size="sm"
        href="{{ route('contact') }}"
        :title="__('guest/navigation.titles.contact')"
    >
        {{ __('guest/navigation.menu.contact') }}
    </x-cta-button>
</nav>
