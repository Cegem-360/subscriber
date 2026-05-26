<?php

declare(strict_types=1);

namespace App\Livewire\Page;

use App\Mail\ContactInquiryMail;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Throwable;

#[Layout('components.layouts.app')]
final class ContactPage extends Component
{
    public string $inquiryType = '';

    public string $firstName = '';

    public string $lastName = '';

    public string $email = '';

    public string $phone = '';

    public string $company = '';

    public string $position = '';

    public string $companySize = '';

    /** @var array<int, string> */
    public array $interestedModules = [];

    public string $message = '';

    public bool $privacyAccepted = false;

    public bool $newsletterSubscribe = false;

    public bool $submitted = false;

    private function rules(): array
    {
        return [
            'inquiryType' => 'required|string',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'companySize' => 'nullable|string',
            'interestedModules' => 'nullable|array',
            'message' => 'required|string|min:20',
            'privacyAccepted' => 'accepted',
        ];
    }

    private function messages(): array
    {
        return [
            'inquiryType.required' => 'Kérjük, válassza ki a megkeresés típusát.',
            'firstName.required' => 'A keresztnév megadása kötelező.',
            'lastName.required' => 'A vezetéknév megadása kötelező.',
            'email.required' => 'Az e-mail cím megadása kötelező.',
            'email.email' => 'Kérjük, adjon meg érvényes e-mail címet.',
            'message.required' => 'Az üzenet megadása kötelező.',
            'message.min' => 'Az üzenet legalább 20 karakter legyen.',
            'privacyAccepted.accepted' => 'Az adatvédelmi tájékoztató elfogadása kötelező.',
        ];
    }

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
