<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Sync Mode
    |--------------------------------------------------------------------------
    | 'publisher' - This app sends sync events to other apps (subscriber app)
    | 'receiver'  - This app receives sync events from the publisher
    | 'both'      - This app both sends and receives
    */
    'mode' => env('USER_TEAM_SYNC_MODE', 'publisher'),

    /*
    |--------------------------------------------------------------------------
    | Models
    |--------------------------------------------------------------------------
    */
    'models' => [
        'user' => env('USER_TEAM_SYNC_USER_MODEL', 'App\\Models\\User'),
        'team' => env('USER_TEAM_SYNC_TEAM_MODEL', 'App\\Models\\Team'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Publisher Configuration
    |--------------------------------------------------------------------------
    */
    'publisher' => [
        'api_key' => env('USER_TEAM_SYNC_API_KEY'),

        'apps' => [
            'controlling' => [
                'url' => env('CONTROLLING_APP_URL', 'https://controlling.cegem360.eu'),
                'api_key' => env('CONTROLLING_APP_API_KEY'),
                'active' => true,
            ],
            'crm_and_contacts' => [
                'url' => env('CRM_AND_CONTACTS_APP_URL', 'https://crm-and-contacts.cegem360.eu'),
                'api_key' => env('CRM_AND_CONTACTS_APP_API_KEY'),
                'active' => false,
            ],
            'crm' => [
                'url' => env('CRM_APP_URL', 'https://crm.cegem360.eu'),
                'api_key' => env('CRM_APP_API_KEY'),
                'active' => true,
            ],
            'storage' => [
                'url' => env('STORAGE_APP_URL', 'https://storage.cegem360.eu'),
                'api_key' => env('STORAGE_APP_API_KEY'),
                'active' => false,
            ],
        ],

        'queue' => env('USER_TEAM_SYNC_QUEUE', 'default'),
        'connection' => env('USER_TEAM_SYNC_QUEUE_CONNECTION'),
        'tries' => (int) env('USER_TEAM_SYNC_TRIES', 3),
        'backoff' => (int) env('USER_TEAM_SYNC_BACKOFF', 60),
        'timeout' => (int) env('USER_TEAM_SYNC_TIMEOUT', 10),

        'auto_observe' => true,
        'sync_fields' => ['email', 'role'],
        'skip_ssl_for_test_domains' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Receiver Configuration
    |--------------------------------------------------------------------------
    */
    'receiver' => [
        'api_key' => env('USER_TEAM_SYNC_API_KEY'),
        'route_prefix' => 'api',
        'middleware' => [],
        'role_driver' => 'spatie',
        'default_role' => 'subscriber',
        'default_active' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Logging
    |--------------------------------------------------------------------------
    */
    'logging' => [
        'enabled' => true,
        'table' => 'sync_logs',
        'retention_days' => 30,
    ],
];
