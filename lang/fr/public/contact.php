<?php

return [
    'page_title' => 'Contactez-nous',

    'breadcrumb' => [
        'home' => 'Accueil',
        'contact' => 'Contact',
    ],

    'heading' => [
        'title' => 'Nous contacter',
    ],

    'form' => [
        'title' => 'Envoyez-nous un message',
        'subtitle' => 'Remplissez ce formulaire et nous vous répondrons dans les plus brefs délais',

        'fields' => [
            'name' => 'Nom complet',
            'name_placeholder' => 'Votre nom',
            'email' => 'Email',
            'email_placeholder' => 'votre.email@exemple.com',
            'phone' => 'Téléphone',
            'phone_placeholder' => '+32 2 123 45 67',
            'subject' => 'Sujet',
            'subject_placeholder' => 'Sélectionnez un sujet',
            'message' => 'Message',
            'message_placeholder' => 'Votre message...',
            'rgpd' => 'J\'accepte que mes données soient utilisées pour traiter ma demande.',
        ],

        'subjects' => [
            'adoption' => 'Question sur une adoption',
            'visit' => 'Organiser une visite',
            'volunteering' => 'Devenir bénévole',
            'giveaway' => 'Faire un don',
            'partnership' => 'Partenariat',
            'other' => 'Autre',
        ],

        'errors' => [
            'required' => 'Ce champ est obligatoire',
            'email' => 'Adresse email invalide',
            'subject' => 'Veuillez sélectionner un sujet',
        ],

        'submit' => 'Envoyer le message',
    ],

    'info' => [
        'address_title' => 'Adresse',
        'address_link' => 'Voir sur Google Maps',
        'address_link_title' => 'Consulter sur Google Maps',

        'phone_title' => 'Téléphone',
        'phone_link' => 'Cliquez pour appeler',
        'phone_link_title' => 'Appeler le numéro',

        'email_title' => 'Email',
        'email_link' => 'Cliquez pour envoyer un email',
        'email_link_title' => 'Envoyer un email à l\'adresse',

        'hours_title' => 'Horaires d\'ouverture',
        'hours_note' => '* Visite sur rendez-vous uniquement',
    ],

    'faq' => [
        'title' => 'Questions fréquentes',
        'subtitle' => 'Peut-être trouverez-vous votre réponse ici',

        'items' => [
            [
                'question' => 'Comment adopter un animal ?',
                'answer' => 'Consultez notre page "Nos animaux", choisissez l\'animal qui vous intéresse et remplissez le formulaire de demande d\'adoption. Nous vous recontacterons rapidement pour organiser une rencontre au refuge.',
            ],
            [
                'question' => 'Puis-je visiter le refuge sans rendez-vous ?',
                'answer' => 'Non, les visites se font uniquement sur rendez-vous pour garantir le bien-être de nos animaux et vous offrir un accueil personnalisé. Contactez-nous par téléphone ou email pour planifier votre visite.',
            ],
            [
                'question' => 'Quels sont les frais d\'adoption ?',
                'answer' => 'Les frais d\'adoption varient selon l\'animal (espèce, âge, soins reçus). Ils couvrent les frais vétérinaires (vaccins, stérilisation, identification). Nous vous communiquerons le montant exact lors de votre demande.',
            ],
            [
                'question' => 'Comment devenir bénévole ?',
                'answer' => 'Contactez-nous via ce formulaire en sélectionnant "Devenir bénévole" comme sujet, ou appelez-nous directement. Nous organisons régulièrement des sessions d\'accueil pour les nouveaux bénévoles.',
            ],
            [
                'question' => 'Acceptez-vous les dons ?',
                'answer' => 'Oui ! Nous acceptons les dons financiers, de nourriture, de jouets, de couvertures, etc. Contactez-nous pour connaître nos besoins actuels. Chaque don, petit ou grand, fait une différence pour nos pensionnaires.',
            ],
        ],
    ],
];
