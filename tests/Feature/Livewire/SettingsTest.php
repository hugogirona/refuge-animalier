<?php

use App\Models\Shelter;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

// --- 1. SHELTER INFO ---

describe('Shelter Info Component', function () {

    // Adaptez ce chemin si nécessaire (ex: 'pages.admin...' ou 'admin.partials...')
    $component = 'admin.partials.settings.shelter-info';

    it('can update shelter info', function () use ($component) {
        $admin = User::factory()->admin()->create();
        $shelter = Shelter::factory()->create(['name' => 'Old Name']);

        Livewire::actingAs($admin)
            ->test($component)
            ->assertSet('name', 'Old Name')
            ->set('name', 'New Name')
            ->call('save');

        expect($shelter->fresh()->name)->toBe('New Name');
    });
});

// --- 2. MY PROFILE ---

describe('My Profile Component', function () {

    $component = 'admin.partials.settings.my-profile-section';

    it('renders user info', function () use ($component) {
        $user = User::factory()->create(['first_name' => 'John']);

        Livewire::actingAs($user)
            ->test($component)
            ->assertOk()
            ->assertSet('first_name', 'John');
    });

    it('updates profile info', function () use ($component) {
        $user = User::factory()->create(['first_name' => 'Old']);

        Livewire::actingAs($user)
            ->test($component)
            ->set('first_name', 'New Name')
            ->call('save')
            ->assertDispatched('profile-updated');

        expect($user->fresh()->first_name)->toBe('New Name');
    });

    it('validates email uniqueness ignoring self', function () use ($component) {
        $user = User::factory()->create(['email' => 'me@test.com']);
        User::factory()->create(['email' => 'taken@test.com']);

        Livewire::actingAs($user)
            ->test($component)
            ->set('email', 'taken@test.com')
            ->call('save')
            ->assertHasErrors(['email']);
    });
});


describe('Notifications Component', function () {

    $component = 'admin.partials.settings.notifications-section';

    it('is visible and works for admin', function () use ($component) {
        $admin = User::factory()->admin()->create();

        Livewire::actingAs($admin)
            ->test($component)
            ->assertSet('email_notifications', true)
            ->assertSee('Notifications');
    });

    it('updates notifications settings', function () use ($component) {
        $admin = User::factory()->admin()->create();

        Livewire::actingAs($admin)
            ->test($component)
            ->set('email_notifications', true)
            ->set('email_frequency', 'weekly')
            ->call('save');

        expect($admin->fresh()->email_frequency)->toBe('weekly');
    });

    it('forces frequency to NEVER if notifications disabled', function () use ($component) {
        $admin = User::factory()->admin()->create();

        Livewire::actingAs($admin)
            ->test($component)
            ->set('email_notifications', false)
            ->call('save');

        expect($admin->fresh()->email_frequency)->toBe('never');
    });
});


describe('Change Password Component', function () {

    $component = 'admin.partials.settings.change-password-section';

    it('updates password correctly', function () use ($component) {
        $user = User::factory()->create(['password' => Hash::make('old-password')]);

        Livewire::actingAs($user)
            ->test($component)
            ->set('state.current_password', 'old-password')
            ->set('state.password', 'NewPass123!')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertTrue(Hash::check('NewPass123!', $user->fresh()->password));
    });

    it('fails if current password is wrong', function () use ($component) {
        $user = User::factory()->create(['password' => Hash::make('old-password')]);

        Livewire::actingAs($user)
            ->test($component)
            ->set('state.current_password', 'wrong-password')
            ->set('state.password', 'NewPass123!')
            ->call('save')
            ->assertHasErrors(['current_password']);
    });
});

