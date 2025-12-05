<section class="faq-section py-16 md:py-24 bg-grayscale-negative">
    <div class="container max-w-6xl mx-auto px-5 md:px-8 flex justify-center">
        <div class="max-w-4xl flex flex-col items-center justify-center">

            <div class="mb-6 space-y-2 text-center">
                <h2 class="text-2xl font-semibold">
                    {{ __('guest/home.faq.title') }}
                </h2>

                <p class="text-lg text-grayscale-text-subtle font-light">
                    {{ __('guest/home.faq.subtitle') }}
                </p>
            </div>

            <x-cta-button
                href="{{ route('contact') }}#faq-section"
            >
                {{ __('guest/home.faq.button_text') }}
            </x-cta-button>

        </div>
    </div>
</section>
