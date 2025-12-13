<nav class="text-center lg:text-left lg:order-first">
    <h2 class="text-xl md:text-2xl font-bold mb-6 text-grayscale-text-disabled!">
        {{ __('public/footer.navigation.title') }}
    </h2>
    <ul class="flex flex-col items-center space-y-3 text-center lg:items-start">
        <li>
            <x-public.navigation.footer-link
                href="{{ route('home') }}"
                :active="request()->routeIs('home')"
                :title="__('public/footer.titles.home')"
            >
                {{ __('public/footer.navigation.home') }}
            </x-public.navigation.footer-link>
        </li>
        <li>
            <x-public.navigation.footer-link
                href="{{ route('pets.index') }}"
                :active="request()->routeIs('pets.index')"
                :title="__('public/footer.titles.pets')"
            >
                {{ __('public/footer.navigation.pets') }}
            </x-public.navigation.footer-link>
        </li>
        <li>
            <x-public.navigation.footer-link
                href="{{ route('about') }}"
                :active="request()->routeIs('about')"
                :title="__('public/footer.titles.about')"
            >
                {{ __('public/footer.navigation.about') }}
            </x-public.navigation.footer-link>
        </li>
        <li>
            <x-public.navigation.footer-link
                href="{{ route('contact') }}"
                :active="request()->routeIs('contact')"
                :title="__('public/footer.titles.contact')"
            >
                {{ __('public/footer.navigation.contact') }}
            </x-public.navigation.footer-link>
        </li>
    </ul>
</nav>
