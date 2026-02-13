<?php

declare(strict_types=1);

namespace App\Livewire\Page\UseCases;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
final class FejlesztokPage extends Component
{
    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.use-cases.fejlesztok-page');
    }
}
