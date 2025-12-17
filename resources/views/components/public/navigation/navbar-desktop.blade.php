<nav class="hidden md:flex gap-4" aria-label="{{ __('public/navigation.aria_labels.main_menu') }}">
    <ul class="flex items-center space-x-1 lg:space-x-2">
        <li>
            <x-public.navigation.nav-link
                href="{{ route('home') }}"
                :active="request()->routeIs('home')"
                :title="__('public/navigation.titles.home')"
            >
                {{ __('public/navigation.menu.home') }}
            </x-public.navigation.nav-link>
        </li>
        <li>
            <x-public.navigation.nav-link
                href="{{ route('pets.index') }}"
                :title="__('public/navigation.titles.pets')"
                :active="request()->routeIs('pets.index')"
            >
                {{ __('public/navigation.menu.pets') }}
            </x-public.navigation.nav-link>
        </li>
        <li>
            <x-public.navigation.nav-link
                href="{{ route('about') }}"
                :active="request()->routeIs('about')"
                :title="__('public/navigation.titles.about')"
            >
                {{ __('public/navigation.menu.about') }}
            </x-public.navigation.nav-link>
        </li>
    </ul>
    <x-cta-button
        size="sm"
        href="{{ route('contact.create') }}"
        :title="__('public/navigation.titles.contact')"
    >
        {{ __('public/navigation.menu.contact') }}
    </x-cta-button>
</nav>
