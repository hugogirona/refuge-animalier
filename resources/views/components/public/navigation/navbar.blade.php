<nav class="mt-12 space-y-2" aria-label="{{ __('public/navigation.aria_labels.mobile_menu') }}">
    <ul>
        <li>
            <x-public.navigation.nav-link
                href="{{ route('home') }}"
                :active="request()->routeIs('home')"
                :title="__('public/navigation.titles.home')"
                mobile
            >
                {{ __('public/navigation.menu.home') }}
            </x-public.navigation.nav-link>
        </li>
        <li>
            <x-public.navigation.nav-link
                href="{{ route('pets.index') }}"
                :active="request()->routeIs('pets.index')"
                :title="__('public/navigation.titles.pets')"
                mobile
            >
                {{ __('public/navigation.menu.pets') }}
            </x-public.navigation.nav-link>
        </li>
        <li>
            <x-public.navigation.nav-link
                href="{{ route('about') }}"
                :active="request()->routeIs('about')"
                :title="__('public/navigation.titles.about')"
                mobile
            >
                {{ __('public/navigation.menu.about') }}
            </x-public.navigation.nav-link>
        </li>
        <li>
            <x-public.navigation.nav-link
                href="{{ route('contact.create') }}"
                :active="request()->routeIs('contact')"
                :title="__('public/navigation.titles.contact')"
                mobile
            >
                {{ __('public/navigation.menu.contact') }}
            </x-public.navigation.nav-link>
        </li>
    </ul>
</nav>
