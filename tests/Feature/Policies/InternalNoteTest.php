<?php

use App\Enums\UserRoles;
use App\Models\InternalNote;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('InternalNote Policy', function () {

    // Helpers
    $admin = fn () => User::factory()->create(['role' => UserRoles::ADMIN->value]);
    $volunteer = fn () => User::factory()->create(['role' => UserRoles::VOLUNTEER->value]);
    $user = fn () => User::factory()->create(['role' => 'adopter']);

    it('allows admin and volunteer to view notes', function () use ($admin, $volunteer, $user) {
        expect($admin())->can('viewAny', InternalNote::class)->toBeTrue()
            ->and($volunteer())->can('viewAny', InternalNote::class)->toBeTrue()
            ->and($user())->can('viewAny', InternalNote::class)->toBeFalse();
    });

    it('allows admin and volunteer to create notes', function () use ($admin, $volunteer, $user) {
        // On teste la permission globale sur la classe
        expect($admin())->can('create', InternalNote::class)->toBeTrue()
            ->and($volunteer())->can('create', InternalNote::class)->toBeTrue()
            ->and($user())->can('create', InternalNote::class)->toBeFalse();
    });

    it('allows only admin to delete notes', function () use ($admin, $volunteer) {
        $note = InternalNote::factory()->create();

        expect($admin())->can('delete', $note)->toBeTrue()
            ->and($volunteer())->can('delete', $note)->toBeFalse();
    });

    it('prevents a volunteer from deleting even their own note', function () use ($volunteer) {
        $vol = $volunteer();
        $note = InternalNote::factory()->create(['user_id' => $vol->id]);

        // Si votre logique métier interdit la suppression par les bénévoles (ce que j'ai mis dans la policy)
        expect($vol)->can('delete', $note)->toBeFalse();
    });
});
