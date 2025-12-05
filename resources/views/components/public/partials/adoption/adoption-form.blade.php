@props(['petName' => 'Moka'])

<form id="adoptionForm" class="max-w-3xl mx-auto" novalidate>

    @csrf

    {{-- SECTION 1: IDENTITÉ --}}
    <x-form.form-section number="1" :title="__('public/adoption.form.section_1.title')">
        <x-form.form-input
            :label="__('public/adoption.form.section_1.first_name')"
            name="first-name"
            required
            :placeholder="__('public/adoption.form.section_1.first_name_placeholder')"
            :error="__('public/adoption.form.errors.required')"
        />

        <x-form.form-input
            :label="__('public/adoption.form.section_1.last_name')"
            name="last-name"
            required
            :placeholder="__('public/adoption.form.section_1.last_name_placeholder')"
            :error="__('public/adoption.form.errors.required')"
        />

        <x-form.form-input
            :label="__('public/adoption.form.section_1.email')"
            name="email"
            type="email"
            required
            :placeholder="__('public/adoption.form.section_1.email_placeholder')"
            :error="__('public/adoption.form.errors.email')"
        />

        <x-form.form-input
            :label="__('public/adoption.form.section_1.phone')"
            name="phone"
            type="tel"
            required
            :placeholder="__('public/adoption.form.section_1.phone_placeholder')"
            :error="__('public/adoption.form.errors.phone')"
        />
    </x-form.form-section>

    {{-- SECTION 2: COORDONNÉES --}}
    <x-form.form-section number="2" :title="__('public/adoption.form.section_2.title')">
        <x-form.form-input
            :label="__('public/adoption.form.section_2.address')"
            name="adress"
            required
            :placeholder="__('public/adoption.form.section_2.address_placeholder')"
            :error="__('public/adoption.form.errors.required')"
        />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-form.form-input
                :label="__('public/adoption.form.section_2.postal_code')"
                name="postalCode"
                required
                :placeholder="__('public/adoption.form.section_2.postal_code_placeholder')"
                pattern="[0-9]{4}"
                :error="__('public/adoption.form.errors.postal_code')"
            />

            <x-form.form-input
                :label="__('public/adoption.form.section_2.city')"
                name="city"
                required
                :placeholder="__('public/adoption.form.section_2.city_placeholder')"
                :error="__('public/adoption.form.errors.required')"
            />
        </div>
    </x-form.form-section>

    {{-- SECTION 3: À PROPOS --}}
    <x-form.form-section number="3" :title="__('public/adoption.form.section_3.title')">
        <x-form.form-radio
            :label="__('public/adoption.form.section_3.housing_type')"
            name="habitation"
            required
            layout="vertical"
            :options="[
                'maison' => __('public/adoption.form.section_3.housing_house'),
                'appartement' => __('public/adoption.form.section_3.housing_apartment')
            ]"
        />

        <x-form.form-radio
            :label="__('public/adoption.form.section_3.garden')"
            name="garden"
            required
            layout="horizontal"
            :options="[
                'oui' => __('public/adoption.form.section_3.garden_yes'),
                'non' => __('public/adoption.form.section_3.garden_no')
            ]"
        />

        <x-form.form-textarea
            :label="__('public/adoption.form.section_3.other_pets')"
            name="otherPets"
            :placeholder="__('public/adoption.form.section_3.other_pets_placeholder')"
            :helper="__('public/adoption.form.section_3.other_pets_helper')"
        />

        <x-form.form-textarea
            :label="__('public/adoption.form.section_3.experience')"
            name="experience"
            :placeholder="__('public/adoption.form.section_3.experience_placeholder')"
        />
    </x-form.form-section>

    {{-- SECTION 4: DISPONIBILITÉS --}}
    <x-form.form-section number="4" :title="__('public/adoption.form.section_4.title')">
        <x-form.form-checkbox-group
            :label="__('public/adoption.form.section_4.preferred_days')"
            name="days"
            required
            :helper="__('public/adoption.form.section_4.preferred_days_helper')"
            columns="2"
            :options="__('public/adoption.form.section_4.days')"
        />

        <x-form.form-checkbox-group
            :label="__('public/adoption.form.section_4.preferred_hours')"
            name="hours"
            required
            :helper="__('public/adoption.form.section_4.preferred_hours_helper')"
            columns="1"
            :options="__('public/adoption.form.section_4.hours')"
        />

        <x-form.form-radio
            :label="__('public/adoption.form.section_4.contact_method')"
            name="contact"
            required
            layout="horizontal"
            :options="[
                'telephone' => __('public/adoption.form.section_4.contact_phone'),
                'email' => __('public/adoption.form.section_4.contact_email')
            ]"
        />
    </x-form.form-section>

    {{-- SECTION 5: MESSAGE --}}
    <x-form.form-section number="5" :title="__('public/adoption.form.section_5.title')">
        <x-form.form-textarea
            :label="__('public/adoption.form.section_5.message')"
            name="message"
            rows="5"
            :placeholder="__('public/adoption.form.section_5.message_placeholder')"
            :helper="__('public/adoption.form.section_5.message_helper')"
        />
    </x-form.form-section>

    {{-- SECTION 6: CONSENTEMENT --}}
    <x-form.form-section number="6" :title="__('public/adoption.form.section_6.title')">
        <x-form.form-checkbox
            name="rgpd"
            value="rgpd"
            required
            :label="__('public/adoption.form.section_6.rgpd')"
        />

        <x-form.form-checkbox
            name="newsletter"
            value="newsletter"
            :label="__('public/adoption.form.section_6.newsletter')"
        />
    </x-form.form-section>

    <div class="bg-secondary-surface-default-subtle flex flex-col rounded-xl border border-secondary-border-default-subtle p-6 text-center">
        <p class="text-grayscale-text-subtitle mb-4">
            {{ __('public/adoption.form.submit_info') }}
        </p>
        <x-cta-button role="button">{{ __('public/adoption.form.submit_button') }}</x-cta-button>
    </div>

</form>
