<?php

declare(strict_types=1);

namespace App\Observers;

use App\Jobs\CreateUserInSecondaryApp;
use App\Jobs\SyncUserToSecondaryApp;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Only sync users that belong to a subscription (managed users)
        if ($user->subscription_id) {
            dispatch(new CreateUserInSecondaryApp(
                email: $user->email,
                name: $user->name,
                passwordHash: $user->password,
                role: $user->role->value,
            ));
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        $changedFields = [];
        $originalEmail = $user->getOriginal('email');

        if ($user->wasChanged('email')) {
            $changedFields['new_email'] = $user->email;
        }

        if ($user->wasChanged('password')) {
            $changedFields['password_hash'] = $user->password;
        }

        if ($user->wasChanged('role')) {
            $changedFields['role'] = $user->role->value;
        }

        if (! empty($changedFields)) {
            dispatch(new SyncUserToSecondaryApp(
                email: $originalEmail ?? $user->email,
                changedData: $changedFields,
            ));
        }
    }
}
