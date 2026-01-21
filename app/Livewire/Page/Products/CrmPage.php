<?php

declare(strict_types=1);

namespace App\Livewire\Page\Products;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class CrmPage extends Component
{
    public function render()
    {
        return view('livewire.products.crm-page');
    }
}
