<?php


use App\Concerns\HandleImages;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads, HandleImages;

    public User $user;

    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $phone = '';

    public $avatar;

    public function mount(): void
    {
        $this->user = Auth::user();

        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone ?? '';
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user->id)
            ],
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|max:2048',
        ];
    }

    public function save(): void
    {
        $this->validate();

        if ($this->avatar) {
            if ($this->user->avatar) {
                $this->deleteAvatarImage($this->user->avatar);
            }
            $this->user->avatar = $this->generateAvatarImage(
                $this->avatar,
                $this->first_name . ' ' . $this->last_name
            );
        }

        $this->user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        $this->avatar = null;
        $this->dispatch('profile-updated');
        session()->flash('success', 'Profile modifié avec succès !');
    }
}
?>

<section class="bg-white rounded-xl border border-neutral-200 p-6">
    <h2 class="text-2xl font-bold mb-6">Mon profil</h2>

    <form wire:submit="save">

        {{-- Avatar Section --}}
        <div class="mb-8 flex flex-col items-center">
            <div class="relative group">
                <div class="w-32 h-32 rounded-full border-2 border-dashed border-primary-surface-default overflow-hidden bg-neutral-100 flex items-center justify-center relative">

                    @if($avatar)
                        <img src="{{ $avatar->temporaryUrl() }}" class="w-full h-full object-cover" alt="Avatar temporaire">
                    @elseif($user->avatar)
                        {{-- On utilise l'accesseur du modèle --}}
                        <img src="{{ $user->thumbnail_url }}" alt="{{ $user->full_name }}" class="w-full h-full object-cover">
                    @endif

                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors"></div>
                </div>

                <label for="profile-avatar-upload" class="absolute bottom-0 right-0 w-10 h-10 bg-primary-surface-default text-white rounded-full flex items-center justify-center cursor-pointer hover:bg-primary-700 transition shadow-md border-2 border-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <input type="file" id="profile-avatar-upload" wire:model="avatar" accept="image/*" class="hidden">
                </label>

                <div wire:loading wire:target="avatar" class="absolute -bottom-8 left-1/2 -translate-x-1/2 text-xs text-primary-600 font-medium">
                    Chargement...
                </div>
            </div>
            @error('avatar') <p class="mt-2 text-sm text-error-text-link-light">{{ $message }}</p> @enderror
        </div>

        {{-- Prénom & Nom --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <x-form.form-input
                    label="Prénom"
                    name="first_name"
                    wire:model="first_name"
                    required
                    :error="$errors->first('user.first_name')"
                />
            </div>

            <div>
                <x-form.form-input
                    label="Nom"
                    name="last_name"
                    wire:model="last_name"
                    required
                    :error="$errors->first('user.last_name')"
                />
            </div>
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <x-form.form-input
                label="Email"
                name="email"
                type="email"
                wire:model="email"
                required
                :error="$errors->first('user.email')"
            />
        </div>

        {{-- Téléphone --}}
        <div class="mb-6">
            <x-form.form-input
                label="Téléphone"
                name="phone"
                type="tel"
                wire:model="phone"
                :error="$errors->first('phone')"
            />
        </div>

        {{-- Submit Button --}}
        <div class="flex justify-end gap-4 items-center">
            @if (session()->has('success'))
                <span class="text-sm text-green-600 animate-fade-in font-medium">
                    {{ session('success') }}
                </span>
            @endif

            <x-cta-button type="submit"
                          role="button"
                          size="sm"
                          wire:loading.attr="disabled">
                <span wire:loading.remove>Enregistrer les modifications</span>
            </x-cta-button>
        </div>
    </form>
</section>


