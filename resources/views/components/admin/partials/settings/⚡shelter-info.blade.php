<?php


use App\Models\Shelter;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public Shelter $shelter;

    public string $name = '';
    public string $address = '';
    public string $zip_code = '';
    public string $city = '';
    public string $phone = '';
    public string $email = '';

    public function mount(): void
    {
        $this->shelter = Shelter::firstOrFail();

        $this->name = $this->shelter->name;
        $this->address = $this->shelter->address;
        $this->zip_code = $this->shelter->zip_code;
        $this->city = $this->shelter->city;
        $this->phone = $this->shelter->phone;
        $this->email = $this->shelter->email;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ];
    }

    public function save(): void
    {
        $this->validate();

        $this->shelter->update([
            'name' => $this->name,
            'address' => $this->address,
            'zip_code' => $this->zip_code,
            'city' => $this->city,
            'phone' => $this->phone,
            'email' => $this->email,
        ]);

        $this->dispatch('shelter-updated');
        session()->flash('success', 'Paramètres du refuge enregistrés !');
    }
}
?>

<section class="bg-white rounded-xl border border-neutral-200 p-6">
    <h2 class="text-2xl font-bold mb-6">Coordonnées du refuge</h2>

    <form wire:submit="save">

        <div class="mb-4">
            <x-form.form-input
                label="Nom du refuge"
                name="name"
                wire:model="name"
                required
                :error="$errors->first('name')"
            />
        </div>


        {{-- Adresse --}}
        <div class="mb-4">
            <x-form.form-input
                label="Adresse"
                name="address"
                wire:model="address"
                placeholder="123 Rue des Animaux"
                required
                :error="$errors->first('address')"
            />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <x-form.form-input
                    label="Code postal"
                    name="zip_code"
                    wire:model="zip_code"
                    placeholder="1000"
                    required
                    :error="$errors->first('zip_code')"
                />
            </div>

            <div>
                <x-form.form-input
                    label="Ville"
                    name="city"
                    wire:model="city"
                    placeholder="Bruxelles"
                    required
                    :error="$errors->first('city')"
                />
            </div>
        </div>

        <div class="mb-4">
            <x-form.form-input
                label="Téléphone"
                name="phone"
                type="tel"
                wire:model="phone"
                placeholder="+32 2 123 45 67"
                required
                :error="$errors->first('phone')"
            />
        </div>

        {{-- Email --}}
        <div class="mb-6">
            <x-form.form-input
                label="Email"
                name="email"
                type="email"
                wire:model="email"
                placeholder="contact@pattesheureuses.be"
                autocomplete="email"
                required
                :error="$errors->first('email')"
            />
        </div>

        {{-- Submit Button --}}
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
                <span wire:loading.remove>Enregistrer les modifications</span>
                <span wire:loading>Sauvegarde...</span>
            </x-cta-button>
        </div>

    </form>
</section>


