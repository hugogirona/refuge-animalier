<?php

use App\Concerns\HandleImages;
use App\Enums\PetBreeds;
use App\Events\PetUpdated;
use App\Models\Pet;
use App\Models\Breed;
use App\Enums\PetSex;
use App\Enums\PetStatus;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    use WithFileUploads, HandleImages;

    public ?string $model_id = null;

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
            $this->existing_photo_path = $pet->medium_url;
            $this->is_published = $pet->is_published;
            $this->arrived_at = $pet->arrived_at?->format('Y-m-d');
            $this->breeds = $this->getBreedsForSpecies($this->species);

        } else {
            $this->status = PetStatus::AVAILABLE->value;
            $this->sex = PetSex::UNKNOWN->value;
        }
    }

    /**
     * Helper pour récupérer les races traduites selon l'espèce
     */
    private function getBreedsForSpecies(?string $species): array
    {
        $query = Breed::orderBy('name');

        if ($species) {
            $query->where('species', $species);
        }

        return $query->get()
            ->mapWithKeys(function ($breed) {
                $enum = PetBreeds::tryFrom($breed->name);
                $label = $enum ? $enum->label() : $breed->name;
                return [$breed->id => $label];
            })
            ->toArray();
    }

    public function loadSelectOptions(): void
    {
        $this->species_options = [
            'dog' => __('public/pets.filters.dog'),
            'cat' => __('public/pets.filters.cat'),
        ];

        $this->sex_options = collect(PetSex::cases())
            ->mapWithKeys(fn($case) => [
                $case->value => __('public/pets.show.sex_values.' . $case->value)
            ])
            ->toArray();

        $this->status_options = collect(PetStatus::cases())
            ->mapWithKeys(fn($case) => [
                $case->value => __('public/pets.show.status.' . $case->value)
            ])
            ->toArray();

        $this->breeds = $this->getBreedsForSpecies(null);
    }

    public function updatedSpecies($value): void
    {
        $this->breeds = $this->getBreedsForSpecies($value);

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
            'personality' => 'required|string|min:20',
            'story' => 'required|string|min:20',
            'status' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'is_published' => 'boolean',
            'arrived_at' => 'nullable|date|before_or_equal:today',
        ], [
            'name.required' => __('admin/pet-form.errors.name_required'),
            'species.required' => __('admin/pet-form.errors.species_required'),
            'breed_id.required' => __('admin/pet-form.errors.breed_required'),
            'sex.required' => __('admin/pet-form.errors.sex_required'),
            'coat_color.required' => __('admin/pet-form.errors.coat_required'),
            'personality.required' => __('admin/pet-form.errors.personality_required'),
            'personality.min' => __('admin/pet-form.errors.personality_min', ['min' => 20]),
            'story.required' => __('admin/pet-form.errors.story_required'),
            'story.min' => __('admin/pet-form.errors.story_min', ['min' => 20]),
            'photo.image' => __('admin/pet-form.errors.photo_image'),
            'photo.mimes' => __('admin/pet-form.errors.photo_mimes'),
            'photo.max' => __('admin/pet-form.errors.photo_max'),
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

        if (!Auth::user()->isAdmin()) {
            $data['is_published'] = false;
            $data['published_by'] = null;
            $data['published_at'] = null;
        }

        if ($this->photo) {
            $data['photo_path'] = $this->generatePetImage($this->photo, $this->name);
        }

        if ($this->model_id) {

            $pet = Pet::findOrFail($this->model_id);

            if ($this->photo && $pet->photo_path) {
                $this->deletePetImage($pet->photo_path);
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
        {{ $this->isEditing() ? __('admin/pet-form.titles.edit') : __('admin/pet-form.titles.create') }}
    </h2>

    <form wire:submit="save" class="space-y-6">

        {{-- SECTION 1 --}}
        <fieldset class="bg-neutral-50 p-4 rounded-lg">
            <legend class="text-lg font-semibold mb-4">{{ __('admin/pet-form.titles.general_info') }}</legend>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-form.form-input
                    :label="__('admin/pet-form.fields.name')"
                    name="name"
                    :required="true"
                    :placeholder="__('admin/pet-form.fields.name_placeholder')"
                    wire:model="name"
                    :error="$errors->first('name')"
                />

                <x-form.form-select
                    :label="__('admin/pet-form.fields.species')"
                    name="species"
                    :required="true"
                    :placeholder="__('admin/pet-form.fields.species_placeholder')"
                    :options="$species_options"
                    :value="$species"
                    wire:model.live="species"
                    :error="$errors->first('species')"
                />

                <x-form.form-select
                    :label="__('admin/pet-form.fields.breed')"
                    name="breed_id"
                    :required="true"
                    :placeholder="__('admin/pet-form.fields.breed_placeholder')"
                    :options="$breeds"
                    :value="$breed_id"
                    wire:model="breed_id"
                    :error="$errors->first('breed_id')"
                />

                <x-form.form-select
                    :label="__('admin/pet-form.fields.sex')"
                    name="sex"
                    :required="true"
                    :placeholder="__('admin/pet-form.fields.sex_placeholder')"
                    :options="$sex_options"
                    :value="$sex"
                    wire:model="sex"
                    :error="$errors->first('sex')"
                />

                <x-form.form-input
                    :label="__('admin/pet-form.fields.coat_color')"
                    name="coat_color"
                    :required="true"
                    :placeholder="__('admin/pet-form.fields.coat_color_placeholder')"
                    wire:model="coat_color"
                    :error="$errors->first('coat_color')"
                />

                <x-form.form-input
                    :label="__('admin/pet-form.fields.birth_date')"
                    name="birth_date"
                    type="date"
                    wire:model="birth_date"
                    :error="$errors->first('birth_date')"
                />

                <x-form.form-input
                    :label="__('admin/pet-form.fields.arrival_date')"
                    name="arrived_at"
                    type="date"
                    wire:model="arrived_at"
                    :error="$errors->first('arrived_at')"
                />

                <x-form.form-select
                    :label="__('admin/pet-form.fields.status')"
                    name="status"
                    :required="true"
                    :placeholder="__('admin/pet-form.fields.status_placeholder')"
                    :options="$status_options"
                    :value="$status"
                    wire:model="status"
                    :error="$errors->first('status')"
                />
            </div>
        </fieldset>

        {{-- SECTION 2 --}}
        <fieldset class="bg-neutral-50 p-4 rounded-lg">
            <legend class="text-lg font-semibold mb-4">{{ __('admin/pet-form.titles.health') }}</legend>

            <div class="flex flex-col gap-4">
                <x-form.form-input
                    :label="__('admin/pet-form.fields.last_vet_visit')"
                    name="last_vet_visit"
                    type="date"
                    wire:model="last_vet_visit"
                    :error="$errors->first('last_vet_visit')"
                />

                <x-form.form-checkbox
                    :label="__('admin/pet-form.fields.sterilized')"
                    name="sterilized"
                    :checked="$sterilized"
                    wire:model="sterilized"
                />

                <x-form.form-textarea
                    :label="__('admin/pet-form.fields.vaccinations')"
                    name="vaccinations"
                    :rows="3"
                    :placeholder="__('admin/pet-form.fields.vaccinations_placeholder')"
                    :value="$vaccinations"
                    wire:model="vaccinations"
                    :error="$errors->first('vaccinations')"
                />
            </div>
        </fieldset>

        {{-- SECTION 3 --}}
        <fieldset class="bg-neutral-50 p-4 rounded-lg">
            <legend class="text-lg font-semibold mb-4">{{ __('admin/pet-form.titles.description') }}</legend>

            <div class="space-y-4">
                <x-form.form-textarea
                    :label="__('admin/pet-form.fields.personality')"
                    name="personality"
                    :required="true"
                    :rows="4"
                    :minLength="20"
                    :showCounter="true"
                    :placeholder="__('admin/pet-form.fields.personality_placeholder')"
                    :value="$personality"
                    wire:model="personality"
                    :error="$errors->first('personality')"
                />

                <x-form.form-textarea
                    :label="__('admin/pet-form.fields.story')"
                    name="story"
                    :required="true"
                    :rows="6"
                    :minLength="20"
                    :showCounter="true"
                    :placeholder="__('admin/pet-form.fields.story_placeholder')"
                    :value="$story"
                    wire:model="story"
                    :error="$errors->first('story')"
                />
            </div>
        </fieldset>

        {{-- SECTION 4 --}}
        <fieldset class="bg-neutral-50 p-4 rounded-lg">
            <legend class="text-lg font-semibold mb-4">{{ __('admin/pet-form.titles.photo') }}</legend>

            <div>
                @if($existing_photo_path && !$photo)
                    <div class="mb-4">
                        <p class="text-sm text-neutral-600 mb-2">{{ __('admin/pet-form.fields.photo_current') }}</p>
                        <img
                            src="{{ $existing_photo_path}}"
                            alt="Photo actuelle"
                            class="w-32 h-32 object-cover rounded-lg"
                        >
                    </div>
                @endif

                <div>
                    <label for="pet-photo-upload" class="block text-sm font-medium text-grayscale-text-subtitle mb-2">
                        {{ $existing_photo_path ? __('admin/pet-form.fields.photo_change') : __('admin/pet-form.fields.photo_add') }}
                    </label>
                    <input
                        type="file"
                        id="pet-photo-upload"
                        wire:model="photo"
                        accept="image/*"
                        class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-border-default focus:border-transparent
                            {{ $errors->first('photo') ? 'border-error-text-link-light!' : '' }}"
                    >
                    @if($errors->first('photo'))
                        <p class="text-error-text-link-light text-sm mt-1">{{ $errors->first('photo') }}</p>
                    @endif

                    <div wire:loading wire:target="photo" class="text-sm text-primary-600 mt-2">
                        {{ __('admin/pet-form.fields.photo_loading') }}
                    </div>
                </div>
            </div>
        </fieldset>

        {{-- SECTION 5 --}}
        @if(auth()->user()->isAdmin())
            <fieldset class="bg-neutral-50 p-4 rounded-lg">
                <legend class="text-lg font-semibold mb-4">{{ __('admin/pet-form.titles.publication') }}</legend>

                <x-form.form-checkbox
                    :label="__('admin/pet-form.fields.is_published')"
                    name="is_published"
                    :checked="$is_published"
                    wire:model="is_published"
                />
            </fieldset>
        @endif

        {{-- ACTIONS --}}
        <div class="flex gap-4 justify-end py-4 border-t border-neutral-200 bg-white">
            <x-cta-button
                role="button"
                type="button"
                variant="secondary"
                wire:click="$dispatch('close_modal')"
            >
                {{ __('admin/pet-form.actions.cancel') }}
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
                    {{ $this->isEditing() ? __('admin/pet-form.actions.update') : __('admin/pet-form.actions.create') }}
                </span>
                <span wire:loading wire:target="save">
                    {{ __('admin/pet-form.actions.saving') }}
                </span>
            </x-cta-button>
        </div>

    </form>
</div>

