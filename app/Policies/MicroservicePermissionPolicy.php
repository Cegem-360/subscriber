<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\MicroservicePermission;
use App\Models\User;

class MicroservicePermissionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MicroservicePermission $microservicePermission): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $microservicePermission->subscription->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MicroservicePermission $microservicePermission): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MicroservicePermission $microservicePermission): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MicroservicePermission $microservicePermission): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MicroservicePermission $microservicePermission): bool
    {
        return $user->isAdmin();
    }
}
