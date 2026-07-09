<?php

declare(strict_types=1);

use App\Livewire\Page\ContactPage;
use App\Mail\ContactInquiryMail;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;

describe('ContactPage', function (): void {
    it('sends contact inquiry email to support@cegem360.eu on submit', function (): void {
        Mail::fake();

        Livewire::test(ContactPage::class)
            ->set('inquiryType', 'demo')
            ->set('firstName', 'Anna')
            ->set('lastName', 'Nagy')
            ->set('email', 'anna@example.com')
            ->set('phone', '+36301234567')
            ->set('company', 'Example Zrt.')
            ->set('position', 'CEO')
            ->set('companySize', '11-50')
            ->set('interestedModules', ['crm', 'automatizalas'])
            ->set('message', 'Demoot szeretnék kérni a CRM modulhoz.')
            ->set('privacyAccepted', true)
            ->set('newsletterSubscribe', true)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('submitted', true);

        Mail::assertQueued(ContactInquiryMail::class, fn (ContactInquiryMail $mail): bool => $mail->hasTo('support@cegem360.eu')
            && $mail->source === 'contact'
            && $mail->data['inquiryType'] === 'demo'
            && $mail->data['firstName'] === 'Anna'
            && $mail->data['lastName'] === 'Nagy'
            && $mail->data['email'] === 'anna@example.com'
            && $mail->data['position'] === 'CEO'
            && $mail->data['companySize'] === '11-50'
            && $mail->data['interestedModules'] === ['crm', 'automatizalas']
            && $mail->data['newsletterSubscribe'] === true);
    });

    it('does not send contact inquiry email when validation fails', function (): void {
        Mail::fake();

        Livewire::test(ContactPage::class)
            ->set('firstName', '')
            ->set('email', 'invalid-email')
            ->set('message', 'rövid')
            ->set('privacyAccepted', false)
            ->call('submit')
            ->assertHasErrors(['inquiryType', 'firstName', 'lastName', 'email', 'message', 'privacyAccepted'])
            ->assertSet('submitted', false);

        Mail::assertNothingQueued();
        Mail::assertNothingSent();
    });
});
