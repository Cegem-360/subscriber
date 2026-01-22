<?php

declare(strict_types=1);

namespace App\Livewire\Page;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
final class CustomSolutionsPage extends Component
{
    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.custom-solutions-page');
    }
}
