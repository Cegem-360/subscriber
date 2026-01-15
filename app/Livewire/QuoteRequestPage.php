<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class QuoteRequestPage extends Component
{
    #[Validate('required|string|min:2|max:255')]
    public string $name = '';

    #[Validate('required|email|max:255')]
    public string $email = '';

    #[Validate('required|string|min:10|max:2000')]
    public string $message = '';

    public bool $submitted = false;

    public function submit(): void
    {
        $this->validate();

        // TODO: Send email notification or store in database
        // Mail::to(config('mail.admin_address'))->send(new QuoteRequestMail($this->name, $this->email, $this->message));

        $this->submitted = true;

        $this->reset(['name', 'email', 'message']);
    }

    public function render(): View
    {
        return view('livewire.quote-request-page');
    }
}
