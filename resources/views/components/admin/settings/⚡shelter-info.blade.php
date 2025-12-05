<?php

use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public array $shelter = [];
    public $logo;
    public $temporaryLogo;

    public function mount(array $shelter): void
    {
        $this->shelter = $shelter;
    }

    public function updatedLogo(): void
    {
        $this->validate([
            'logo' => 'image|max:2048',
        ]);

        $this->temporaryLogo = $this->logo->temporaryUrl();
    }

    public function removeLogo(): void
    {
        $this->shelter['logo'] = null;
        $this->logo = null;
        $this->temporaryLogo = null;
    }
};
?>
<section class="bg-white rounded-xl border border-neutral-200 p-6">
        <h2 class="text-2xl font-bold mb-6">Coordonnées du refuge</h2>

        <form wire:submit="save">

                {{-- Adresse --}}
                <div class="mb-4">
                    <x-form.form-input
                        label="Adresse"
                        name="address"
                        wireModel="shelter.address"
                        :value="$shelter['address']"
                        placeholder="123 Rue des Animaux"
                        required
                    />
                    @error('shelter.address')
                    <p class="mt-2 text-sm text-error-text-link-light">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Code postal & Ville --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <x-form.form-input
                            label="Code postal"
                            name="postal-code"
                            wireModel="shelter.postal_code"
                            :value="$shelter['postal_code']"
                            placeholder="1000"
                            required
                        />
                        @error('shelter.postal_code')
                        <p class="mt-2 text-sm text-error-text-link-light">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <x-form.form-input
                            label="Ville"
                            name="city"
                            wireModel="shelter.city"
                            :value="$shelter['city']"
                            placeholder="Bruxelles"
                            required
                        />
                        @error('shelter.city')
                        <p class="mt-2 text-sm text-error-text-link-light">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Téléphone --}}
                <div class="mb-4">
                    <x-form.form-input
                        label="Téléphone"
                        name="phone"
                        type="tel"
                        wireModel="shelter.phone"
                        :value="$shelter['phone']"
                        placeholder="+32 2 123 45 67"
                        required
                    />
                    @error('shelter.phone')
                    <p class="mt-2 text-sm text-error-text-link-light">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-6">
                    <x-form.form-input
                        label="Email"
                        name="email"
                        type="email"
                        wireModel="shelter.email"
                        :value="$shelter['email']"
                        placeholder="contact@pattesheureuses.be"
                        autocomplete="email"
                        required
                    />
                    @error('shelter.email')
                    <p class="mt-2 text-sm text-error-text-link-light">{{ $message }}</p>
                    @enderror
                </div>

            {{-- Submit Button --}}
            <div>
                <x-cta-button role="button" size="sm">
                    Enregistrer les modifications
                </x-cta-button>
            </div>
        </form>
</section>
