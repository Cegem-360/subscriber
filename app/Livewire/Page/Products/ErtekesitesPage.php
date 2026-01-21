<?php

declare(strict_types=1);

namespace App\Livewire\Page\Products;

use Livewire\Component;

class ErtekesitesPage extends Component
{
    public function render()
    {
        return view('livewire.products.ertekesites-page')
            ->layout('components.layouts.app');
    }
}
