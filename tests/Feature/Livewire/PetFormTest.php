<?php

use App\Events\PetUpdated;
use App\Models\Pet;
use App\Models\Breed;
use App\Models\User;
use App\Enums\PetSex;
use App\Enums\PetStatus;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

function validPetData(array $overrides = []): array
{
    $breed = Breed::factory()->create();

    return array_merge([
        'name' => 'Moka',
        'species' => 'dog',
        'breed_id' => $breed->id,
        'sex' => PetSex::MALE->value,
        'coat_color' => 'Brown',
        'sterilized' => true,
        'personality' => 'Very affectionate and playful, loves children and long walks in the park with family members every day',
        'story' => 'Moka was found wandering the streets in June 2024. After complete veterinary care and lots of love, he is now ready to find a loving family who will give him all the love he deserves.',
        'status' => PetStatus::AVAILABLE->value,
    ], $overrides);
}

function createValidPet(array $overrides = []): Pet
{
    return Pet::factory()->create(validPetData($overrides));
}

function fillFormWithValidData(array $overrides = []): array
{
    $data = validPetData($overrides);

    return [
        'name' => $data['name'],
        'species' => $data['species'],
        'breed_id' => $data['breed_id'],
        'sex' => $data['sex'],
        'coat_color' => $data['coat_color'],
        'personality' => $data['personality'],
        'story' => $data['story'],
        'status' => $data['status'],
    ];
}

beforeEach(function () {
    $this->user = User::factory()->admin()->create();
    actingAs($this->user);
    Storage::fake('public');
});


describe('Pet Creation', function () {
    it('can create a new pet', function () {
        Event::fake();

        Livewire::test('admin.partials.pets.form')
            ->fill(fillFormWithValidData())
            ->call('save')
            ->assertDispatched('close_modal')
            ->assertDispatched('pet-saved');

        assertDatabaseHas('pets', [
            'name' => 'Moka',
            'species' => 'dog',
            'created_by' => $this->user->id,
        ]);

        Event::assertDispatched(PetUpdated::class);
    });

    it('sets created_by when creating', function () {
        Livewire::test('admin.partials.pets.form')
            ->fill(fillFormWithValidData(['name' => 'Rex']))
            ->call('save');

        $pet = Pet::where('name', 'Rex')->first();
        expect($pet->created_by)->toBe($this->user->id);
    });

    it('sets published_by and published_at when is_published is true', function () {
        Livewire::test('admin.partials.pets.form')
            ->fill(fillFormWithValidData([
                'name' => 'Luna',
                'species' => 'cat',
            ]))
            ->set('is_published', true)
            ->call('save');

        $pet = Pet::where('name', 'Luna')->first();
        expect($pet->published_by)->toBe($this->user->id)
            ->and($pet->published_at)->not->toBeNull()
            ->and($pet->is_published)->toBeTrue();
    });
});

describe('Pet Update', function () {
    it('can update an existing pet', function () {
        Event::fake();
        $pet = createValidPet(['name' => 'Moka']);

        Livewire::test('admin.partials.pets.form', ['model_id' => (string)$pet->id])
            ->assertSet('name', 'Moka')
            ->set('name', 'Rex')
            ->call('save')
            ->assertHasNoErrors();

        assertDatabaseHas('pets', [
            'id' => $pet->id,
            'name' => 'Rex',
        ]);

        Event::assertDispatched(PetUpdated::class);
    });

    it('loads existing data when editing', function () {
        $breed = Breed::factory()->create(['name' => 'Poodle']);
        $pet = createValidPet([
            'name' => 'Moka',
            'breed_id' => $breed->id,
            'sterilized' => true,
        ]);

        Livewire::test('admin.partials.pets.form', ['model_id' => (string)$pet->id])
            ->assertSet('name', 'Moka')
            ->assertSet('species', 'dog')
            ->assertSet('breed_id', $breed->id)
            ->assertSet('sterilized', true);
    });

    it('returns true for isEditing() in edit mode', function () {
        $pet = createValidPet();
        $component = Livewire::test('admin.partials.pets.form', ['model_id' => (string)$pet->id]);

        expect($component->instance()->isEditing())->toBeTrue();
    });

    it('returns false for isEditing() in create mode', function () {
        $component = Livewire::test('admin.partials.pets.form');

        expect($component->instance()->isEditing())->toBeFalse();
    });
});

describe('Validation', function () {
    it('validates name is required', function () {
        Livewire::test('admin.partials.pets.form')
            ->set('name', '')
            ->call('save')
            ->assertHasErrors(['name' => 'required']);
    });

    it('validates species is required', function () {
        Livewire::test('admin.partials.pets.form')
            ->set('species', '')
            ->call('save')
            ->assertHasErrors(['species' => 'required']);
    });

    it('validates breed is required', function () {
        Livewire::test('admin.partials.pets.form')
            ->set('breed_id')
            ->call('save')
            ->assertHasErrors(['breed_id' => 'required']);
    });

    it('validates personality has at least 50 characters', function () {
        Livewire::test('admin.partials.pets.form')
            ->fill(fillFormWithValidData())
            ->set('personality', 'Too short')
            ->call('save')
            ->assertHasErrors(['personality' => 'min']);
    });

    it('validates story has at least 20 characters', function () {
        Livewire::test('admin.partials.pets.form')
            ->fill(fillFormWithValidData())
            ->set('story', 'Story too short')
            ->call('save')
            ->assertHasErrors(['story' => 'min']);
    });
});

describe('Breed Management', function () {
    it('loads all breeds on mount', function () {
        Breed::factory()->count(5)->create();

        $component = Livewire::test('admin.partials.pets.form');

        expect($component->get('breeds'))->toHaveCount(5);
    });

    it('filters breeds by species when species changes', function () {
        Breed::factory()->count(3)->create(['species' => 'dog']);
        Breed::factory()->count(2)->create(['species' => 'cat']);

        Livewire::test('admin.partials.pets.form')
            ->set('species', 'dog')
            ->assertCount('breeds', 3);
    });

    it('resets breed_id when species changes and breed does not match', function () {
        $dogBreed = Breed::factory()->create(['species' => 'dog']);
        Breed::factory()->create(['species' => 'cat']);

        Livewire::test('admin.partials.pets.form')
            ->set('species', 'dog')
            ->set('breed_id', $dogBreed->id)
            ->set('species', 'cat')
            ->assertSet('breed_id', null);
    });
});

describe('Photo Upload', function () {
    it('can upload a photo when creating', function () {
        Storage::fake('local');
        Storage::fake('public');

        $file = UploadedFile::fake()->image('pet.jpg');

        Livewire::test('admin.partials.pets.form')
        ->fill(fillFormWithValidData())
            ->set('photo', $file)
            ->call('save');

        $pet = Pet::where('name', 'Moka')->first();

        expect($pet->photo_path)->not->toBeNull();

        Storage::disk('local')->assertExists(
            config('pets.original_path') . '/' . $pet->photo_path
        );
    });

    it('deletes old photo when replacing', function () {
        Storage::fake('local');
        Storage::fake('public');

        $oldName = 'old-photo.jpg';
        $oldFile = UploadedFile::fake()->image($oldName);

        Storage::disk('local')->put(
            config('pets.original_path') . '/' . $oldName,
            $oldFile->getContent()
        );

        $pet = createValidPet(['photo_path' => $oldName]);

        $newFile = UploadedFile::fake()->image('new.jpg');

        Livewire::test('admin.partials.pets.form', ['model_id' => (string)$pet->id])
            ->set('photo', $newFile)
            ->call('save');

        $pet->refresh();

        Storage::disk('local')->assertMissing(
            config('pets.original_path') . '/' . $oldName
        );

        Storage::disk('local')->assertExists(
            config('pets.original_path') . '/' . $pet->photo_path
        );
    });

});

describe('Select Options', function () {
    it('loads species options', function () {
        $component = Livewire::test('admin.partials.pets.form');

        $options = $component->get('species_options');
        expect($options)->toHaveKey('dog')
            ->and($options)->toHaveKey('cat');
    });

    it('loads sex options from enum', function () {
        $component = Livewire::test('admin.partials.pets.form');

        $options = $component->get('sex_options');
        expect($options)->toHaveCount(count(PetSex::cases()));
    });

    it('loads status options from enum', function () {
        $component = Livewire::test('admin.partials.pets.form');

        $options = $component->get('status_options');
        expect($options)->toHaveCount(count(PetStatus::cases()));
    });
});

describe('Default Values', function () {
    it('sets default values in create mode', function () {
        Livewire::test('admin.partials.pets.form')
            ->assertSet('sex', PetSex::UNKNOWN->value)
            ->assertSet('status', PetStatus::AVAILABLE->value)
            ->assertSet('sterilized', false)
            ->assertSet('is_published', false);
    });
});

describe('Events', function () {
    it('dispatches close_modal after save', function () {
        Livewire::test('admin.partials.pets.form')
            ->fill(fillFormWithValidData(['name' => 'Test']))
            ->call('save')
            ->assertDispatched('close_modal');
    });

    it('dispatches pet-saved after save', function () {
        Livewire::test('admin.partials.pets.form')
            ->fill(fillFormWithValidData(['name' => 'Test']))
            ->call('save')
            ->assertDispatched('pet-saved');
    });

    it('dispatches PetUpdated Laravel event', function () {
        Event::fake();

        Livewire::test('admin.partials.pets.form')
            ->fill(fillFormWithValidData(['name' => 'Test']))
            ->call('save');

        Event::assertDispatched(PetUpdated::class);
    });
});

describe('Date Formatting', function () {
    it('formats dates correctly for editing', function () {
        $pet = createValidPet([
            'birth_date' => '2020-01-15',
            'arrived_at' => '2024-06-01',
            'last_vet_visit' => '2024-12-01',
        ]);

        Livewire::test('admin.partials.pets.form', ['model_id' => (string)$pet->id])
            ->assertSet('birth_date', '2020-01-15')
            ->assertSet('arrived_at', '2024-06-01')
            ->assertSet('last_vet_visit', '2024-12-01');
    });
});
