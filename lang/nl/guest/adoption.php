<?php

return [
    'page_title' => 'Adoptieformulier',

    'breadcrumb' => [
        'home' => 'Home',
        'pets' => 'Onze dieren',
        'adoption' => 'Adoptie',
    ],

    'heading' => [
        'title' => 'Adoptieverzoek voor :name',
        'subtitle' => ':age jaar oude :sex :species',
    ],

    'intro' => [
        'title' => 'Bedankt voor uw interesse in :name!',
        'text' => 'Vul dit formulier in en we nemen snel contact met u op om een ontmoeting in het opvangcentrum te regelen.',
    ],

    'form' => [
        'section_1' => [
            'title' => 'Uw gegevens',
            'first_name' => 'Voornaam',
            'first_name_placeholder' => 'Uw voornaam',
            'last_name' => 'Achternaam',
            'last_name_placeholder' => 'Uw achternaam',
            'email' => 'E-mail',
            'email_placeholder' => 'uw.email@voorbeeld.com',
            'phone' => 'Telefoon',
            'phone_placeholder' => '+32 2 123 45 67',
        ],

        'section_2' => [
            'title' => 'Uw adres',
            'address' => 'Adres',
            'address_placeholder' => 'Straat en nummer',
            'postal_code' => 'Postcode',
            'postal_code_placeholder' => '1000',
            'city' => 'Stad',
            'city_placeholder' => 'Brussel',
        ],

        'section_3' => [
            'title' => 'Over u',
            'housing_type' => 'Type woning',
            'housing_house' => 'Huis',
            'housing_apartment' => 'Appartement',
            'garden' => 'Heeft u een tuin?',
            'garden_yes' => 'Ja',
            'garden_no' => 'Nee',
            'other_pets' => 'Heeft u andere huisdieren?',
            'other_pets_placeholder' => 'Zo ja, welke? (optioneel)',
            'other_pets_helper' => 'Voorbeeld: 1 kat, 2 honden...',
            'experience' => 'Heeft u ooit een hond gehad?',
            'experience_placeholder' => 'Vertel ons over uw ervaring (optioneel)',
        ],

        'section_4' => [
            'title' => 'Uw beschikbaarheid',
            'preferred_days' => 'Voorkeursdagen voor een afspraak',
            'preferred_days_helper' => 'Selecteer een of meer dagen',
            'days' => [
                'lundi' => 'Maandag',
                'mardi' => 'Dinsdag',
                'mercredi' => 'Woensdag',
                'jeudi' => 'Donderdag',
                'vendredi' => 'Vrijdag',
                'samedi' => 'Zaterdag',
                'dimanche' => 'Zondag',
            ],
            'preferred_hours' => 'Voorkeurstijden',
            'preferred_hours_helper' => 'Selecteer een of meer tijdslots',
            'hours' => [
                'matin' => 'Ochtend (9u-12u)',
                'apres-midi' => 'Namiddag (14u-17u)',
                'soir' => 'Avond (17u-19u)',
            ],
            'contact_method' => 'Voorkeur contactmethode',
            'contact_phone' => 'Telefoon',
            'contact_email' => 'E-mail',
        ],

        'section_5' => [
            'title' => 'Uw bericht',
            'message' => 'Vrij bericht (optioneel)',
            'message_placeholder' => 'Vertel ons over uzelf, uw motivatie...',
            'message_helper' => 'Dit bericht helpt ons u beter te leren kennen',
        ],

        'section_6' => [
            'title' => 'Toestemming',
            'rgpd' => 'Ik ga ermee akkoord dat mijn persoonlijke gegevens worden gebruikt om mijn adoptieverzoek te verwerken.',
            'newsletter' => 'Ik wil graag nieuws ontvangen van het opvangcentrum en beschikbare dieren',
        ],

        'errors' => [
            'required' => 'Dit veld is verplicht',
            'email' => 'Ongeldig e-mailadres',
            'phone' => 'Ongeldig telefoonnummer',
            'postal_code' => 'Ongeldige postcode',
        ],

        'submit_info' => 'U ontvangt een bevestigingsmail na het verzenden van uw verzoek',
        'submit_button' => 'Mijn verzoek verzenden',
    ],

    'confirmation' => [
        'page_title' => 'Adoptieverzoek - Bevestiging',
        'title' => 'Verzoek verzonden!',
        'subtitle' => 'Bedankt voor uw interesse in :name',
        'greeting' => 'Hallo :firstname,',
        'intro' => 'we hebben uw adoptieverzoek voor :petname ontvangen.',

        'next_steps' => [
            'title' => 'Wat gebeurt er nu...',
            'step_1' => 'U ontvangt een bevestigingsmail',
            'step_2' => 'We bestuderen uw aanvraag actief',
            'step_3' => 'We nemen binnen 48 tot 72 uur contact met u op, exclusief weekends en feestdagen',
        ],

        'questions' => [
            'title' => 'Heeft u ondertussen een vraag?',
            'subtitle' => 'Neem gerust contact met ons op:',
        ],

        'actions' => [
            'view_other_pets' => 'Andere dieren bekijken',
            'back_home' => 'Terug naar home',
        ],
    ],
];
