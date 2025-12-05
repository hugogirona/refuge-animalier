<?php

use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public array $user = [];

    public function mount(array $user): void
    {
        $this->user = $user;
    }
};
?>

<section class="bg-white rounded-xl border border-neutral-200 p-6">
        <h2 class="text-2xl font-bold mb-6">Mon profil</h2>

        <form>
            {{-- Avatar --}}
            <div class="mb-8 flex flex-col items-center">
                <div class="relative">
                    {{-- Avatar Circle --}}
                    <div class="w-40 h-40 rounded-full border-2 border-dashed border-primary-surface-default overflow-hidden bg-neutral-100 flex items-center justify-center">
                        @if($user['avatar'])
                            <img src="{{ $user['avatar'] }}" alt="Avatar de {{ $user['first_name'] }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-20 h-20 text-neut ral-400" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                            </svg>
                        @endif
                    </div>

                    {{-- Camera Button --}}
                    <label
                        for="avatar-upload"
                        class="absolute bottom-0 right-0 w-14 h-14 bg-primary-surface-default rounded-full flex items-center justify-center cursor-pointer hover:bg-primary-700 transition shadow-lg"
                        title="Changer la photo de profil"
                    >
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <input
                            type="file"
                            id="avatar-upload"
                            accept="image/*"
                            class="hidden"
                            aria-label="Changer la photo de profil"
                        >
                    </label>
                </div>
            </div>

            {{-- Prénom & Nom --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <x-form.form-input
                        label="Prénom"
                        name="first-name"
                        :value="$user['first_name']"
                        placeholder="Thomas"
                        required
                    />
                </div>

                <div>
                    <x-form.form-input
                        label="Nom"
                        name="last-name"
                        :value="$user['last_name']"
                        placeholder="Martin"
                        required
                    />
                </div>
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <x-form.form-input
                    label="Email"
                    name="email"
                    type="email"
                    :value="$user['email']"
                    placeholder="thomas.martin@refuge.be"
                    autocomplete="email"
                    required
                />
            </div>

            {{-- Téléphone --}}
            <div class="mb-6">
                <x-form.form-input
                    label="Téléphone"
                    name="phone"
                    type="tel"
                    :value="$user['phone'] ?? ''"
                    placeholder="+32 470 65 43 21"
                    icon="phone"
                />
            </div>

            {{-- Submit Button --}}
            <div>
                <x-cta-button role="button" size="sm">
                    Enregistrer les modifications
                </x-cta-button>
            </div>
        </form>
</section>
