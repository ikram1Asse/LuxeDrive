<?php

use App\Models\Client;
use App\Models\User;

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'client'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'clients'),
    ],

    'guards' => [
        'client' => [
            'driver' => 'session',
            'provider' => 'clients',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    'providers' => [
        'clients' => [
            'driver' => 'eloquent',
            'model' => Client::class,
        ],
        'users' => [
            'driver' => 'eloquent',
            'model' => User::class,
        ],
    ],

    'passwords' => [
        'clients' => [
            'provider' => 'clients',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
