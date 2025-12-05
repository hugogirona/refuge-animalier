<?php

return [
    'page_title' => 'Contact Us',

    'breadcrumb' => [
        'home' => 'Home',
        'contact' => 'Contact',
    ],

    'heading' => [
        'title' => 'Contact Us',
    ],

    'form' => [
        'title' => 'Send us a message',
        'subtitle' => 'Fill out this form and we will get back to you as soon as possible',

        'fields' => [
            'name' => 'Full name',
            'name_placeholder' => 'Your name',
            'email' => 'Email',
            'email_placeholder' => 'your.email@example.com',
            'phone' => 'Phone',
            'phone_placeholder' => '+32 2 123 45 67',
            'subject' => 'Subject',
            'subject_placeholder' => 'Select a subject',
            'message' => 'Message',
            'message_placeholder' => 'Your message...',
            'rgpd' => 'I agree that my data will be used to process my request.',
        ],

        'subjects' => [
            'adoption' => 'Question about adoption',
            'visit' => 'Schedule a visit',
            'volunteering' => 'Become a volunteer',
            'giveaway' => 'Make a donation',
            'partnership' => 'Partnership',
            'other' => 'Other',
        ],

        'errors' => [
            'required' => 'This field is required',
            'email' => 'Invalid email address',
            'subject' => 'Please select a subject',
        ],

        'submit' => 'Send message',
    ],

    'info' => [
        'address_title' => 'Address',
        'address_link' => 'View on Google Maps',
        'address_link_title' => 'View on Google Maps',

        'phone_title' => 'Phone',
        'phone_link' => 'Click to call',
        'phone_link_title' => 'Call',

        'email_title' => 'Email',
        'email_link' => 'Click to send an email',
        'email_link_title' => 'Send an email to',

        'hours_title' => 'Opening hours',
        'hours_note' => '* By appointment only',
    ],

    'faq' => [
        'title' => 'Frequently Asked Questions',
        'subtitle' => 'You might find your answer here',

        'items' => [
            [
                'question' => 'How do I adopt a pet?',
                'answer' => 'Visit our "Our Pets" page, choose the animal you\'re interested in and fill out the adoption application form. We will contact you quickly to arrange a meeting at the shelter.',
            ],
            [
                'question' => 'Can I visit the shelter without an appointment?',
                'answer' => 'No, visits are by appointment only to ensure the well-being of our animals and provide you with personalized attention. Contact us by phone or email to schedule your visit.',
            ],
            [
                'question' => 'What are the adoption fees?',
                'answer' => 'Adoption fees vary depending on the animal (species, age, care received). They cover veterinary costs (vaccines, sterilization, identification). We will inform you of the exact amount when you apply.',
            ],
            [
                'question' => 'How can I become a volunteer?',
                'answer' => 'Contact us via this form by selecting "Become a volunteer" as the subject, or call us directly. We regularly organize welcome sessions for new volunteers.',
            ],
            [
                'question' => 'Do you accept donations?',
                'answer' => 'Yes! We accept financial donations, food, toys, blankets, etc. Contact us to find out our current needs. Every donation, big or small, makes a difference for our residents.',
            ],
        ],
    ],
];
