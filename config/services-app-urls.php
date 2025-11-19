<?php

declare(strict_types=1);

return [
    'app_api_key' => env('APP_API_KEY'),
    'controlling' => [
        'url' => env('CONTROLLING_APP_URL', 'https://controlling.cegem360.eu'),
        'api_key' => env('CONTROLLING_APP_API_KEY', env('APP_API_KEY')),
        'active' => true,
    ],
    'crm_and_contacts' => [
        'url' => env('CRM_AND_CONTACTS_APP_URL', 'https://crm-and-contacts.cegem360.eu'),
        'api_key' => env('CRM_AND_CONTACTS_APP_API_KEY', env('APP_API_KEY')),
        'active' => false,
    ],
    'crm' => [
        'url' => env('CRM_APP_URL', 'https://crm.cegem360.eu'),
        'api_key' => env('CRM_APP_API_KEY', env('APP_API_KEY')),
        'active' => false,
    ],
    'storage' => [
        'url' => env('STORAGE_APP_URL', 'https://storage.cegem360.eu'),
        'api_key' => env('STORAGE_APP_API_KEY', env('APP_API_KEY')),
        'active' => false,
    ],
];
