<?php

use Livewire\Component;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Illuminate\Support\Facades\Auth;

new class extends Component
{
    public array $state = [
        'current_password' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    public function save(UpdatesUserPasswords $updater): void
    {
        $this->state['password_confirmation'] = $this->state['password'];

        $updater->update(Auth::user(), $this->state);

        $this->reset('state');
        session()->flash('success', 'Mot de passe modifié avec succès !');
    }

}

?>


<section class="bg-white rounded-xl border border-neutral-200 p-6">
    <h2 class="text-2xl font-bold mb-6">Sécurité</h2>

    <form wire:submit="save">

        <div class="mb-4">
            <x-form.form-input
                label="Mot de passe actuel"
                name="current_password"
                type="password"
                wire:model="state.current_password"
                placeholder="••••••••"
                :showPasswordToggle="true"
                autocomplete="current-password"
                required
                :error="$errors->first('current_password')"
            />
        </div>

        <div class="mb-2">
            <x-form.form-input
                label="Nouveau mot de passe"
                name="password"
                type="password"
                wire:model="state.password"
                placeholder="••••••••"
                :showPasswordToggle="true"
                required
                :error="$errors->first('password')"
            />
        </div>

        <div class="bg-secondary-surface-default-subtle border border-secondary-border-default-subtle rounded-lg p-4 mb-6 flex items-start gap-3">
            <svg class="w-5 h-5 text-secondary-text-link-light shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            <p class="text-sm text-grayscale-text-subtitle">
                Votre nouveau mot de passe doit contenir au moins 8 caractères.
            </p>
        </div>

        <div class="flex justify-end gap-4 items-center">
            @if (session()->has('success'))
                <span class="text-sm text-green-600 animate-fade-in font-medium">
                    {{ session('success') }}
                </span>
            @endif

            <x-cta-button
                type="submit"
                role="button"
                size="sm"
                wire:loading.attr="disabled"
            >
                <span wire:loading.remove>Changer le mot de passe</span>
                <span wire:loading>Traitement...</span>
            </x-cta-button>
        </div>
    </form>
</section>



