<section class="bg-white rounded-xl border border-neutral-200 p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold">Notes internes</h2>
    </div>

    <div class="space-y-4 mb-6">

        <x-admin.partials.pets.internal-notes-item
            author="Marc Leroy"
            time="Il y a 3 heures"
        >
            Visite du refuge effectuée. Très bon feeling avec Moka.
        </x-admin.partials.pets.internal-notes-item>
    </div>

    {{-- Formulaire d'ajout --}}
    <form class="flex gap-4 pt-4 border-t border-neutral-200">
        <img
            src="{{asset('storage/images/team/elise_1x.webp')}}"
            alt="avatar de Elise Dubois"
            class="w-12 h-12 rounded-full shrink-0"
        >
        <div class="flex-1">
            <x-form.form-textarea
                name="internalNotes"
                label="Elise Dubois"
                placeholder="Ajouter une note..."

            />
            <div class="mt-3">
                <x-cta-button size="sm" role="button">
                    Ajouter
                </x-cta-button>
            </div>
        </div>
    </form>
</section>
