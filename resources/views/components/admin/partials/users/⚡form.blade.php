<?php

namespace App\Livewire\Admin\Users;

use App\Concerns\HandleImages;
use App\Mail\UserCreated;
use App\Models\User;
use App\Enums\UserRoles;
use App\Enums\UserStatus;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

new class extends Component {
    use WithFileUploads, HandleImages;

    public ?string $model_id = null;

    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $phone = '';
    public string $role = '';
    public string $status = '';
    public string $password = '';

    public $photo = null;
    public ?string $existing_photo_path = null;

    public array $roles_options = [];
    public array $status_options = [];

    public function mount(?string $model_id = null): void
    {
        $this->model_id = $model_id;
        $this->loadOptions();

        if ($this->model_id) {
            $user = User::findOrFail($this->model_id);
            $this->first_name = $user->first_name;
            $this->last_name = $user->last_name;
            $this->email = $user->email;
            $this->phone = $user->phone ?? '';
            $this->role = $user->role;
            $this->status = $user->status;
            $this->existing_photo_path = $user->avatar;
        } else {
            $this->role = UserRoles::VOLUNTEER->value;
            $this->status = UserStatus::ACTIVE->value;
            $this->generatePassword();
        }
    }

    public function loadOptions(): void
    {
        $this->roles_options = [
            UserRoles::ADMIN->value => 'Administrateur',
            UserRoles::VOLUNTEER->value => 'Bénévole',
        ];

        $this->status_options = [
            UserStatus::ACTIVE->value => 'Actif',
            UserStatus::INACTIVE->value => 'Inactif',
        ];
    }

    public function generatePassword(): void
    {
        $this->password = Str::random(10) . '!';
    }

    public function save(): void
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->model_id)
            ],
            'phone' => 'nullable|string|max:20',
            'role' => ['required', Rule::enum(UserRoles::class)],
            'status' => ['required', Rule::enum(UserStatus::class)],
            'photo' => 'nullable|image|max:2048', // 2MB
        ];

        if (!$this->model_id) {
            $rules['password'] = 'required|min:8';
        } else {
            $rules['password'] = 'nullable|min:8';
        }

        $this->validate($rules);

        $data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->role,
            'status' => $this->status,
        ];

        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->photo) {
            if ($this->model_id && $user->avatar) {
                $this->deleteAvatarImage($user->avatar);
            }

            $data['avatar'] = $this->generateAvatarImage($this->photo, $this->first_name . ' ' . $this->last_name);
        }

        if ($this->model_id) {
            $user = User::findOrFail($this->model_id);
            $user->update($data);
        } else {
            $user = User::create($data);

            Mail::to($user->email)->send(new UserCreated($user, $this->password));
        }

        $this->dispatch('close_modal');
        $this->dispatch('refresh-users-table');

        session()->flash('success', $this->model_id ? 'Utilisateur mis à jour.' : 'Utilisateur créé.');
    }

    public function isEditing(): bool
    {
        return !empty($this->model_id);
    }
}
?>

<section class="p-6 max-h-[94vh] overflow-y-auto">

    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold mb-6">
            {{ $this->isEditing() ? 'Éditer l\'utilisateur' : 'Nouvel utilisateur' }}
        </h2>
    </div>

    <form wire:submit="save" class="space-y-6">

        <div class="flex justify-center mb-6">
            <div class="relative group cursor-pointer">
                <label for="avatar-upload" class="block cursor-pointer">
                    <div
                        class="w-32 h-32 rounded-full border-2 border-dashed border-primary-border-default flex items-center justify-center overflow-hidden bg-neutral-50 relative">

                        @if($photo)
                            <img src="{{ $photo->temporaryUrl() }}"
                                 alt="Avatar temporaire"
                                 class="w-full h-full object-cover">

                        @elseif($existing_photo_path)
                            <img src="{{ asset('storage/' . $existing_photo_path) }}"
                                 alt="Avatar de l'utilisateur"
                                 class="w-full h-full object-cover">
                        @else
                            <div
                                class="w-full h-full bg-[url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAAXNSR0IArs4c6QAAACNJREFUKFNjMq6795+BCoCJgYGh/8c/7Ohg4F5x7/9/1IEAAP10DPzR+2WRAAAAAElFTkSuQmCC')] opacity-20"></div>
                        @endif

                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors"></div>
                    </div>

                    <div
                        class="absolute bottom-0 right-2 w-10 h-10 bg-primary-surface-default text-white rounded-full flex items-center justify-center border-2 border-white shadow-sm hover:scale-105 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </label>
                <input type="file" id="avatar-upload" wire:model="photo" accept="image/*" class="hidden">
            </div>
        </div>

        @error('photo') <p class="text-center text-sm text-error-text-link-light">{{ $message }}</p> @enderror


        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-form.form-input
                label="Prénom"
                name="first_name"
                :required="true"
                placeholder="John"
                wire:model="first_name"
                :error="$errors->first('first_name')"
            />

            <x-form.form-input
                label="Nom"
                name="last_name"
                :required="true"
                placeholder="Doe"
                wire:model="last_name"
                :error="$errors->first('last_name')"
            />
        </div>

        <x-form.form-input
            label="Email"
            name="email"
            type="email"
            :required="true"
            placeholder="johndoe@email.com"
            wire:model="email"
            :error="$errors->first('email')"
        />

        <x-form.form-input
            label="Téléphone"
            name="phone"
            type="tel"
            placeholder="06 12 34 56 78"
            wire:model="phone"
            :error="$errors->first('phone')"
        />

        <x-form.form-radio
            label="Rôle"
            name="role"
            :required="true"
            layout="horizontal"
            :options="$roles_options"
            wire:model="role"
            :error="$errors->first('role')"
        />

        <x-form.form-select
            label="Statut"
            name="status"
            :required="true"
            :options="$status_options"
            wire:model="status"
            :error="$errors->first('status')"
        />

        <div class="flex flex-col gap-1 mb-4">
            <label class="block text-sm font-medium text-grayscale-text-subtitle mb-1">
                {{ $this->isEditing() ? 'Nouveau mot de passe (laisser vide pour conserver)' : 'Mot de passe temporaire' }}
                <span class="text-primary-text-link-light">*</span>
            </label>
            <div class="flex gap-2">
                <div class="grow">
                    <input
                        type="text"
                        wire:model="password"
                        placeholder="Générer ou saisir..."
                        class="w-full px-4 py-2 border border-neutral-300 rounded-lg focus:ring-primary-border-default focus:border-primary-border-default"
                    >
                </div>
                <button
                    type="button"
                    wire:click="generatePassword"
                    class="p-2 border border-primary-border-default text-primary-text-link-light rounded-lg hover:bg-primary-surface-default-subtle transition-colors"
                    title="Générer un mot de passe"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                </button>
            </div>
            @error('password') <p class="text-error-text-link-light text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-4 justify-end py-4 border-t border-neutral-200 bg-white">
            <x-cta-button
                role="button"
                type="button"
                variant="secondary"
                wire:click="$dispatch('close_modal')"

            >
                Annuler
            </x-cta-button>

            <x-cta-button
                role="button"
                type="submit"
                variant="primary"
                icon="check"
                wire:loading.attr="disabled"
                wire:target="save"
                class="w-full"
            >
                <span wire:loading.remove wire:target="save">
                    {{ $this->isEditing() ? 'Enregistrer' : 'Créer' }}
                </span>
                <span wire:loading wire:target="save">
                    Enregistrement...
                </span>
            </x-cta-button>
        </div>


    </form>
</section>


