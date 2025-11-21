

    {{-- Coordonnées Cards --}}
    <div class="space-y-4 mb-8">
        <x-guest.partials.contact.info-card
            icon="home"
            title="Adresse"
            link_title="Consulter sur Google Maps"
            :lines="['123 Rue des Animaux', '1000 Bruxelles']"
            linkText="Voir sur Google Maps"
            href="https://maps.google.com"
            external
        />

        {{-- Téléphone --}}
        <x-guest.partials.contact.info-card
            icon="phone"
            title="Téléphone"
            link_title="Appeler le numéro +32 2 123 45 67"
            :lines="['+32 2 123 45 67']"
            linkText="Cliquez pour appeler"
            href="tel:+3221234567"
        />

        {{-- Email --}}
        <x-guest.partials.contact.info-card
            icon="email"
            title="Email"
            link_title="Envoyer un email à l'adresse contact@pattesheureuses.be"
            :lines="['contact@pattesheureuses.be']"
            linkText="Cliquez pour envoyer un email"
            href="mailto:contact@pattesheureuses.be"
        />


        {{-- Horaires --}}
        <x-guest.partials.contact.opening-hours icon="clock"
                                                title="Horaires d'ouverture"
                                                :schedule="[
                                                                'Lundi - Vendredi' => '9h00 - 17h00',
                                                                'Samedi' => '10h00 - 16h00',
                                                                'Dimanche' => 'Fermé'
                                                                ]"
                                                note="* Visite sur rendez-vous uniquement"/>

    </div>


