<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Jobs\SyncUserToSecondaryApp;
use App\Models\User;
use Illuminate\Support\Facades\Queue;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    Queue::fake();
});

describe('UserObserver sync job dispatch', function () {
    it('dispatches job when password changes', function () {
        $user = User::factory()->create();

        $user->update(['password' => 'new-hashed-password']);

        Queue::assertPushed(SyncUserToSecondaryApp::class, function ($job) use ($user) {
            return $job->email === $user->email
                && isset($job->changedData['password_hash']);
        });
    });

    it('dispatches job when email changes', function () {
        $user = User::factory()->create(['email' => 'old@test.com']);

        $user->update(['email' => 'new@test.com']);

        Queue::assertPushed(SyncUserToSecondaryApp::class, function ($job) {
            return $job->email === 'old@test.com'
                && isset($job->changedData['new_email'])
                && $job->changedData['new_email'] === 'new@test.com';
        });
    });

    it('dispatches job when role changes', function () {
        $user = User::factory()->create(['role' => UserRole::Subscriber]);

        $user->update(['role' => UserRole::Manager]);

        Queue::assertPushed(SyncUserToSecondaryApp::class, function ($job) use ($user) {
            return $job->email === $user->email
                && isset($job->changedData['role'])
                && $job->changedData['role'] === 'manager';
        });
    });

    it('does not dispatch job when other fields change', function () {
        $user = User::factory()->create();

        $user->update(['name' => 'New Name']);

        Queue::assertNotPushed(SyncUserToSecondaryApp::class);
    });

    it('dispatches job with multiple changed fields', function () {
        $user = User::factory()->create([
            'email' => 'old@test.com',
            'role' => UserRole::Subscriber,
        ]);

        $user->update([
            'email' => 'new@test.com',
            'password' => 'new-password',
            'role' => UserRole::Manager,
        ]);

        Queue::assertPushed(SyncUserToSecondaryApp::class, function ($job) {
            return $job->email === 'old@test.com'
                && $job->changedData['new_email'] === 'new@test.com'
                && isset($job->changedData['password_hash'])
                && $job->changedData['role'] === 'manager';
        });
    });

    it('uses original email as identifier when email changes', function () {
        $user = User::factory()->create(['email' => 'original@test.com']);

        $user->update(['email' => 'updated@test.com']);

        Queue::assertPushed(SyncUserToSecondaryApp::class, function ($job) {
            return $job->email === 'original@test.com';
        });
    });
});
