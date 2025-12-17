<?php

return [
    'page_title' => 'Formulaire d\'adoption',

    'breadcrumb' => [
        'home' => 'Accueil',
        'pets' => 'Nos animaux',
        'adoption' => 'Adoption',
    ],

    'heading' => [
        'title' => 'Demande d\'adoption pour :name',
        'subtitle' => ':breed :sex de :age',
    ],

    'intro' => [
        'title' => 'Merci de votre intérêt pour :name !',
        'text' => 'Remplissez ce formulaire et nous vous recontacterons rapidement pour organiser une rencontre au refuge.',
    ],

    'form' => [
        'section_1' => [
            'title' => 'Vos informations',
            'first_name' => 'Prénom',
            'first_name_placeholder' => 'Votre prénom',
            'last_name' => 'Nom',
            'last_name_placeholder' => 'Votre nom',
            'email' => 'Email',
            'email_placeholder' => 'votre.email@exemple.com',
            'phone' => 'Téléphone',
            'phone_placeholder' => '+32 2 123 45 67',
        ],

        'section_2' => [
            'title' => 'Votre adresse',
            'address' => 'Adresse',
            'address_placeholder' => 'Rue et numéro',
            'postal_code' => 'Code postal',
            'postal_code_placeholder' => '1000',
            'city' => 'Ville',
            'city_placeholder' => 'Bruxelles',
        ],

        'section_3' => [
            'title' => 'À propos de vous',
            'housing_type' => 'Type de logement',
            'housing_house' => 'Maison',
            'housing_apartment' => 'Appartement',
            'garden' => 'Disposez-vous d\'un jardin ?',
            'garden_yes' => 'Oui',
            'garden_no' => 'Non',
            'other_pets' => 'Avez-vous d\'autres animaux ?',
            'other_pets_placeholder' => 'Si oui, lesquels ? (optionnel)',
            'other_pets_helper' => 'Exemple : 1 chat, 2 chiens...',
            'experience' => 'Avez-vous déjà eu un chien ?',
            'experience_placeholder' => 'Parlez-nous de votre expérience (optionnel)',
        ],

        'section_4' => [
            'title' => 'Vos disponibilités',
            'preferred_days' => 'Jours préférés pour un rendez-vous',
            'preferred_days_helper' => 'Sélectionnez un ou plusieurs jours',
            'days' => [
                'monday' => 'Lundi',
                'tuesday' => 'Mardi',
                'wednesday' => 'Mercredi',
                'thursday' => 'Jeudi',
                'friday' => 'Vendredi',
                'saturday' => 'Samedi',
            ],
            'preferred_hours' => 'Plages horaires préférées',
            'preferred_hours_helper' => 'Sélectionnez une ou plusieurs plages',
            'hours' => [
                'morning' => 'Matin (9h-12h)',
                'afternoon' => 'Après-midi (14h-17h)',
                'evening' => 'Soir (17h-19h)',
            ],
            'contact_method' => 'Mode de contact préféré',
            'contact_phone' => 'Téléphone',
            'contact_email' => 'Email',
        ],

        'section_5' => [
            'title' => 'Votre message',
            'message' => 'Message libre (optionnel)',
            'message_placeholder' => 'Parlez-nous de vous, de votre motivation...',
            'message_helper' => 'Ce message nous aidera à mieux vous connaître',
        ],

        'section_6' => [
            'title' => 'Consentement',
            'rgpd' => 'J\'accepte que mes données personnelles soient utilisées pour traiter ma demande d\'adoption.',
            'newsletter' => 'Je souhaite recevoir des nouvelles du refuge et des animaux disponibles',
        ],

        'errors' => [
            'required' => 'Ce champ est obligatoire',
            'email' => 'Adresse email invalide',
            'phone' => 'Numéro de téléphone invalide',
            'postal_code' => 'Code postal invalide',
        ],

        'submit_info' => 'Vous recevrez un email de confirmation après l\'envoi de votre demande',
        'submit_button' => 'Envoyer ma demande',
    ],

    'confirmation' => [
        'page_title' => 'Demande d\'adoption - Confirmation',
        'title' => 'Demande envoyée !',
        'subtitle' => 'Merci pour votre intérêt pour :name',
        'greeting' => 'Bonjour :firstname,',
        'intro' => 'nous avons bien reçu votre demande d\'adoption pour :petname.',

        'next_steps' => [
            'title' => 'Et maintenant...',
            'step_1' => 'Vous allez recevoir un email de confirmation',
            'step_2' => 'Nous étudions activement votre dossier',
            'step_3' => 'Nous vous recontacterons sous 48h à 72h hors week-end et jours fériés',
        ],

        'questions' => [
            'title' => 'Une question en attendant ?',
            'subtitle' => 'N\'hésitez pas à nous contacter :',
        ],

        'actions' => [
            'view_other_pets' => 'Voir d\'autres animaux',
            'back_home' => 'Retour à l\'accueil',
        ],
    ],
];
