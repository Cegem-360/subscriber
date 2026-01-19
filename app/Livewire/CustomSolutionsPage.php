<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;

class CustomSolutionsPage extends Component
{
    public function render()
    {
        return view('livewire.custom-solutions-page')
            ->layout('components.layouts.app');
    }
}
