<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | OAuth Proxy
    |--------------------------------------------------------------------------
    |
    | This domain acts as a centralized OAuth callback receiver for sibling
    | tenant applications (e.g. marketinghub, controling, datamind). The proxy
    | itself stores no tokens — it only forwards the authorization code from
    | the upstream provider back to the originating tenant.
    |
    */

    'state_ttl_seconds' => (int) env('OAUTH_PROXY_STATE_TTL', 600),

    'allowed_tenants' => array_values(array_filter(array_map(
        'trim',
        explode(',', (string) env('OAUTH_PROXY_ALLOWED_TENANTS', '')),
    ))),

    'providers' => [
        'google-ads' => [
            'auth_url' => 'https://accounts.google.com/o/oauth2/v2/auth',
            'client_id' => env('GOOGLE_ADS_CLIENT_ID'),
            'scope' => 'https://www.googleapis.com/auth/adwords',
            'extra_params' => [
                'access_type' => 'offline',
                'prompt' => 'consent',
                'include_granted_scopes' => 'true',
            ],
        ],

        'google-analytics4' => [
            'auth_url' => 'https://accounts.google.com/o/oauth2/v2/auth',
            'client_id' => env('GOOGLE_ANALYTICS4_CLIENT_ID'),
            'scope' => 'https://www.googleapis.com/auth/analytics.readonly',
            'extra_params' => [
                'access_type' => 'offline',
                'prompt' => 'consent',
                'include_granted_scopes' => 'true',
            ],
        ],

        'facebook-ads' => [
            'auth_url' => 'https://www.facebook.com/v25.0/dialog/oauth',
            'client_id' => env('FACEBOOK_ADS_APP_ID'),
            'scope' => 'ads_read,ads_management,business_management',
            'extra_params' => [],
        ],
    ],
];
