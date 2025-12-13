<?php

namespace App\Policies;

use App\Enums\UserRoles;
use App\Models\InternalNote;
use App\Models\User;

class InternalNotePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, [UserRoles::ADMIN->value, UserRoles::VOLUNTEER->value]);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, [UserRoles::ADMIN->value, UserRoles::VOLUNTEER->value]);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, InternalNote $internalNote): bool
    {
        // Seul l'admin peut supprimer une note
        return $user->role === UserRoles::ADMIN->value;

        // Optionnel : Si je veux que l'auteur meme si pas admin puisse supprimer sa note
        // return $user->role === UserRoles::ADMIN->value || $user->id === $internalNote->user_id;
    }
}
