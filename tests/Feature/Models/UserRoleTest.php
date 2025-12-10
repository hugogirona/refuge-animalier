<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('returns true when user is admin', function () {
    $user = User::factory()->admin()->create();

    expect($user->isAdmin())->toBeTrue();
});

it('returns false when user is not admin', function () {
    $user = User::factory()->volunteer()->create();

    expect($user->isAdmin())->toBeFalse();
});

it('returns true when user is volunteer', function () {
    $user = User::factory()->volunteer()->create();

    expect($user->isVolunteer())->toBeTrue();
});

it('returns false when user is not volunteer', function () {
    $user = User::factory()->admin()->create();

    expect($user->isVolunteer())->toBeFalse();
});

it('admin and volunteer are mutually exclusive', function () {
    $admin = User::factory()->admin()->create();
    $volunteer = User::factory()->volunteer()->create();

    expect($admin->isAdmin())->toBeTrue()
        ->and($admin->isVolunteer())->toBeFalse()
        ->and($volunteer->isVolunteer())->toBeTrue()
        ->and($volunteer->isAdmin())->toBeFalse();
});
