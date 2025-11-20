<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SubscriberModulsList extends Component
{
    #[Computed]
    public function subscriptions()
    {
        dump(Subscription::activeSubscription()->whereUserId(Auth::id())->get());

        return Auth::user()->subscriptions()->activeSubscription()->get();
    }

    public function render()
    {
        return view('livewire.subscriber-moduls-list');
    }
}
