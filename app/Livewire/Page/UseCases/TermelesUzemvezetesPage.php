<?php

declare(strict_types=1);

namespace App\Livewire\Page\UseCases;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
final class TermelesUzemvezetesPage extends Component
{
    public function render(): View
    {
        return view('livewire.use-cases.termeles-uzemvezetes-page');
    }
}
