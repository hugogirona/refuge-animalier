<div class="bg-white rounded-xl border border-neutral-200 p-6 md:p-8">
    <h2 class="text-2xl font-bold text-neutral-900 mb-2">Envoyez-nous un message</h2>
    <p class="text-neutral-600 mb-6">
        Remplissez ce formulaire et nous vous répondrons dans les plus brefs délais
    </p>

    <form id="contactForm" class="flex flex-col gap-4">

        {{-- Nom --}}
        <x-form.form-input
            label="Nom complet"
            name="nom"
            required
            placeholder="Votre nom"
            error="Ce champ est obligatoire"
        />

        {{-- Email --}}
        <x-form.form-input
            label="Email"
            name="email"
            type="email"
            required
            placeholder="votre.email@exemple.com"
            error="Adresse email invalide"
        />

        {{-- Téléphone --}}
        <x-form.form-input
            label="Téléphone"
            name="telephone"
            type="tel"
            placeholder="+32 2 123 45 67"
        />

        {{-- Sujet --}}
        <x-form.form-select
            label="Sujet"
            name="sujet"
            required
            placeholder="Sélectionnez un sujet"
            :options="[
                                    'adoption' => 'Question sur une adoption',
                                    'visite' => 'Organiser une visite',
                                    'benevolat' => 'Devenir bénévole',
                                    'don' => 'Faire un don',
                                    'partenariat' => 'Partenariat',
                                    'autre' => 'Autre'
                                ]"
            error="Veuillez sélectionner un sujet"
        />

        {{-- Message --}}
        <x-form.form-textarea
            label="Message"
            name="message"
            required
            rows="5"
            placeholder="Votre message..."
            error="Ce champ est obligatoire"
        />

        {{-- RGPD --}}
        <x-form.form-checkbox
            name="rgpd"
            value="rgpd"
            required
            label="J'accepte que mes données soient utilisées pour traiter ma demande."
        />

        {{-- Submit Button --}}
        <x-cta-button role="button">Envoyer le message</x-cta-button>

    </form>
</div>
