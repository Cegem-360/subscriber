<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

final class EmailVerificationController extends Controller
{
    public function __invoke(int $id, string $hash): RedirectResponse
    {
        $user = User::query()->findOrFail($id);

        if (! $user->hasValidVerificationHash($hash)) {
            abort(403, __('Invalid verification link.'));
        }

        if ($user->hasVerifiedEmail()) {
            return $this->redirectUser($user, 'info', __('Email already verified'), __('Your email address has already been verified. Please log in.'));
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return $this->redirectUser($user, 'success', __('Email verified successfully'), __('Your email address has been verified. You can now log in.'));
    }

    private function redirectUser(User $user, string $status, string $title, string $body): RedirectResponse
    {
        $notification = [
            'status' => $status,
            'title' => $title,
            'body' => $body,
        ];

        if (Auth::check() && ! $user->isAdmin()) {
            return to_route('modules')->with('notification', $notification);
        }

        return to_route('filament.admin.auth.login')->with('notification', $notification);
    }
}
