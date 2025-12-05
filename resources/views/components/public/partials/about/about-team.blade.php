@props([
    'section_title' => null,
    'section_subtitle' => null,
    'team_members' => [],
    'cta_title' => null,
    'cta_text' => null,
])

<section class="py-16 md:py-20 bg-grayscale-negative">

    <div class="max-w-6xl mx-auto px-5 md:px-8">

        {{-- Section Header --}}
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                {{ $section_title ?? __('public/about.team.section_title') }}
            </h2>
            <p class="text-lg md:text-xl text-grayscale-text-subtitle max-w-3xl mx-auto">
                {{ $section_subtitle ?? __('public/about.team.section_subtitle') }}
            </p>
        </div>

        {{-- Team Grid --}}
        @if(count($team_members) > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-16">
                @foreach($team_members as $member)
                    <x-public.partials.about.team-member-card
                        :name="$member['name']"
                        :role="$member['role']"
                        :image="$member['image']"
                    />
                @endforeach
            </div>
        @endif

        {{-- CTA Section --}}
        <article class="bg-secondary-surface-default-subtle border border-secondary-border-default-subtle rounded-xl p-8 md:p-12 text-center">
            <h3 class="text-xl md:text-2xl font-bold mb-4">
                {{ $cta_title ?? __('public/about.team.cta.title') }}
            </h3>
            <p class="text-lg text-grayscale-text-subtitle mb-8 max-w-2xl mx-auto">
                {{ $cta_text ?? __('public/about.team.cta.text') }}
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <x-cta-button href="{{ route('pets.index') }}">
                    {{ __('public/about.team.cta.adopt_button') }}
                </x-cta-button>

                <x-cta-button href="{{ route('contact', ['subject' => 'volunteering']) }}" variant="secondary">
                    {{ __('public/about.team.cta.volunteer_button') }}
                </x-cta-button>
            </div>
        </article>

    </div>
</section>
