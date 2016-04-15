<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
        'client_id' => env('OAUTH_CLIENT', 'your-github-app-id'),
        'client_secret' => env('OAUTH_SECRET', 'your-github-app-secret'),
        'redirect' => env('OAUTH_REDIRECT', 'http://your-callback-url'),
        'apps_domain' => env('OAUTH_GOOGLE_APPS_DOMAIN', ''),
    ],

    'ga' => [
        'tracking_id' => env('GA_TRACKING_ID', false),
    ],
];
