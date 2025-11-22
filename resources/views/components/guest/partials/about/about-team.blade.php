@props([
    'section_title' => 'Notre équipe',
    'section_subtitle' => 'Des personnes passionnées et dévouées au service des animaux',
    'team_members' => [],
    'cta_title' => 'Envie de nous aider ?',
    'cta_text' => 'Adoptez, devenez bénévole ou soutenez-nous en parlant de nous autour de vous',
])

<section class="py-16 md:py-20 bg-grayscale-negative">

    <div class="max-w-6xl mx-auto px-5 md:px-8">

        {{-- Section Header --}}
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                {{ $section_title }}
            </h2>
            <p class="text-lg md:text-xl text-grayscale-text-subtitle max-w-3xl mx-auto">
                {{ $section_subtitle }}
            </p>
        </div>

        {{-- Team Grid --}}
        @if(count($team_members) > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-16">
                @foreach($team_members as $member)
                    <x-guest.partials.about.team-member-card
                        :name="$member['name']"
                        :role="$member['role']"
                        :image="$member['image']"
                    />
                @endforeach
            </div>
        @endif

        {{-- CTA Section --}}
        <article
            class="bg-secondary-surface-default-subtle border border-secondary-border-default-subtle rounded-xl p-8 md:p-12 text-center">
            <h3 class="text-xl md:text-2xl font-bold mb-4">
                {{ $cta_title }}
            </h3>
            <p class="text-lg text-grayscale-text-subtitle mb-8 max-w-2xl mx-auto">
                {{ $cta_text }}
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <x-cta-button href="{{ route('pets.index') }}">
                    Adopter un animal
                </x-cta-button>

                <x-cta-button href="{{route('contact', ['subject' => 'volunteering'])}}" variant="secondary">
                    Devenir bénévole
                </x-cta-button>
            </div>
        </article>

    </div>
</section>

