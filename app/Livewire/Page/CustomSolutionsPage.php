<?php

declare(strict_types=1);

namespace App\Livewire\Page;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class CustomSolutionsPage extends Component
{
    public function render()
    {
        return view('livewire.custom-solutions-page');
    }
}
