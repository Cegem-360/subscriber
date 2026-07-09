<?php

declare(strict_types=1);

namespace App\Livewire\Page;

use App\Mail\ContactInquiryMail;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Throwable;

#[Layout('components.layouts.app')]
final class ContactPage extends Component
{
    #[Validate('required', message: 'Kérjük, válassza ki a megkeresés típusát.', onUpdate: false)]
    #[Validate('string', onUpdate: false)]
    public string $inquiryType = '';

    #[Validate('required', message: 'A keresztnév megadása kötelező.', onUpdate: false)]
    #[Validate('string', onUpdate: false)]
    #[Validate('max:255', onUpdate: false)]
    public string $firstName = '';

    #[Validate('required', message: 'A vezetéknév megadása kötelező.', onUpdate: false)]
    #[Validate('string', onUpdate: false)]
    #[Validate('max:255', onUpdate: false)]
    public string $lastName = '';

    #[Validate('required', message: 'Az e-mail cím megadása kötelező.', onUpdate: false)]
    #[Validate('email', message: 'Kérjük, adjon meg érvényes e-mail címet.', onUpdate: false)]
    #[Validate('max:255', onUpdate: false)]
    public string $email = '';

    #[Validate('nullable|string|max:50', onUpdate: false)]
    public string $phone = '';

    #[Validate('nullable|string|max:255', onUpdate: false)]
    public string $company = '';

    #[Validate('nullable|string|max:255', onUpdate: false)]
    public string $position = '';

    #[Validate('nullable|string', onUpdate: false)]
    public string $companySize = '';

    /** @var array<int, string> */
    #[Validate('nullable|array', onUpdate: false)]
    public array $interestedModules = [];

    #[Validate('required', message: 'Az üzenet megadása kötelező.', onUpdate: false)]
    #[Validate('string', onUpdate: false)]
    #[Validate('min:20', message: 'Az üzenet legalább 20 karakter legyen.', onUpdate: false)]
    public string $message = '';

    #[Validate('accepted', message: 'Az adatvédelmi tájékoztató elfogadása kötelező.', onUpdate: false)]
    public bool $privacyAccepted = false;

    public bool $newsletterSubscribe = false;

    public bool $submitted = false;

    public function submit(): void
    {
        $this->validate();

        try {
            Mail::to('tamas@cegem360.hu')->send(new ContactInquiryMail(
                source: 'contact',
                data: [
                    'inquiryType' => $this->inquiryType,
                    'firstName' => $this->firstName,
                    'lastName' => $this->lastName,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'company' => $this->company,
                    'position' => $this->position,
                    'companySize' => $this->companySize,
                    'interestedModules' => $this->interestedModules,
                    'message' => $this->message,
                    'privacyAccepted' => $this->privacyAccepted,
                    'newsletterSubscribe' => $this->newsletterSubscribe,
                ],
            ));
        } catch (Throwable $exception) {
            Log::error('Contact inquiry mail failed to send', [
                'error' => $exception->getMessage(),
                'email' => $this->email,
            ]);
        }

        $this->submitted = true;
    }

    public function render(): View
    {
        return view('livewire.contact-page');
    }
}
