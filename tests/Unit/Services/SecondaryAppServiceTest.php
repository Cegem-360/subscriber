<?php

declare(strict_types=1);

use App\Services\SecondaryAppService;

beforeEach(function () {
    config([
        'microservices' => [
            'default_api_key' => 'default-key',
            'apps' => [
                'app1' => [
                    'url' => 'https://app1.test',
                    'api_key' => 'app1-key',
                    'active' => true,
                ],
                'app2' => [
                    'url' => 'https://app2.test',
                    'api_key' => null,
                    'active' => false,
                ],
                'app3' => [
                    'url' => 'https://app3.test',
                    'api_key' => 'app3-key',
                    'active' => true,
                ],
            ],
        ],
    ]);
});

it('returns all apps', function () {
    $service = new SecondaryAppService;

    $apps = $service->getApps();

    expect($apps)->toHaveCount(3)
        ->and(array_keys($apps))->toBe(['app1', 'app2', 'app3']);
});

it('returns only active apps', function () {
    $service = new SecondaryAppService;

    $activeApps = $service->getActiveApps();

    expect($activeApps)->toHaveCount(2)
        ->and(array_keys($activeApps))->toBe(['app1', 'app3']);
});

it('returns default api key', function () {
    $service = new SecondaryAppService;

    expect($service->getDefaultApiKey())->toBe('default-key');
});

it('returns app specific api key when set', function () {
    $service = new SecondaryAppService;

    expect($service->getApiKey('app1'))->toBe('app1-key');
});

it('returns default api key when app api key is null', function () {
    $service = new SecondaryAppService;

    expect($service->getApiKey('app2'))->toBe('default-key');
});

it('returns null for non-existent app', function () {
    $service = new SecondaryAppService;

    expect($service->getApiKey('non-existent'))->toBeNull();
});

it('returns specific app configuration', function () {
    $service = new SecondaryAppService;

    $app = $service->getApp('app1');

    expect($app)->toBe([
        'url' => 'https://app1.test',
        'api_key' => 'app1-key',
        'active' => true,
    ]);
});

it('returns null for non-existent app configuration', function () {
    $service = new SecondaryAppService;

    expect($service->getApp('non-existent'))->toBeNull();
});
