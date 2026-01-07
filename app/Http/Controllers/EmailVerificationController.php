<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;

final class EmailVerificationController extends Controller
{
    public function __invoke(int $id, string $hash): RedirectResponse
    {
        $user = User::findOrFail($id);

        if (! $user->hasValidVerificationHash($hash)) {
            abort(403, __('Invalid verification link.'));
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()
                ->route('filament.admin.auth.login')
                ->with('notification', [
                    'status' => 'info',
                    'title' => __('Email already verified'),
                    'body' => __('Your email address has already been verified. Please log in.'),
                ]);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()
            ->route('filament.admin.auth.login')
            ->with('notification', [
                'status' => 'success',
                'title' => __('Email verified successfully'),
                'body' => __('Your email address has been verified. You can now log in.'),
            ]);
    }
}
