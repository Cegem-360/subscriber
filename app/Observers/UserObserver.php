<?php

declare(strict_types=1);

namespace App\Observers;

use App\Jobs\SyncUserToSecondaryApp;
use App\Models\User;

class UserObserver
{
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
