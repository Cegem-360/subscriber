<?php

declare(strict_types=1);

namespace App\Livewire\Page\Legal;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
final class JogiNyilatkozatPage extends Component
{
    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.legal.jogi-nyilatkozat-page');
    }
}
