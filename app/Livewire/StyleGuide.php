<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class StyleGuide extends Component
{
    public function render(): View
    {
        return view('livewire.style-guide')
            ->layout('components.layouts.app');
    }
}
