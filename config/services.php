<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'github' => [
        'client_id' => '810211eaf08421e0e54f',
        'client_secret' => '97012dccbb1806bb8a916e7cfc8a531e00a39c3d',
        'redirect' => 'http://localhost:8000/auth/github/callback',
    ],
    'google' => [
        'client_id' => '940603961668-4idosoka5hqd6hohtmdp3vq20dipif3u.apps.googleusercontent.com',
        'client_secret' => 'kS5kXd0CnnvGlJCu_h4Nm1eD',
        'redirect' => 'http://localhost:8000/auth/google/callback',
    ],
    'facebook' => [
        'client_id' => '811211079401053',
        'client_secret' => 'f78b6c157e47d633110b3b56c655dfa1',
        'redirect' => 'http://localhost:8000/auth/facebook/callback',
    ],
];
