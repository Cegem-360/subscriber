<?php

declare(strict_types=1);

use App\Models\Invoice;
use App\Models\User;

test('admin can see all invoices', function () {
    $admin = User::factory()->admin()->create();
    $subscriber = User::factory()->create();

    $adminInvoice = Invoice::factory()->create(['user_id' => $admin->id]);
    $subscriberInvoice = Invoice::factory()->create(['user_id' => $subscriber->id]);

    $this->actingAs($admin);

    $invoices = Invoice::all();

    expect($invoices)->toHaveCount(2)
        ->and($invoices->pluck('id'))->toContain($adminInvoice->id, $subscriberInvoice->id);
});

test('subscriber can only see their own invoices', function () {
    $subscriber = User::factory()->create();
    $otherSubscriber = User::factory()->create();

    $subscriberInvoice = Invoice::factory()->create(['user_id' => $subscriber->id]);
    $otherInvoice = Invoice::factory()->create(['user_id' => $otherSubscriber->id]);

    $this->actingAs($subscriber);

    $invoices = Invoice::all();

    expect($invoices)->toHaveCount(1)
        ->and($invoices->first()->id)->toBe($subscriberInvoice->id);
});

test('guest can see all invoices', function () {
    $subscriber = User::factory()->create();

    Invoice::factory()->count(3)->create(['user_id' => $subscriber->id]);

    $invoices = Invoice::all();

    expect($invoices)->toHaveCount(3);
});
