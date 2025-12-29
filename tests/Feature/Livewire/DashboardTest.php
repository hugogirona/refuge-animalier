<?php

use App\Enums\AdoptionRequestStatus;
use App\Enums\ContactMessageStatus;
use App\Enums\PetStatus;
use App\Models\AdoptionRequest;
use App\Models\ContactMessage;
use App\Models\Pet;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


describe('Dashboard Page', function () {
    it('renders the dashboard for authenticated user', function () {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('dashboard.index'))
            ->assertOk()
            ->assertSee('Tableau de bord');
    });
});


describe('Notifications Section', function () {
    $component ='admin.partials.dashboard.notif-section';

    it('counts new adoption requests correctly for admin', function () use ($component) {
        $admin = User::factory()->admin()->create();
        AdoptionRequest::factory()->count(3)->create(['status' => AdoptionRequestStatus::NEW]);
        AdoptionRequest::factory()->count(2)->create(['status' => AdoptionRequestStatus::ACCEPTED]);

        Livewire::actingAs($admin)
            ->test($component)
            ->assertSet('newAdoptionsCount', 3)
            ->assertSee('3 nouvelle(s) demande(s)');
    });

    it('counts unread messages correctly', function () use ($component) {
        $admin = User::factory()->admin()->create();
        ContactMessage::factory()->count(2)->create(['status' => ContactMessageStatus::NEW]);
        ContactMessage::factory()->count(1)->create(['status' => ContactMessageStatus::READ]);

        Livewire::actingAs($admin)
            ->test($component)
            ->assertSet('newMessagesCount', 2)
            ->assertSee('2 message(s) non lu(s)');
    });

    it('counts unpublished pets correctly', function () use ($component) {
        $admin = User::factory()->admin()->create();
        Pet::factory()->count(4)->create(['is_published' => false]);
        Pet::factory()->count(1)->create(['is_published' => true]);

        Livewire::actingAs($admin)
            ->test($component)
            ->assertSet('pendingPetsCount', 4)
            ->assertSee('4 fiche(s) en attente');
    });

    it('shows empty state when no notifications', function () use ($component) {
        $admin = User::factory()->admin()->create();

        Livewire::actingAs($admin)
            ->test($component)
            ->assertSet('newAdoptionsCount', 0)
            ->assertSet('newMessagesCount', 0)
            ->assertSet('pendingPetsCount', 0)
            ->assertSee('Aucune notification en attente');
    });

    it('refreshes counts when events are dispatched', function () use ($component) {
        $admin = User::factory()->admin()->create();
        Livewire::actingAs($admin);

        $test = Livewire::test($component);

        AdoptionRequest::factory()->create(['status' => AdoptionRequestStatus::NEW]);

        $test->dispatch('adoption-updated')
            ->assertSet('newAdoptionsCount', 1);
    });
});


describe('Overview Section', function () {
    $component ='admin.partials.dashboard.overview-section';

    it('calculates total pets correctly (excluding adopted)', function () use ($component) {
        $admin = User::factory()->admin()->create();
        Pet::factory()->count(5)->create(['status' => PetStatus::AVAILABLE]);
        Pet::factory()->count(2)->create(['status' => PetStatus::IN_CARE]);
        Pet::factory()->count(3)->create(['status' => PetStatus::ADOPTED]); // Exclus

        Livewire::actingAs($admin)
            ->test($component)
            ->assertSet('total_pets', 7);
    });

    it('calculates volunteer contribution correctly', function () use ($component) {
        $volunteer = User::factory()->volunteer()->create();

        Pet::factory()->count(2)->create([
            'created_by' => $volunteer->id,
            'created_at' => now(),
        ]);

        Pet::factory()->create([
            'created_by' => $volunteer->id,
            'created_at' => now()->subMonth(),
        ]);

        Livewire::actingAs($volunteer)
            ->test($component)
            ->assertSet('my_created_count', 2)
            ->assertSee('Vos contributions ce mois');
    });

    it('hides admin KPIs for volunteer', function () use ($component) {
        $volunteer = User::factory()->volunteer()->create();

        Livewire::actingAs($volunteer)
            ->test($component)
            ->assertDontSee('Demandes en cours')
            ->assertDontSee('Bénévoles actifs');
    });
});
