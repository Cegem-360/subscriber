<?php

declare(strict_types=1);

namespace App\Livewire\Page;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
final class HibabejelentesPage extends Component
{
    public function render(): View
    {
        return view('livewire.hibabejelentes-page');
    }
}
