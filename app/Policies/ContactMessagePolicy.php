<?php

namespace App\Policies;

use App\Enums\UserRoles;
use App\Models\ContactMessage;
use App\Models\User;

class ContactMessagePolicy
{
    /**
     * Seul l'admin peut voir la liste.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === UserRoles::ADMIN->value;
    }

    /**
     * Seul l'admin peut voir un message.
     */
    public function view(User $user, ContactMessage $contactMessage): bool
    {
        return $user->role === UserRoles::ADMIN->value;
    }

    /**
     * Tout le monde peut écrire (formulaire de contact public).
     */
    public function create(?User $user): bool
    {
        return true;
    }

    /**
     * Seul l'admin peut répondre ou marquer comme lu.
     */
    public function update(User $user, ContactMessage $contactMessage): bool
    {
        return $user->role === UserRoles::ADMIN->value;
    }

    /**
     * Seul l'admin peut supprimer.
     */
    public function delete(User $user, ContactMessage $contactMessage): bool
    {
        return $user->role === UserRoles::ADMIN->value;
    }
}
