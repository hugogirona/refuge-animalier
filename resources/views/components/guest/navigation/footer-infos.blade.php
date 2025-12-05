<section class="text-center lg:text-left">
    <h2 class="text-xl md:text-2xl font-bold mb-6 !text-grayscale-text-disabled">{{ __('guest/footer.information.title') }}</h2>
    <ul class="space-y-4 text-neutral-300 flex flex-col items-center lg:items-start">

        <x-guest.navigation.footer-info icon="location">
            123 rue des animaux, 1000 Bruxelles
        </x-guest.navigation.footer-info>

        <x-guest.navigation.footer-info icon="phone" href="tel:+3221234567" type="tel" title="Téléphoner au +32 2 123 45 67">
            +32 2 123 45 67
        </x-guest.navigation.footer-info>

        <x-guest.navigation.footer-info icon="email" href="mailto:contact@pattesheureuses.be" type="email" title="Envoyer un mail à l'adresse contact@pattesheureuses.be">
            contact@pattesheureuses.be
        </x-guest.navigation.footer-info>

        <x-guest.navigation.footer-info icon="clock">
            Lun-Ven: 9h-17h | Sam 10h-16h
        </x-guest.navigation.footer-info>

    </ul>
</section>
