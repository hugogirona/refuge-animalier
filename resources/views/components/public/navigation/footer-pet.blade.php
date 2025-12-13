<section class="text-center lg:text-left">
    <h2 class="text-xl md:text-2xl font-bold mb-6 text-grayscale-text-disabled!">{{ __('public/footer.latest_arrivals.title') }}</h2>
    <ul class="space-y-4 text-neutral-300 flex flex-col items-center lg:items-start">

        <x-public.navigation.footer-info  href="{{route('pets.show')}}"  title="Vers la page de Moka">
            Moka, Caniche
        </x-public.navigation.footer-info>
        <x-public.navigation.footer-info  href="{{route('pets.show')}}" title="Vers la page de Luna">
            Luna, Berger Australien
        </x-public.navigation.footer-info>
        <x-public.navigation.footer-info  href="{{route('pets.show')}}"  title="Vers la page de Rex">
            Rex, Berger Allemand
        </x-public.navigation.footer-info>


    </ul>
</section>

