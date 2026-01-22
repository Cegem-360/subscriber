<?php

declare(strict_types=1);

namespace App\Livewire\Page\Products;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
final class AutomatizalasPage extends Component
{
    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.products.automatizalas-page');
    }
}
