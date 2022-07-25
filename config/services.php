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

    'open-weather-map' => [
        'uri' => env(key: 'OPEN_WEATHER_MAP_API_URI', default: 'api.openweathermap.org'),
        'token' => env(key: 'OPEN_WEATHER_MAP_API_TOKEN'),
        'timeout' => env(key: 'OPEN_WEATHER_MAP_TIMEOUT', default: 10),
        'retry_times' => env(key: 'OPEN_WEATHER_MAP_RETRY_TIMES', default: 3),
        'retry_milliseconds' => env(key: 'OPEN_WEATHER_MAP_RETRY_MILLISECONDS', default: 500),
    ],


];
