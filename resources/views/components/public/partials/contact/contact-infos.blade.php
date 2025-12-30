@props(['shelter'])

@php
    $addressLines = [
        $shelter->address,
        $shelter->zip_code . ' ' . $shelter->city
    ];

    $mapsLink = 'https://maps.google.com/?q=' . urlencode(implode(', ', $addressLines));

    $schedule = [
        'Lundi - Vendredi' => '9h00 - 17h00',
        'Samedi' => '10h00 - 16h00',
        'Dimanche' => 'Fermé'
    ];
@endphp

<div class="space-y-4 mb-8">
    <x-public.partials.contact.info-card
        icon="home"
        :title="__('public/contact.info.address_title')"
        :link_title="__('public/contact.info.address_link_title')"
        :lines="$addressLines"
        :linkText="__('public/contact.info.address_link')"
        :href="$mapsLink"
        external
    />

    <x-public.partials.contact.info-card
        icon="phone"
        :title="__('public/contact.info.phone_title')"
        :link_title="__('public/contact.info.phone_link_title') . ' ' . $shelter->phone"
        :lines="[$shelter->phone]"
        :linkText="__('public/contact.info.phone_link')"
        :href="'tel:' . str_replace(' ', '', $shelter->phone)"
    />

    <x-public.partials.contact.info-card
        icon="email"
        :title="__('public/contact.info.email_title')"
        :link_title="__('public/contact.info.email_link_title') . ' ' . $shelter->email"
        :lines="[$shelter->email]"
        :linkText="__('public/contact.info.email_link')"
        :href="'mailto:' . $shelter->email"
    />

    <x-public.partials.contact.opening-hours
        icon="clock"
        :title="__('public/contact.info.hours_title')"
        :schedule="$schedule"
        :note="__('public/contact.info.hours_note')"
    />

</div>
