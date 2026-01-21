<?php

declare(strict_types=1);

namespace App\Livewire\Page\Products;

use Livewire\Component;

class KontrollingPage extends Component
{
    public function render()
    {
        return view('livewire.products.kontrolling-page')
            ->layout('components.layouts.app');
    }
}
