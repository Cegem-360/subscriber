<?php

declare(strict_types=1);

namespace App\Livewire\Page\Features;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
final class AiPage extends Component
{
    public function render(): View
    {
        return view('livewire.features.ai-page');
    }
}
