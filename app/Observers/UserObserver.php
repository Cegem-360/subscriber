<?php

declare(strict_types=1);

namespace App\Observers;

use App\Jobs\SyncUserToSecondaryApp;
use App\Models\User;

class UserObserver
{
    // Note: User creation sync is handled in ManageUsers::createUser()
    // to capture the raw password before it's hashed

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

        // Note: Password sync is handled via raw password in EditProfile
        // to avoid double-hashing issues

        if ($user->wasChanged('role')) {
            $changedFields['role'] = $user->role->value;
        }

        if ($changedFields !== []) {
            dispatch(new SyncUserToSecondaryApp(
                email: $originalEmail ?? $user->email,
                changedData: $changedFields,
            ));
        }
    }
}
