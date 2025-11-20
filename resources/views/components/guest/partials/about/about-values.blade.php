@props([
    'section_title' => 'Nos valeurs',
    'section_subtitle' => 'Ces principes guident chacune de nos actions au quotidien',
    'values' => [],
])

@php
    $values = [
            [
                'icon' => 'heart',
                'title' => 'Bien-être animal',
                'description' => 'La santé et le bonheur de chaque animal sont notre priorité absolue. Nous leur offrons des soins vétérinaires complets et un environnement adapté.'
            ],
            [
                'icon' => 'people',
                'title' => 'Adoption responsable',
                'description' => 'Nous prenons le temps de bien connaître chaque adoptant pour garantir une compatibilité parfaite et une adoption réussie sur le long terme.'
            ],
            [
                'icon' => 'check',
                'title' => 'Transparence',
                'description' => 'Nous communiquons ouvertement sur l\'état de santé et le caractère de chaque animal pour éviter toute mauvaise surprise.'
            ],
            [
                'icon' => 'medicine',
                'title' => 'Professionnalisme',
                'description' => 'Notre équipe est formée et travaille en étroite collaboration avec des vétérinaires pour offrir les meilleurs soins possibles.'
            ],
            [
                'icon' => 'home',
                'title' => 'Engagement local',
                'description' => 'Nous travaillons avec la commune et les acteurs locaux pour sensibiliser à la cause animale et prévenir les abandons.'
            ],
            [
                'icon' => 'paw',
                'title' => 'Bienveillance',
                'description' => 'Nous accueillons chaque personne avec respect et empathie, qu\'il s\'agisse d\'adoptants, de bénévoles ou de donateurs.'
            ],
        ];
@endphp

<section class="py-16 md:py-20 bg-neutral-50">
    <div class="container mx-auto px-5 md:px-8 max-w-6xl">

            {{-- Section Header --}}
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    {{ $section_title }}
                </h2>
                <p class="text-lg text-grayscale-text-subtitle max-w-2xl mx-auto">
                    {{ $section_subtitle }}
                </p>
            </div>

            {{-- Values Grid --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($values as $value)
                    <x-guest.partials.about.value-card
                        :icon="$value['icon']"
                        :title="$value['title']"
                        :description="$value['description']"
                    />
                @endforeach
            </div>

        </div>
</section>
