<?php

use App\Enums\UserRoles;
use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('ContactMessage Policy - Admin Only', function () {

    // Helpers
    $admin = fn () => User::factory()->create(['role' => UserRoles::ADMIN->value]);
    $volunteer = fn () => User::factory()->create(['role' => UserRoles::VOLUNTEER->value]);
    $user = fn () => User::factory()->create(['role' => 'adopter']);

    it('authorizes only admin to view list', function () use ($admin, $volunteer, $user) {
        expect($admin())->can('viewAny', ContactMessage::class)->toBeTrue()
            ->and($volunteer())->can('viewAny', ContactMessage::class)->toBeFalse()
            ->and($user())->can('viewAny', ContactMessage::class)->toBeFalse();
    });

    it('authorizes only admin to view detail', function () use ($admin, $volunteer, $user) {
        $msg = ContactMessage::factory()->create();

        expect($admin())->can('view', $msg)->toBeTrue()
            ->and($volunteer())->can('view', $msg)->toBeFalse()
            ->and($user())->can('view', $msg)->toBeFalse();
    });

    it('authorizes everyone to create (contact form)', function () use ($admin, $user) {
        // User connecté
        expect($admin())->can('create', ContactMessage::class)->toBeTrue()
            ->and($user())->can('create', ContactMessage::class)->toBeTrue();

        // Invité
        $policy = new \App\Policies\ContactMessagePolicy();
        expect($policy->create(null))->toBeTrue();
    });

    it('authorizes only admin to update', function () use ($admin, $volunteer, $user) {
        $msg = ContactMessage::factory()->create();

        expect($admin())->can('update', $msg)->toBeTrue()
            ->and($volunteer())->can('update', $msg)->toBeFalse() // Changé à False
            ->and($user())->can('update', $msg)->toBeFalse();
    });

    it('authorizes only admin to delete', function () use ($admin, $volunteer) {
        $msg = ContactMessage::factory()->create();

        expect($admin())->can('delete', $msg)->toBeTrue()
            ->and($volunteer())->can('delete', $msg)->toBeFalse();
    });
});
