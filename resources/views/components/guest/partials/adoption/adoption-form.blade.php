 <form id="adoptionForm" class="max-w-3xl mx-auto" novalidate>

     @csrf

        {{-- SECTION 1: IDENTITÉ --}}
        <x-form.form-section number="1" title="Vos informations">
            <x-form.form-input
                label="Prénom"
                name="first-name"
                required
                placeholder="Votre prénom"
                error="Ce champ est obligatoire"
            />

            <x-form.form-input
                label="Nom"
                name="last-name"
                required
                placeholder="Votre nom"
                error="Ce champ est obligatoire"
            />

            <x-form.form-input
                label="Email"
                name="email"
                type="email"
                required
                placeholder="votre.email@exemple.com"
                error="Adresse email invalide"
            />

            <x-form.form-input
                label="Téléphone"
                name="phone"
                type="tel"
                required
                placeholder="+32 2 123 45 67"
                error="Numéro de téléphone invalide"
            />
        </x-form.form-section>

        {{-- SECTION 2: COORDONNÉES --}}
        <x-form.form-section number="2" title="Votre adresse">
            <x-form.form-input
                label="Adresse"
                name="adress"
                required
                placeholder="Rue et numéro"
                error="Ce champ est obligatoire"
            />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-form.form-input
                    label="Code postal"
                    name="postalCode"
                    required
                    placeholder="1000"
                    pattern="[0-9]{4}"
                    error="Code postal invalide"
                />

                <x-form.form-input
                    label="Ville"
                    name="city"
                    required
                    placeholder="Bruxelles"
                    error="Ce champ est obligatoire"
                />
            </div>
        </x-form.form-section>

        {{-- SECTION 3: À PROPOS --}}
        <x-form.form-section number="3" title="À propos de vous">
            <x-form.form-radio
                label="Type de logement"
                name="habitation"
                required
                layout="vertical"
                :options="[
                    'maison' => 'Maison',
                    'appartement' => 'Appartement'
                ]"
            />

            <x-form.form-radio
                label="Disposez-vous d'un jardin ?"
                name="garden"
                required
                layout="horizontal"
                :options="[
                    'oui' => 'Oui',
                    'non' => 'Non'
                ]"
            />

            <x-form.form-textarea
                label="Avez-vous d'autres animaux ?"
                name="otherPets"
                placeholder="Si oui, lesquels ? (optionnel)"
                helper="Exemple : 1 chat, 2 chiens..."
            />

            <x-form.form-textarea
                label="Avez-vous déjà eu un chien ?"
                name="experience"
                placeholder="Parlez-nous de votre expérience (optionnel)"
            />
        </x-form.form-section>

        {{-- SECTION 4: DISPONIBILITÉS --}}
        <x-form.form-section number="4" title="Vos disponibilités">
            <x-form.form-checkbox-group
                label="Jours préférés pour un rendez-vous"
                name="days"
                required
                helper="Sélectionnez un ou plusieurs jours"
                columns="2"
                :options="[
                    'lundi' => 'Lundi',
                    'mardi' => 'Mardi',
                    'mercredi' => 'Mercredi',
                    'jeudi' => 'Jeudi',
                    'vendredi' => 'Vendredi',
                    'samedi' => 'Samedi',
                    'dimanche' => 'Dimanche',
                ]"
            />
            <x-form.form-checkbox-group
                label="Plages horaires préférées"
                name="hours"
                required
                helper="Sélectionnez une ou plusieurs plages"
                columns="1"
                :options="['matin' => 'Matin (9h-12h)',
                            'apres-midi' => 'Après-midi (14h-17h)',
                            'soir' => 'Soir (17h-19h)']"
            />


            <x-form.form-radio
                label="Mode de contact préféré"
                name="contact"
                required
                layout="horizontal"
                :options="[
                    'telephone' => 'Téléphone',
                    'email' => 'Email'
                ]"
            />
        </x-form.form-section>

        {{-- SECTION 5: MESSAGE --}}
        <x-form.form-section number="5" title="Votre message">
            <x-form.form-textarea
                label="Message libre (optionnel)"
                name="message"
                rows="5"
                placeholder="Parlez-nous de vous, de votre motivation..."
                helper="Ce message nous aidera à mieux vous connaître"
            />
        </x-form.form-section>

        {{-- SECTION 6: CONSENTEMENT --}}
        <x-form.form-section number="6" title="Consentement">
            <x-form.form-checkbox
                name="rgpd"
                value="rgpd"
                required
                label="J'accepte que mes données personnelles soient utilisées pour traiter ma demande d'adoption."
            />

            <x-form.form-checkbox
                name="newsletter"
                value="newsletter"
                required
                label="Je souhaite recevoir des nouvelles du refuge et des animaux disponibles"
            />

        </x-form.form-section>

        <div class="bg-secondary-surface-default-subtle flex flex-col rounded-xl border border-secondary-border-default-subtle p-6 text-center">
            <p class="text-grayscale-text-subtitle mb-4">
                Vous recevrez un email de confirmation après l'envoi de votre demande
            </p>
            <x-cta-button role="button">Envoyer ma demande</x-cta-button>
        </div>

    </form>

