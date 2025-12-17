<div class="bg-white rounded-xl border border-neutral-200 p-6 md:p-8">
    {{-- ... --}}

    {{-- CORRECTION 1 : method POST et action --}}
    <form id="contactForm" method="POST" action="{{ route('contact.store') }}" class="flex flex-col gap-4" novalidate>
        @csrf

        {{-- Nom --}}
        <x-form.form-input
            :label="__('public/contact.form.fields.name')"
            name="name"
            required
            :value="old('name')"
            :placeholder="__('public/contact.form.fields.name_placeholder')"
            :error="$errors->first('name')"
        />

        <x-form.form-input
            :label="__('public/contact.form.fields.email')"
            name="email"
            type="email"
            required
            :value="old('email')"
            :placeholder="__('public/contact.form.fields.email_placeholder')"
            :error="$errors->first('email')"
        />

        <x-form.form-input
            :label="__('public/contact.form.fields.phone')"
            name="phone"
            type="tel"
            :value="old('phone')"
            :placeholder="__('public/contact.form.fields.phone_placeholder')"
            :error="$errors->first('phone')"
        />

        {{-- Sujet --}}
        <x-form.form-select
            :label="__('public/contact.form.fields.subject')"
            name="subject"
            required
            :placeholder="__('public/contact.form.fields.subject_placeholder')"
            :options="__('public/contact.form.subjects')"
            :value="old('subject', request('subject', ''))"
            :error="$errors->first('subject')"
        />

        <x-form.form-textarea
            :label="__('public/contact.form.fields.message')"
            name="content"
            required
            rows="5"
            :value="old('content')"
            :placeholder="__('public/contact.form.fields.message_placeholder')"
            :error="$errors->first('content')"
        />

        {{-- RGPD --}}
        <x-form.form-checkbox
            name="rgpd"
            value="1"
            required
            :label="__('public/contact.form.fields.rgpd')"
            :checked="(bool)old('rgpd')"
            :error="$errors->first('rgpd')"
        />

        {{-- Submit Button --}}
        <x-cta-button role="button">{{ __('public/contact.form.submit') }}</x-cta-button>

    </form>
</div>
