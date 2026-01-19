<?php

namespace App\Livewire\Products;

use Livewire\Component;

class BeszerzesPage extends Component
{
    public function render()
    {
        return view('livewire.products.beszerzes-page')
            ->layout('components.layouts.app');
    }
}
