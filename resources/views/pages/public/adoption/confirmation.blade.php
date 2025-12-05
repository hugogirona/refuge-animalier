@php
    $firstName = 'Sarah';
    $petName = 'Moka';
    $shelterPhone = '+32 2 123 45 67';
    $shelterEmail = 'contact@pattesheureuses.be';
@endphp

<x-layout :title="__('public/adoption.confirmation.page_title')">

    <div class="container mx-auto px-5 md:px-8 py-12 md:py-16">
        <div class="max-w-2xl mx-auto">

            <div class="text-center mb-8">

                {{-- SVG + Title --}}
                <div class="inline-flex items-center justify-center w-24 h-24 md:w-32 md:h-32 bg-success-surface-default-subtle rounded-full mb-6 animate-scale-in">
                    <svg class="w-12 h-12 md:w-16 md:h-16 text-success-text-link-light fill-none animate-check" stroke="currentColor"
                         viewBox="0 0 24 24" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>

                <h1 class="text-4xl md:text-5xl font-bold text-grayscale-text-title mb-4">
                    {{ __('public/adoption.confirmation.title') }}
                </h1>

                <p class="text-lg md:text-xl text-grayscale-text-subtitle">
                    {{ __('public/adoption.confirmation.subtitle', ['name' => $petName]) }}
                </p>
            </div>

            <div class="bg-white rounded-xl border border-neutral-200 p-6 md:p-8 mb-6 shadow-sm">
                <p class="text-neutral-700 leading-relaxed mb-6">
                    <strong>{{ __('public/adoption.confirmation.greeting', ['firstname' => $firstName]) }}</strong>
                    {!! __('public/adoption.confirmation.intro', ['petname' => '<strong>' . $petName . '</strong>']) !!}
                </p>

                <section class="bg-secondary-surface-default-subtle border border-secondary-border-default-subtle rounded-xl p-6 mb-6">
                    <h2 class="text-xl font-bold text-grayscale-text-title mb-6">
                        {{ __('public/adoption.confirmation.next_steps.title') }}
                    </h2>

                    <div class="space-y-4">
                        {{-- Step 1 --}}
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-primary-surface-default text-white rounded-full flex items-center justify-center font-bold flex-shrink-0">
                                1
                            </div>
                            <div class="flex-1 pt-1">
                                <p class="text-grayscale-text-title leading-relaxed">
                                    {{ __('public/adoption.confirmation.next_steps.step_1') }}
                                </p>
                            </div>
                        </div>

                        {{-- Step 2 --}}
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-primary-surface-default text-white rounded-full flex items-center justify-center font-bold flex-shrink-0">
                                2
                            </div>
                            <div class="flex-1 pt-1">
                                <p class="text-grayscale-text-title leading-relaxed">
                                    {{ __('public/adoption.confirmation.next_steps.step_2') }}
                                </p>
                            </div>
                        </div>

                        {{-- Step 3 --}}
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-primary-surface-default text-white rounded-full flex items-center justify-center font-bold flex-shrink-0">
                                3
                            </div>
                            <div class="flex-1 pt-1">
                                <p class="text-grayscale-text-title leading-relaxed">
                                    {{ __('public/adoption.confirmation.next_steps.step_3') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="border-t border-neutral-200 pt-6">
                    <h2 class="text-xl font-bold text-grayscale-text-title mb-4">
                        {{ __('public/adoption.confirmation.questions.title') }}
                    </h2>
                    <p class="text-grayscale-text-subtitle mb-4">
                        {{ __('public/adoption.confirmation.questions.subtitle') }}
                    </p>

                    <div class="space-y-3">
                        <a href="tel:{{ str_replace(' ', '', $shelterPhone) }}"
                           class="flex items-center gap-3 text-primary-text-link-light hover:underline underline-offset-3 transition-colors">
                            <svg class="w-5 h-5 flex-shrink-0 fill-current" viewBox="0 0 24 24">
                                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                            </svg>
                            <span class="font-medium">{{ $shelterPhone }}</span>
                        </a>
                        <a href="mailto:{{ $shelterEmail }}"
                           class="flex items-center gap-3 text-primary-text-link-light hover:underline underline-offset-3 transition-colors">
                            <svg class="w-5 h-5 flex-shrink-0 fill-current" viewBox="0 0 24 24">
                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                            </svg>
                            <span class="font-medium">{{ $shelterEmail }}</span>
                        </a>
                    </div>
                </section>
            </div>

            <div class="flex flex-col md:flex-row gap-4">
                <x-cta-button
                    href="{{ route('pets.index') }}"
                    variant="secondary"
                    class="w-full justify-center"
                >
                    {{ __('public/adoption.confirmation.actions.view_other_pets') }}
                </x-cta-button>

                <x-cta-button
                    href="{{ route('home') }}"
                    class="w-full justify-center"
                >
                    {{ __('public/adoption.confirmation.actions.back_home') }}
                </x-cta-button>
            </div>

        </div>
    </div>

</x-layout>
