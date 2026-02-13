<?php

declare(strict_types=1);

namespace App\Livewire\Page\Features;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
final class AutomatizacioPage extends Component
{
    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.features.automatizacio-page');
    }
}
