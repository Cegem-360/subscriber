<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.dashboard')]
#[Title('Moduljaim')]
class SubscriberModulsList extends Component
{
    #[Computed]
    public function subscriptions()
    {
        return Auth::user()->subscriptions()->activeSubscription()->with('plan.planCategory')->get();
    }

    public function render(): Factory|View
    {
        return view('livewire.subscriber-moduls-list');
    }
}
