<?php

declare(strict_types=1);

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class ForCurrentUserThroughSubscriptionScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        if (Auth::check() && ! Auth::user()?->isAdmin()) {
            $builder->whereRelation('subscription', 'user_id', Auth::id());
        }
    }
}
