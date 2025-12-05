@php
    // Ces données viendront de la DB plus tard
    $shelterInfo = [
        'address' => ['123 Rue des Animaux', '1000 Bruxelles'],
        'phone' => '+32 2 123 45 67',
        'email' => 'contact@pattesheureuses.be',
        'schedule' => [
            'Lundi - Vendredi' => '9h00 - 17h00',
            'Samedi' => '10h00 - 16h00',
            'Dimanche' => 'Fermé'
        ]
    ];
@endphp

{{-- Coordonnées Cards --}}
<div class="space-y-4 mb-8">
    {{-- Adresse --}}
    <x-guest.partials.contact.info-card
        icon="home"
        :title="__('guest/contact.info.address_title')"
        :link_title="__('guest/contact.info.address_link_title')"
        :lines="$shelterInfo['address']"
        :linkText="__('guest/contact.info.address_link')"
        href="https://maps.google.com"
        external
    />

    {{-- Téléphone --}}
    <x-guest.partials.contact.info-card
        icon="phone"
        :title="__('guest/contact.info.phone_title')"
        :link_title="__('guest/contact.info.phone_link_title') . ' ' . $shelterInfo['phone']"
        :lines="[$shelterInfo['phone']]"
        :linkText="__('guest/contact.info.phone_link')"
        :href="'tel:' . str_replace(' ', '', $shelterInfo['phone'])"
    />

    {{-- Email --}}
    <x-guest.partials.contact.info-card
        icon="email"
        :title="__('guest/contact.info.email_title')"
        :link_title="__('guest/contact.info.email_link_title') . ' ' . $shelterInfo['email']"
        :lines="[$shelterInfo['email']]"
        :linkText="__('guest/contact.info.email_link')"
        :href="'mailto:' . $shelterInfo['email']"
    />

    {{-- Horaires --}}
    <x-guest.partials.contact.opening-hours
        icon="clock"
        :title="__('guest/contact.info.hours_title')"
        :schedule="$shelterInfo['schedule']"
        :note="__('guest/contact.info.hours_note')"
    />

</div>
