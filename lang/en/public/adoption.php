<?php

return [
    'page_title' => 'Adoption Form',

    'breadcrumb' => [
        'home' => 'Home',
        'pets' => 'Our Pets',
        'adoption' => 'Adoption',
    ],

    'heading' => [
        'title' => 'Adoption request for :name',
        'subtitle' => ':age year old :sex :species',
    ],

    'intro' => [
        'title' => 'Thank you for your interest in :name!',
        'text' => 'Fill out this form and we will contact you quickly to arrange a meeting at the shelter.',
    ],

    'form' => [
        'section_1' => [
            'title' => 'Your information',
            'first_name' => 'First name',
            'first_name_placeholder' => 'Your first name',
            'last_name' => 'Last name',
            'last_name_placeholder' => 'Your last name',
            'email' => 'Email',
            'email_placeholder' => 'your.email@example.com',
            'phone' => 'Phone',
            'phone_placeholder' => '+32 2 123 45 67',
        ],

        'section_2' => [
            'title' => 'Your address',
            'address' => 'Address',
            'address_placeholder' => 'Street and number',
            'postal_code' => 'Postal code',
            'postal_code_placeholder' => '1000',
            'city' => 'City',
            'city_placeholder' => 'Brussels',
        ],

        'section_3' => [
            'title' => 'About you',
            'housing_type' => 'Type of housing',
            'housing_house' => 'House',
            'housing_apartment' => 'Apartment',
            'garden' => 'Do you have a garden?',
            'garden_yes' => 'Yes',
            'garden_no' => 'No',
            'other_pets' => 'Do you have other pets?',
            'other_pets_placeholder' => 'If yes, which ones? (optional)',
            'other_pets_helper' => 'Example: 1 cat, 2 dogs...',
            'experience' => 'Have you ever had a dog?',
            'experience_placeholder' => 'Tell us about your experience (optional)',
        ],

        'section_4' => [
            'title' => 'Your availability',
            'preferred_days' => 'Preferred days for an appointment',
            'preferred_days_helper' => 'Select one or more days',
            'days' => [
                'lundi' => 'Monday',
                'mardi' => 'Tuesday',
                'mercredi' => 'Wednesday',
                'jeudi' => 'Thursday',
                'vendredi' => 'Friday',
                'samedi' => 'Saturday',
                'dimanche' => 'Sunday',
            ],
            'preferred_hours' => 'Preferred time slots',
            'preferred_hours_helper' => 'Select one or more slots',
            'hours' => [
                'matin' => 'Morning (9am-12pm)',
                'apres-midi' => 'Afternoon (2pm-5pm)',
                'soir' => 'Evening (5pm-7pm)',
            ],
            'contact_method' => 'Preferred contact method',
            'contact_phone' => 'Phone',
            'contact_email' => 'Email',
        ],

        'section_5' => [
            'title' => 'Your message',
            'message' => 'Free message (optional)',
            'message_placeholder' => 'Tell us about yourself, your motivation...',
            'message_helper' => 'This message will help us get to know you better',
        ],

        'section_6' => [
            'title' => 'Consent',
            'rgpd' => 'I agree that my personal data will be used to process my adoption request.',
            'newsletter' => 'I would like to receive news from the shelter and available animals',
        ],

        'errors' => [
            'required' => 'This field is required',
            'email' => 'Invalid email address',
            'phone' => 'Invalid phone number',
            'postal_code' => 'Invalid postal code',
        ],

        'submit_info' => 'You will receive a confirmation email after submitting your request',
        'submit_button' => 'Submit my request',
    ],

    'confirmation' => [
        'page_title' => 'Adoption Request - Confirmation',
        'title' => 'Request sent!',
        'subtitle' => 'Thank you for your interest in :name',
        'greeting' => 'Hello :firstname,',
        'intro' => 'we have received your adoption request for :petname.',

        'next_steps' => [
            'title' => 'What happens next...',
            'step_1' => 'You will receive a confirmation email',
            'step_2' => 'We are actively reviewing your application',
            'step_3' => 'We will contact you within 48 to 72 hours excluding weekends and public holidays',
        ],

        'questions' => [
            'title' => 'Have a question in the meantime?',
            'subtitle' => 'Feel free to contact us:',
        ],

        'actions' => [
            'view_other_pets' => 'View other pets',
            'back_home' => 'Back to home',
        ],
    ],
];
