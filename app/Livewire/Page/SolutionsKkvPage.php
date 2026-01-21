<?php

declare(strict_types=1);

namespace App\Livewire\Page;

use Livewire\Component;

class SolutionsKkvPage extends Component
{
    public function render()
    {
        return view('livewire.solutions-kkv-page')
            ->layout('components.layouts.app');
    }
}
