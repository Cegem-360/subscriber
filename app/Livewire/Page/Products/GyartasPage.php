<?php

declare(strict_types=1);

namespace App\Livewire\Page\Products;

use Livewire\Component;

class GyartasPage extends Component
{
    public function render()
    {
        return view('livewire.products.gyartas-page')
            ->layout('components.layouts.app');
    }
}
