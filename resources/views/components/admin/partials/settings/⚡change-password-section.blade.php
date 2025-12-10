<?php

use Livewire\Component;

new class extends Component {
    public string $current_password = '';

    public function mount(): void
    {
        //
    }
};
?>

<section class="bg-white rounded-xl border border-neutral-200 p-6">
        <h2 class="text-2xl font-bold mb-6">Sécurité</h2>

        <form>
            @csrf
            {{-- Mot de passe actuel --}}
            <div class="mb-4">
                <x-form.form-input
                    label="Mot de passe actuel"
                    name="current_password"
                    type="password"
                    placeholder="••••••••"
                    :showPasswordToggle="true"
                    autocomplete="current-password"
                    required
                />
            </div>

            {{-- Nouveau mot de passe --}}
            <div class="mb-2">
                <x-form.form-input
                    label="Nouveau mot de passe"
                    name="new_password"
                    type="password"
                    placeholder="••••••••"
                    :showPasswordToggle="true"
                    required
                />
            </div>

            {{-- Info box --}}
            <div
                class="bg-secondary-surface-default-subtle border border-secondary-border-default-subtle rounded-lg p-4 mb-6 flex items-start gap-3">
                <svg class="w-5 h-5 text-secondary-text-link-light flex-shrink-0 mt-0.5" fill="currentColor"
                     viewBox="0 0 20 20" aria-hidden="true">
                    <path fill-rule="evenodd"
                          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                          clip-rule="evenodd"/>
                </svg>
                <p class="text-sm text-grayscale-text-subtitle">
                    Laissez vide si vous ne souhaitez pas changer votre mot de passe
                </p>
            </div>

            {{-- Submit Button --}}
            <div>
                <x-cta-button role="button" size="sm">
                    Changer le mot de passe
                </x-cta-button>
            </div>
        </form>
</section>
