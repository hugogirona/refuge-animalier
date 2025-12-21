<?php

use App\Models\InternalNote;
use App\Models\Pet;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Internal Notes Component', function () {

    it('renders existing notes', function () {
        $user = User::factory()->create();
        $pet = Pet::factory()->create();

        InternalNote::factory()->create([
            'content' => 'Note historique',
            'user_id' => $user->id,
            'notable_type' => $pet->getMorphClass(),
            'notable_id' => $pet->id,
        ]);

        Livewire::actingAs($user)
            ->test('admin.partials.pets.internal-notes-section', ['pet' => $pet])
            ->assertSee('Note historique')
            ->assertSee($user->full_name);
    });

    it('can create a new note', function () {
        $user = User::factory()->create();
        $pet = Pet::factory()->create();

        Livewire::actingAs($user)
            ->test('admin.partials.pets.internal-notes-section', ['pet' => $pet])
            ->set('content', 'Ceci est une nouvelle note')
            ->call('addNote')
            ->assertSet('content', '')
            ->assertSee('Ceci est une nouvelle note');

        // Vérification BDD
        $this->assertDatabaseHas('internal_notes', [
            'content' => 'Ceci est une nouvelle note',
            'user_id' => $user->id,
            'notable_id' => $pet->id
        ]);
    });

    it('validates the content', function () {
        $user = User::factory()->create();
        $pet = Pet::factory()->create();

        Livewire::actingAs($user)
            ->test('admin.partials.pets.internal-notes-section', ['pet' => $pet])
            ->set('content', 'ab') // Trop court (min:3)
            ->call('addNote')
            ->assertHasErrors(['content' => 'min']);

        $this->assertDatabaseCount('internal_notes', 0);
    });

    it('allows author to delete their own note', function () {
        $author = User::factory()->create();
        $pet = Pet::factory()->create();
        $note = InternalNote::factory()->create([
            'user_id' => $author->id,
            'notable_type' => $pet->getMorphClass(),
            'notable_id' => $pet->id,
        ]);

        Livewire::actingAs($author)
        ->test('admin.partials.pets.internal-notes-section', ['pet' => $pet])
            ->call('deleteNote', $note->id);

        $this->assertDatabaseMissing('internal_notes', ['id' => $note->id]);
    });

    it('prevents user from deleting someone else\'s note', function () {
        $author = User::factory()->create();
        $hacker = User::factory()->create();
        $pet = Pet::factory()->create();

        $note = InternalNote::factory()->create(['user_id' => $author->id]);

        Livewire::actingAs($hacker)
        ->test('admin.partials.pets.internal-notes-section', ['pet' => $pet])
            ->call('deleteNote', $note->id);

        $this->assertDatabaseHas('internal_notes', ['id' => $note->id]);
    });

    it('allows admin to delete ANY note', function () {
        $author = User::factory()->create();
        $admin = User::factory()->admin()->create();
        $pet = Pet::factory()->create();

        $note = InternalNote::factory()->create(['user_id' => $author->id]);

        Livewire::actingAs($admin)
        ->test('admin.partials.pets.internal-notes-section', ['pet' => $pet])
            ->call('deleteNote', $note->id);

        $this->assertDatabaseMissing('internal_notes', ['id' => $note->id]);
    });

});
