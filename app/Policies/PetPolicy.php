<?php

namespace App\Policies;

use App\Models\Pet;
use App\Models\User;

class PetPolicy
{
    /**
     * Determine if the user can view any pets.
     */
    public function viewAny(User $user): bool
    {
        return true; // Tous les users authentifiés peuvent voir la liste
    }

    /**
     * Determine if the user can view the pet.
     */
    public function view(User $user, Pet $pet): bool
    {
        return true; // Tous peuvent voir un pet
    }

    /**
     * Determine if the user can create pets.
     */
    public function create(User $user): bool
    {
        return true; // Admin et volunteer peuvent créer des drafts
    }

    /**
     * Determine if the user can update the pet.
     */
    public function update(User $user, Pet $pet): bool
    {
        // Tous peuvent éditer, mais les changements de volunteer nécessitent approbation
        return true;
    }

    /**
     * Determine if the user can delete the pet.
     */
    public function delete(User $user, Pet $pet): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine if the user can publish the pet.
     */
    public function publish(User $user, Pet $pet): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine if the user can restore the pet.
     */
    public function restore(User $user, Pet $pet): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine if the user can permanently delete the pet.
     */
    public function forceDelete(User $user, Pet $pet): bool
    {
        return $user->isAdmin();
    }
}
