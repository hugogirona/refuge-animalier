<?php

namespace Database\Seeders;

use App\Enums\AdoptionRequestStatus;
use App\Enums\ContactMessageStatus;
use App\Enums\PetStatus;
use App\Enums\UserRoles;
use App\Enums\UserStatus;
use App\Models\AdoptionRequest;
use App\Models\ContactMessage;
use App\Models\InternalNote;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Init données de base
        $this->call(BreedSeeder::class);
        $this->call(ShelterSeeder::class);

        // Creation des users clefs
        $password = Hash::make('change_this');

        $elise = User::factory()->create([
            'first_name' => 'Elise',
            'last_name' => 'Dubois',
            'email' => 'elise@refuge.be',
            'role' => UserRoles::ADMIN->value,
            'status' => UserStatus::ACTIVE->value,
            'password' => $password,
        ]);

        $thomas = User::factory()->create([
            'first_name' => 'Thomas',
            'last_name' => 'Martin',
            'email' => 'thomas@refuge.be',
            'role' => UserRoles::VOLUNTEER->value,
            'status' => UserStatus::ACTIVE->value,
            'password' => $password,
        ]);

        // Création des collègues
        $colleagues = User::factory(6)->create()->each(function ($user) use ($password) {
            $user->update([
                'email' => strtolower($user->first_name) . '@refuge.be',
                'password' => $password,
                'role' => UserRoles::VOLUNTEER->value,
            ]);
        });

        $allStaff = $colleagues->merge([$elise, $thomas]);

        // Helper pour générer des dates cohérentes
        $dateGenerator = function () {
            $arrived = now()->subDays(rand(10, 300));
            return [
                'arrived_at' => $arrived,
                'published_at' => $arrived->copy()->addDays(rand(1, 5)),
            ];
        };

        //Animaux Standards (Disponibles, Publiés)
        Pet::factory()
            ->count(3)
            ->state(function () use ($allStaff, $elise, $dateGenerator) {
                return array_merge($dateGenerator(), [
                    'birth_date' => now()->subMonths(rand(2, 11)),
                    'status' => PetStatus::AVAILABLE,
                    'is_published' => true,
                    'created_by' => $allStaff->random()->id,
                    'published_by' => $elise->id,
                ]);
            })
            ->create();

        Pet::factory()
            ->count(12)
            ->state(function () use ($allStaff, $elise, $dateGenerator) {
                return array_merge($dateGenerator(), [
                    'birth_date' => now()->subYears(rand(2, 10)),
                    'status' => PetStatus::AVAILABLE,
                    'is_published' => true,
                    'created_by' => $allStaff->random()->id,
                    'published_by' => $elise->id,
                ]);
            })
            ->has(
                InternalNote::factory()
                    ->count(rand(1, 2))
                    ->state(fn() => ['user_id' => $allStaff->random()->id]),
                'internalNotes'
            )
            ->create();

        // Animaux en soins
        Pet::factory()
            ->count(5)
            ->state(function () use ($thomas, $elise, $dateGenerator) {
                return array_merge($dateGenerator(), [
                    'status' => PetStatus::IN_CARE,
                    'is_published' => true,
                    'published_by' => $elise->id,
                    'created_by' => $thomas->id,
                ]);
            })
            ->has(
                InternalNote::factory()->state([
                    'content' => 'Arrivé blessé, besoin de repos avant adoption.',
                    'user_id' => $thomas->id
                ]), 'internalNotes'
            )
            ->create();

        // Animaux Adoptés (Historique)
        Pet::factory()
            ->count(5)
            ->state(function () use ($elise, $dateGenerator) {
                return array_merge($dateGenerator(), [
                    'status' => PetStatus::ADOPTED,
                    'is_published' => false,
                    'created_by' => $elise->id,
                    'published_by' => $elise->id,
                ]);
            })
            ->has(
                AdoptionRequest::factory()->state([
                    'status' => AdoptionRequestStatus::ACCEPTED,
                    'processed_by' => $elise->id,
                    'adopted_at' => now()->subDays(rand(5, 100)),
                ]), 'adoptionRequests'
            )
            ->create();

        //Animaux avec Demandes
        Pet::factory()
            ->count(5)
            ->state(function () use ($allStaff, $elise, $dateGenerator) {
                return array_merge($dateGenerator(), [
                    'status' => PetStatus::AVAILABLE,
                    'is_published' => true,
                    'created_by' => $allStaff->random()->id,
                    'published_by' => $elise->id,
                ]);
            })
            ->has(AdoptionRequest::factory()->state(['status' => AdoptionRequestStatus::NEW]), 'adoptionRequests')
            ->has(AdoptionRequest::factory()->state(['status' => AdoptionRequestStatus::PENDING]), 'adoptionRequests')
            ->create();

        // Messages de contact
        ContactMessage::factory(8)->create(['status' => ContactMessageStatus::NEW]);
        ContactMessage::factory(5)->create(['status' => ContactMessageStatus::READ]);
    }
}
