<?php

use App\Enums\UserRoles;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('has required fillable fields', function () {
    $user = User::factory()->create([
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john@example.com',
        'password' => bcrypt('password'),
        'role' => UserRoles::ADMIN->value,
        'phone' => '+33612345678',
        'email_notifications' => true,
    ]);

    expect($user->first_name)->toBe('John')
        ->and($user->email)->toBe('john@example.com')
        ->and($user->role)->toBe('admin')
        ->and($user->phone)->toBe('+33612345678')
        ->and($user->email_notifications)->toBeTrue();
});

it('has role attribute', function () {
    $user = User::factory()->create(['role' => UserRoles::ADMIN->value]);

    expect(isset($user->role))->toBeTrue()
        ->and($user->role)->toBe('admin');
});

it('can be an admin', function () {
    $user = User::factory()->create(['role' => 'admin']);

    expect($user->role)->toBe('admin');
});

it('can be a volunteer', function () {
    $user = User::factory()->create(['role' => 'volunteer']);

    expect($user->role)->toBe('volunteer');
});

it('casts availability to array', function () {
    $availability = [
        'monday' => ['09:00', '17:00'],
        'tuesday' => ['09:00', '17:00'],
    ];

    $user = User::factory()->create([
        'availability' => $availability,
    ]);

    expect($user->availability)->toBeArray()
        ->and($user->availability)->toBe($availability);
});

it('defaults email notifications to true', function () {
    $user = User::factory()->create();

    $user->refresh();

    expect($user->email_notifications)->toBeTrue();
});

it('can have null availability', function () {
    $user = User::factory()->create([
        'availability' => null,
    ]);

    expect($user->availability)->toBeNull();
});

it('stores phone number', function () {
    $user = User::factory()->create([
        'phone' => '+33612345678',
    ]);

    expect($user->phone)->toBe('+33612345678');
});
