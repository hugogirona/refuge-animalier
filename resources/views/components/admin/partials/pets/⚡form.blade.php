<?php

use App\Events\PetUpdated;
use App\Models\Pet;
use App\Models\Breed;
use App\Enums\PetSex;
use App\Enums\PetStatus;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    use WithFileUploads;

    public ?string $model_id = null;

    // Champs du formulaire
    public string $name = '';
    public string $species = '';
    public ?int $breed_id = null;
    public string $sex = '';
    public string $coat_color = '';
    public ?string $birth_date = null;
    public ?string $last_vet_visit = null;
    public ?string $vaccinations = null;
    public bool $sterilized = false;
    public string $personality = '';
    public string $story = '';
    public string $status = '';
    public $photo = null;
    public ?string $existing_photo_path = null;
    public bool $is_published = false;
    public ?string $arrived_at = null;

    // Pour les selects
    public array $breeds = [];
    public array $species_options = [];
    public array $sex_options = [];
    public array $status_options = [];

    public function mount(?string $model_id = null): void
    {
        $this->model_id = $model_id;
        $this->loadSelectOptions();

        if ($this->model_id) {
            $pet = Pet::with('breed')->findOrFail($this->model_id);

            $this->name = $pet->name;
            $this->species = $pet->species->value;
            $this->breed_id = $pet->breed_id;
            $this->sex = $pet->sex->value;
            $this->coat_color = $pet->coat_color;
            $this->birth_date = $pet->birth_date?->format('Y-m-d');
            $this->last_vet_visit = $pet->last_vet_visit?->format('Y-m-d');
            $this->vaccinations = $pet->vaccinations;
            $this->sterilized = $pet->sterilized;
            $this->personality = $pet->personality;
            $this->story = $pet->story;
            $this->status = $pet->status->value;
            $this->existing_photo_path = $pet->photo_path;
            $this->is_published = $pet->is_published;
            $this->arrived_at = $pet->arrived_at?->format('Y-m-d');
        } else {
            $this->sex = PetSex::UNKNOWN->value;
            $this->status = PetStatus::AVAILABLE->value;
        }
    }

    public function loadSelectOptions(): void
    {
        $this->species_options = [
            'dog' => __('Chien'),
            'cat' => __('Chat'),
        ];

        $this->sex_options = collect(PetSex::cases())
            ->mapWithKeys(fn($case) => [$case->value => __($case->value)])
            ->toArray();

        $this->status_options = collect(PetStatus::cases())
            ->mapWithKeys(fn($case) => [$case->value => __($case->value)])
            ->toArray();

        $this->breeds = Breed::orderBy('name')
            ->get()
            ->pluck('name', 'id')
            ->toArray();

    }

    public function updatedSpecies($value): void
    {
        $this->breeds = Breed::where('species', $value)
            ->orderBy('name')
            ->get()
            ->pluck('name', 'id')
            ->toArray();

        if ($this->breed_id) {
            $breed = Breed::find($this->breed_id);
            if (!$breed || $breed->species !== $value) {
                $this->breed_id = null;
            }
        }
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|in:dog,cat',
            'breed_id' => 'required|exists:breeds,id',
            'sex' => 'required|string',
            'coat_color' => 'required|string|max:255',
            'birth_date' => 'nullable|date|before:today',
            'last_vet_visit' => 'nullable|date|before_or_equal:today',
            'vaccinations' => 'nullable|string',
            'sterilized' => 'boolean',
            'personality' => 'required|string|min:50',
            'story' => 'required|string|min:100',
            'status' => 'required|string',
            'photo' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
            'arrived_at' => 'nullable|date|before_or_equal:today',
        ], [
            'name.required' => 'Le nom est obligatoire',
            'species.required' => 'L\'espèce est obligatoire',
            'breed_id.required' => 'La race est obligatoire',
            'sex.required' => 'Le sexe est obligatoire',
            'coat_color.required' => 'La couleur du pelage est obligatoire',
            'personality.required' => 'La personnalité est obligatoire',
            'personality.min' => 'La personnalité doit contenir au moins 50 caractères',
            'story.required' => 'L\'histoire est obligatoire',
            'story.min' => 'L\'histoire doit contenir au moins 100 caractères',
            'photo.image' => 'Le fichier doit être une image',
            'photo.max' => 'L\'image ne doit pas dépasser 2 Mo',
        ]);

        $data = [
            'name' => $this->name,
            'species' => $this->species,
            'breed_id' => $this->breed_id,
            'sex' => $this->sex,
            'coat_color' => $this->coat_color,
            'birth_date' => $this->birth_date,
            'last_vet_visit' => $this->last_vet_visit,
            'vaccinations' => $this->vaccinations,
            'sterilized' => $this->sterilized,
            'personality' => $this->personality,
            'story' => $this->story,
            'status' => $this->status,
            'is_published' => $this->is_published,
            'arrived_at' => $this->arrived_at,
        ];

        if ($this->photo) {
            $data['photo_path'] = $this->photo->store('pets', 'public');
        }

        if ($this->model_id) {
            $pet = Pet::findOrFail($this->model_id);

            if ($this->photo && $pet->photo_path) {
                \Storage::disk('public')->delete($pet->photo_path);
            }

            $pet->update($data);

            event(new PetUpdated($pet->fresh()));

        } else {
            $data['created_by'] = Auth::id();

            if ($this->is_published) {
                $data['published_by'] = Auth::id();
                $data['published_at'] = now();
            }

            $pet = Pet::create($data);

            event(new PetUpdated($pet));
        }

        $this->dispatch('close_modal');
        $this->dispatch('pet-saved');

    }

    public function isEditing(): bool
    {
        return !empty($this->model_id);
    }
};
?>

<div class="p-6 max-h-[94vh] overflow-y-auto">
    <h2 class="text-2xl font-bold mb-6">
        {{ $this->isEditing() ? 'Éditer l\'animal' : 'Ajouter un animal' }}
    </h2>

    <form wire:submit="save" class="space-y-6">

        {{-- Section Informations Générales --}}
        <fieldset class="bg-neutral-50 p-4 rounded-lg">
            <legend class="text-lg font-semibold mb-4">Informations générales</legend>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Nom --}}
                <x-form.form-input
                    label="Nom"
                    name="name"
                    :required="true"
                    placeholder="Ex: Moka"
                    wire:model="name"
                    :error="$errors->first('name')"
                />

                {{-- Espèce --}}
                <x-form.form-select
                    label="Espèce"
                    name="species"
                    :required="true"
                    placeholder="Sélectionner une espèce"
                    :options="$species_options"
                    :value="$species"
                    wire:model.live="species"
                    :error="$errors->first('species')"
                />

                {{-- Race --}}
                <x-form.form-select
                    label="Race"
                    name="breed_id"
                    :required="true"
                    placeholder="Sélectionner une race"
                    :options="$breeds"
                    :value="$breed_id"
                    wire:model="breed_id"
                    :error="$errors->first('breed_id')"
                />

                {{-- Sexe --}}
                <x-form.form-select
                    label="Sexe"
                    name="sex"
                    :required="true"
                    placeholder="Sélectionner un sexe"
                    :options="$sex_options"
                    :value="$sex"
                    wire:model="sex"
                    :error="$errors->first('sex')"
                />

                {{-- Couleur du pelage --}}
                <x-form.form-input
                    label="Couleur du pelage"
                    name="coat_color"
                    :required="true"
                    placeholder="Ex: Brun, Noir et blanc..."
                    wire:model="coat_color"
                    :error="$errors->first('coat_color')"
                />

                {{-- Date de naissance --}}
                <x-form.form-input
                    label="Date de naissance"
                    name="birth_date"
                    type="date"
                    wire:model="birth_date"
                    :error="$errors->first('birth_date')"
                />

                {{-- Date d'arrivée --}}
                <x-form.form-input
                    label="Date d'arrivée au refuge"
                    name="arrived_at"
                    type="date"
                    wire:model="arrived_at"
                    :error="$errors->first('arrived_at')"
                />

                {{-- Statut --}}
                <x-form.form-select
                    label="Statut"
                    name="status"
                    :required="true"
                    placeholder="Sélectionner un statut"
                    :options="$status_options"
                    :value="$status"
                    wire:model="status"
                    :error="$errors->first('status')"
                />
            </div>
        </fieldset>

        <fieldset class="bg-neutral-50 p-4 rounded-lg">
            <legend class="text-lg font-semibold mb-4">Santé</legend>

            <div class="flex flex-col gap-4">
                {{-- Dernière visite vétérinaire --}}
                <x-form.form-input
                    label="Dernière visite vétérinaire"
                    name="last_vet_visit"
                    type="date"
                    wire:model="last_vet_visit"
                    :error="$errors->first('last_vet_visit')"
                />

                {{-- Stérilisé --}}
                <x-form.form-checkbox
                    label="Animal stérilisé"
                    name="sterilized"
                    :checked="$sterilized"
                    wire:model="sterilized"
                />

                {{-- Vaccinations --}}
                <x-form.form-textarea
                    label="Vaccinations et traitements"
                    name="vaccinations"
                    :rows="3"
                    placeholder="Ex: Vaccins à jour - Prochain rappel en mars 2025"
                    :value="$vaccinations"
                    wire:model="vaccinations"
                    :error="$errors->first('vaccinations')"
                />
            </div>
        </fieldset>


        {{-- Section Description --}}
        <fieldset class="bg-neutral-50 p-4 rounded-lg">
            <legend class="text-lg font-semibold mb-4">Description</legend>

            <div class="space-y-4">
                {{-- Personnalité --}}
                <x-form.form-textarea
                    label="Personnalité"
                    name="personality"
                    :required="true"
                    :rows="4"
                    :minLength="50"
                    :showCounter="true"
                    placeholder="Décrivez la personnalité de l'animal..."
                    :value="$personality"
                    wire:model="personality"
                    :error="$errors->first('personality')"
                />

                {{-- Histoire --}}
                <x-form.form-textarea
                    label="Histoire"
                    name="story"
                    :required="true"
                    :rows="6"
                    :minLength="100"
                    :showCounter="true"
                    placeholder="Racontez l'histoire de l'animal..."
                    :value="$story"
                    wire:model="story"
                    :error="$errors->first('story')"
                />
            </div>
        </fieldset>

        {{-- Section Photo --}}
        <fieldset class="bg-neutral-50 p-4 rounded-lg">
            <legend class="text-lg font-semibold mb-4">Photo</legend>

            <div>
                @if($existing_photo_path && !$photo)
                    <div class="mb-4">
                        <p class="text-sm text-neutral-600 mb-2">Photo actuelle :</p>
                        <img
                            src="{{ asset('storage/' . $existing_photo_path) }}"
                            alt="Photo actuelle"
                            class="w-32 h-32 object-cover rounded-lg"
                        >
                    </div>
                @endif

                @if($photo)
                    <div class="mb-4">
                        <p class="text-sm text-neutral-600 mb-2">Nouvelle photo :</p>
                        <img
                            src="{{ $photo->temporaryUrl() }}"
                            alt="Aperçu"
                            class="w-32 h-32 object-cover rounded-lg"
                        >
                    </div>
                @endif

                <div>
                    <label for="photo" class="block text-sm font-medium text-grayscale-text-subtitle mb-2">
                        {{ $existing_photo_path ? 'Changer la photo' : 'Ajouter une photo' }}
                    </label>
                    <input
                        type="file"
                        id="photo"
                        wire:model="photo"
                        accept="image/*"
                        class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-border-default focus:border-transparent
                            {{ $errors->first('photo') ? 'border-error-text-link-light!' : '' }}"
                    >
                    @if($errors->first('photo'))
                        <p class="text-error-text-link-light text-sm mt-1">{{ $errors->first('photo') }}</p>
                    @endif

                    <div wire:loading wire:target="photo" class="text-sm text-primary-600 mt-2">
                        Chargement de l'image...
                    </div>
                </div>
            </div>
        </fieldset>

        {{-- Section Publication --}}
        <fieldset class="bg-neutral-50 p-4 rounded-lg">
            <legend class="text-lg font-semibold mb-4">Publication</legend>

            <x-form.form-checkbox
                label="Publier cet animal sur le site public"
                name="is_published"
                :checked="$is_published"
                wire:model="is_published"
            />
        </fieldset>

        {{-- Boutons d'action --}}
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
                    {{ $this->isEditing() ? 'Mettre à jour' : 'Créer' }}
                </span>
                <span wire:loading wire:target="save">
                    Enregistrement...
                </span>
            </x-cta-button>
        </div>

    </form>
</div>
