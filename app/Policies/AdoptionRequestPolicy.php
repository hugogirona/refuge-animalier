<?php

namespace App\Policies;

use App\Models\AdoptionRequest;
use App\Models\User;

class AdoptionRequestPolicy
{
    /**
     * Determine if the user can view any adoption requests.
     */
    public function viewAny(User $user): bool
    {
        return true; // Tous les users authentifiés
    }

    /**
     * Determine if the user can view the adoption request.
     */
    public function view(User $user, AdoptionRequest $adoptionRequest): bool
    {
        return true;
    }

    /**
     * Determine if the user can create adoption requests.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine if the user can update the adoption request.
     */
    public function update(User $user, AdoptionRequest $adoptionRequest): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine if the user can delete the adoption request.
     */
    public function delete(User $user, AdoptionRequest $adoptionRequest): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine if the user can approve the adoption request.
     */
    public function approve(User $user, AdoptionRequest $adoptionRequest): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine if the user can reject the adoption request.
     */
    public function reject(User $user, AdoptionRequest $adoptionRequest): bool
    {
        return $user->isAdmin();
    }
}
