<?php

declare(strict_types=1);

namespace App\Livewire\Page\Company;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
final class UgyfelsztoriPage extends Component
{
    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.company.ugyfelsztori-page');
    }
}
