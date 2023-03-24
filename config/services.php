<?php

declare(strict_types=1);

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

    'drone' => [
        'token' => env('DRONE_TOKEN'),
    ],

    'gitlab' => [
        'token' => env('GITLAB_TOKEN'),
    ],

    'mailgun' => [
        'domain'   => env('MAILGUN_DOMAIN'),
        'secret'   => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme'   => 'https',
    ],

    'open_suse_build_service' => [
        'username' => env('OPEN_SUSE_BUILD_SERVICE_PASSWORD'),
        'password' => env('OPEN_SUSE_BUILD_SERVICE_USERNAME'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key'    => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'stack_exchange' => [
        'token' => env('STACK_EXCHANGE_TOKEN'),
    ],

    'symfony_insight' => [
        'username' => env('SYMFONY_INSIGHT_USERNAME'),
        'password' => env('SYMFONY_INSIGHT_PASSWORD'),
    ],

    'twitch' => [
        'client_id'     => env('TWITCH_CLIENT_ID'),
        'client_secret' => env('TWITCH_CLIENT_SECRET'),
    ],

    'wheelmap' => [
        'token' => env('WHEELMAP_TOKEN'),
    ],

    'youtube' => [
        'token' => env('YOUTUBE_TOKEN'),
    ],

];
