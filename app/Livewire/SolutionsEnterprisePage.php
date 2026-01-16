<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;

class SolutionsEnterprisePage extends Component
{
    public function render()
    {
        return view('livewire.solutions-enterprise-page')
            ->layout('components.layouts.app');
    }
}
