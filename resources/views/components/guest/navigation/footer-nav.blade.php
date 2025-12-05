<nav class="text-center lg:text-left lg:order-first">
    <h2 class="text-xl md:text-2xl font-bold mb-6 !text-grayscale-text-disabled">
        {{ __('guest/footer.navigation.title') }}
    </h2>
    <ul class="flex flex-col items-center space-y-3 text-center lg:items-start">
        <li>
            <x-guest.navigation.footer-link
                href="{{ route('home') }}"
                :active="request()->routeIs('home')"
                :title="__('guest/footer.titles.home')"
            >
                {{ __('guest/footer.navigation.home') }}
            </x-guest.navigation.footer-link>
        </li>
        <li>
            <x-guest.navigation.footer-link
                href="{{ route('pets.index') }}"
                :active="request()->routeIs('pets.index')"
                :title="__('guest/footer.titles.pets')"
            >
                {{ __('guest/footer.navigation.pets') }}
            </x-guest.navigation.footer-link>
        </li>
        <li>
            <x-guest.navigation.footer-link
                href="{{ route('about') }}"
                :active="request()->routeIs('about')"
                :title="__('guest/footer.titles.about')"
            >
                {{ __('guest/footer.navigation.about') }}
            </x-guest.navigation.footer-link>
        </li>
        <li>
            <x-guest.navigation.footer-link
                href="{{ route('contact') }}"
                :active="request()->routeIs('contact')"
                :title="__('guest/footer.titles.contact')"
            >
                {{ __('guest/footer.navigation.contact') }}
            </x-guest.navigation.footer-link>
        </li>
    </ul>
</nav>
