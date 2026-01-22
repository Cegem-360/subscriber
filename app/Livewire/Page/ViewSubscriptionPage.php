<?php

declare(strict_types=1);

namespace App\Livewire\Page;

use App\Models\Subscription;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.dashboard')]
final class ViewSubscriptionPage extends Component
{
    public Subscription $subscription;

    public function mount(Subscription $subscription): void
    {
        $this->subscription = $subscription->load(['plan.planCategory', 'user', 'members']);
    }

    public function render(): View
    {
        return view('livewire.view-subscription-page');
    }
}
