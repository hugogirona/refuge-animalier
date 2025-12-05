<div class="bg-white rounded-xl border border-neutral-200 p-6 md:p-8">
    <h2 class="text-2xl font-bold text-neutral-900 mb-2">{{ __('public/contact.form.title') }}</h2>
    <p class="text-neutral-600 mb-6">
        {{ __('public/contact.form.subtitle') }}
    </p>

    <form id="contactForm" class="flex flex-col gap-4">

        {{-- Nom --}}
        <x-form.form-input
            :label="__('public/contact.form.fields.name')"
            name="name"
            required
            :placeholder="__('public/contact.form.fields.name_placeholder')"
            :error="__('public/contact.form.errors.required')"
        />

        {{-- Email --}}
        <x-form.form-input
            :label="__('public/contact.form.fields.email')"
            name="email"
            type="email"
            required
            :placeholder="__('public/contact.form.fields.email_placeholder')"
            :error="__('ublic/contact.form.errors.email')"
        />

        {{-- Téléphone --}}
        <x-form.form-input
            :label="__('public/contact.form.fields.phone')"
            name="phone"
            type="tel"
            :placeholder="__('public/contact.form.fields.phone_placeholder')"
        />

        {{-- Sujet --}}
        <x-form.form-select
            :label="__('public/contact.form.fields.subject')"
            name="subject"
            required
            :placeholder="__('public/contact.form.fields.subject_placeholder')"
            :options="__('public/contact.form.subjects')"
            :value="request('subject', '')"
            :error="__('public/contact.form.errors.subject')"
        />

        {{-- Message --}}
        <x-form.form-textarea
            :label="__('public/contact.form.fields.message')"
            name="message"
            required
            rows="5"
            :placeholder="__('public/contact.form.fields.message_placeholder')"
            :error="__('public/contact.form.errors.required')"
        />

        {{-- RGPD --}}
        <x-form.form-checkbox
            name="rgpd"
            value="rgpd"
            required
            :label="__('public/contact.form.fields.rgpd')"
        />

        {{-- Submit Button --}}
        <x-cta-button role="button">{{ __('public/contact.form.submit') }}</x-cta-button>

    </form>
</div>
