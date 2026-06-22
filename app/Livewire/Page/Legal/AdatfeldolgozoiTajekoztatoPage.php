<?php

declare(strict_types=1);

namespace App\Livewire\Page\Legal;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
final class AdatfeldolgozoiTajekoztatoPage extends Component
{
    public function render(): View
    {
        return view('livewire.legal.adatfeldolgozoi-tajekoztato-page');
    }
}
