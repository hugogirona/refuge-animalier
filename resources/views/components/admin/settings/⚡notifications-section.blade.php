<?php

use Livewire\Component;

new class extends Component {
    public array $notifications = [];

    public function mount(array $notifications): void
    {
        $this->notifications = $notifications;
    }
};
?>

<section class="bg-white rounded-xl border border-neutral-200 p-6">
        <h2 class="text-2xl font-bold mb-6">Notifications</h2>

        <form>
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">

                    <x-form.form-checkbox-group
                        label="Recevoir un email pour"
                        name="email-notifications"
                        :columns="1"
                        :options="[
                            'new_adoption' => 'Nouvelle demande d\'adoption',
                            'new_pet' => 'Nouvelle fiche créée (par bénévole)',
                            'new_message' => 'Nouveau message',
                            'pet_update' => 'Modification de fiche',
                        ]"
                    />

                    <x-form.form-radio
                        label="Fréquence"
                        name="email-frequency"
                        layout="vertical"
                        :options="[
                            'immediate' => 'Immédiatement',
                            'daily' => 'Résumé quotidien',
                            'weekly' => 'Résumé hebdomadaire',
                            'never ' => 'Jamais',
                        ]"
                        required
                    />
                </div>

            <div>
                <x-cta-button role="button" size="sm">
                    Enregistrer les préférences
                </x-cta-button>
            </div>
        </form>
</section>
