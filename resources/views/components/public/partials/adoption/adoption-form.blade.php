@props(['pet'])

<form id="adoptionForm" method="POST" action="{{ route('adoption.store') }}" class="max-w-3xl mx-auto" novalidate>

    @csrf
    <input type="hidden" name="pet_id" value="{{ $pet->id ?? old('pet_id') }}">


    <x-form.form-section number="1" :title="__('public/adoption.form.section_1.title')">

        <x-form.form-input
            :label="__('public/adoption.form.section_1.first_name')"
            name="first_name"
            required
            :value="old('first_name')" {{-- AJOUT --}}
            :placeholder="__('public/adoption.form.section_1.first_name_placeholder')"
            :error="$errors->first('first_name')" {{-- AJOUT --}}
        />

        <x-form.form-input
            :label="__('public/adoption.form.section_1.last_name')"
            name="last_name"
            required
            :value="old('last_name')"
            :placeholder="__('public/adoption.form.section_1.last_name_placeholder')"
            :error="$errors->first('last_name')"
        />

        <x-form.form-input
            :label="__('public/adoption.form.section_1.email')"
            name="email"
            type="email"
            required
            :value="old('email')"
            :placeholder="__('public/adoption.form.section_1.email_placeholder')"
            :error="$errors->first('email')"
        />

        <x-form.form-input
            :label="__('public/adoption.form.section_1.phone')"
            name="phone"
            type="tel"
            required
            :value="old('phone')"
            :placeholder="__('public/adoption.form.section_1.phone_placeholder')"
            :error="$errors->first('phone')"
        />
    </x-form.form-section>

    {{-- SECTION 2: COORDONNÉES --}}
    <x-form.form-section number="2" :title="__('public/adoption.form.section_2.title')">

        <x-form.form-input
            :label="__('public/adoption.form.section_2.address')"
            name="address"
            required
            :value="old('address')"
            :placeholder="__('public/adoption.form.section_2.address_placeholder')"
            :error="$errors->first('address')"
        />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-form.form-input
                :label="__('public/adoption.form.section_2.postal_code')"
                name="zip_code"
                required
                :value="old('zip_code')"
                :placeholder="__('public/adoption.form.section_2.postal_code_placeholder')"
                pattern="[0-9]{4,5}"
                :error="$errors->first('zip_code')"
            />

            <x-form.form-input
                :label="__('public/adoption.form.section_2.city')"
                name="city"
                required
                :value="old('city')"
                :placeholder="__('public/adoption.form.section_2.city_placeholder')"
                :error="$errors->first('city')"
            />
        </div>
    </x-form.form-section>

    {{-- SECTION 3: À PROPOS --}}
    <x-form.form-section number="3" :title="__('public/adoption.form.section_3.title')">

        <x-form.form-radio
            :label="__('public/adoption.form.section_3.housing_type')"
            name="accommodation_type"
            required
            layout="vertical"
            :options="[
                'house' => __('public/adoption.form.section_3.housing_house'),
                'appartement' => __('public/adoption.form.section_3.housing_apartment')
            ]"
            :value="old('accommodation_type')"
            :error="$errors->first('accommodation_type')"
        />

        <x-form.form-radio
            :label="__('public/adoption.form.section_3.garden')"
            name="garden"
            required
            layout="horizontal"
            :options="[
                'yes' => __('public/adoption.form.section_3.garden_yes'),
                'no' => __('public/adoption.form.section_3.garden_no')
            ]"
            :value="old('garden')"
            :error="$errors->first('garden')"
        />

        <x-form.form-textarea
            :label="__('public/adoption.form.section_3.other_pets')"
            name="has_other_pets"
            :value="old('has_other_pets')"
            :placeholder="__('public/adoption.form.section_3.other_pets_placeholder')"
            :helper="__('public/adoption.form.section_3.other_pets_helper')"
            :error="$errors->first('has_other_pets')"
        />

        <x-form.form-textarea
            :label="__('public/adoption.form.section_3.experience')"
            name="had_same"
            :value="old('had_same')"
            :placeholder="__('public/adoption.form.section_3.experience_placeholder')"
            :error="$errors->first('had_same')"
        />
    </x-form.form-section>

    {{-- SECTION 4: DISPONIBILITÉS --}}
    <x-form.form-section number="4" :title="__('public/adoption.form.section_4.title')">

        <x-form.form-checkbox-group
            :label="__('public/adoption.form.section_4.preferred_days')"
            name="available_days"
            required
            :helper="__('public/adoption.form.section_4.preferred_days_helper')"
            columns="2"
            :options="__('public/adoption.form.section_4.days')"
            :value="old('available_days', [])"
            :error="$errors->first('available_days')"
        />

        <x-form.form-checkbox-group
            :label="__('public/adoption.form.section_4.preferred_hours')"
            name="available_hours"
            required
            :helper="__('public/adoption.form.section_4.preferred_hours_helper')"
            columns="1"
            :options="__('public/adoption.form.section_4.hours')"
            :value="old('available_hours', [])"
            :error="$errors->first('available_hours')"
        />

        <x-form.form-radio
            :label="__('public/adoption.form.section_4.contact_method')"
            name="preferred_contact_method"
            required
            layout="horizontal"
            :options="[
                'phone' => __('public/adoption.form.section_4.contact_phone'),
                'email' => __('public/adoption.form.section_4.contact_email')
            ]"
            :value="old('preferred_contact_method')"
            :error="$errors->first('preferred_contact_method')"
        />
    </x-form.form-section>

    {{-- SECTION 5: MESSAGE --}}
    <x-form.form-section number="5" :title="__('public/adoption.form.section_5.title')">
        <x-form.form-textarea
            :label="__('public/adoption.form.section_5.message')"
            name="message"
            rows="5"
            :value="old('message')"
            :placeholder="__('public/adoption.form.section_5.message_placeholder')"
            :helper="__('public/adoption.form.section_5.message_helper')"
            :error="$errors->first('message')"
        />
    </x-form.form-section>

    {{-- SECTION 6: CONSENTEMENT --}}
    <x-form.form-section number="6" :title="__('public/adoption.form.section_6.title')">

        <x-form.form-checkbox
            name="rgpd"
            value="1"
            required
            :label="__('public/adoption.form.section_6.rgpd')"
            :checked="(bool)old('rgpd')"
            :error="$errors->first('rgpd')"
        />

        <x-form.form-checkbox
            name="newsletter_consent"
            value="1"
            :label="__('public/adoption.form.section_6.newsletter')"
            :checked="(bool)old('newsletter_consent')"
        />
    </x-form.form-section>

    <div
        class="bg-secondary-surface-default-subtle flex flex-col rounded-xl border border-secondary-border-default-subtle p-6 text-center">
        <p class="text-grayscale-text-subtitle mb-4">
            {{ __('public/adoption.form.submit_info') }}
        </p>
        <x-cta-button role="button">{{ __('public/adoption.form.submit_button') }}</x-cta-button>
    </div>

</form>
