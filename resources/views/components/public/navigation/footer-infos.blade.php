@props(['shelter'])

<section class="text-center lg:text-left">
    <h2 class="text-xl md:text-2xl font-bold mb-6 text-grayscale-text-disabled!">
        {{ __('public/footer.information.title') }}
    </h2>

    <ul class="space-y-4 text-neutral-300 flex flex-col items-center lg:items-start">

        @if($shelter)
            <x-public.navigation.footer-info icon="location">
                {{ $shelter->address }}, {{ $shelter->zip_code }} {{ $shelter->city }}
            </x-public.navigation.footer-info>

            @if($shelter->phone)
                <x-public.navigation.footer-info
                    icon="phone"
                    href="tel:{{ str_replace(' ', '', $shelter->phone) }}"
                    type="tel"
                    title="Téléphoner au {{ $shelter->phone }}"
                >
                    {{ $shelter->phone }}
                </x-public.navigation.footer-info>
            @endif

            @if($shelter->email)
                <x-public.navigation.footer-info
                    icon="email"
                    href="mailto:{{ $shelter->email }}"
                    type="email"
                    title="Envoyer un mail à {{ $shelter->email }}"
                >
                    {{ $shelter->email }}
                </x-public.navigation.footer-info>
            @endif
        @endif

        <x-public.navigation.footer-info icon="clock">
            Lun-Ven: 9h-17h | Sam 10h-16h
        </x-public.navigation.footer-info>

    </ul>
</section>
