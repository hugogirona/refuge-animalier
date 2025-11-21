@props([
    'title' => 'Questions fréquentes',
    'subtitle' => 'Peut-être trouverez-vous votre réponse ici',
    'faqs' => [],
])

<section class="py-16 md:py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">

            {{-- Section Header --}}
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-grayscale-text-body mb-4">
                    {{ $title }}
                </h2>
                <p class="text-lg text-grayscale-text-subtitle">
                    {{ $subtitle }}
                </p>
            </div>

            <div class="space-y-4" x-data="{ openFaq: null }">
                @foreach($faqs as $index => $faq)
                    <x-guest.partials.contact.faq-item
                        :index="$index + 1"
                        :question="$faq['question']"
                        :answer="$faq['answer']"
                    />
                @endforeach
            </div>

        </div>
    </div>
</section>
