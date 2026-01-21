<?php

declare(strict_types=1);

namespace App\Livewire\Page;

use Livewire\Component;

class SolutionsNonprofitPage extends Component
{
    public function render()
    {
        return view('livewire.solutions-nonprofit-page')
            ->layout('components.layouts.app');
    }
}
