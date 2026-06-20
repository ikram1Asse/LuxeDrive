<?php

use App\Models\ClientAuth;
use App\Models\EmployeAuth;

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option defines the default authentication "guard" and password
    | reset "broker" for your application. You may change these values
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'client'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'clients'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    */

    'guards' => [
        'client' => [
            'driver' => 'session',
            'provider' => 'clients',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'employes',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    */

    'providers' => [
        'clients' => [
            'driver' => 'eloquent',
            'model' => ClientAuth::class,
        ],
        'employes' => [
            'driver' => 'eloquent',
            'model' => EmployeAuth::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    */

    'passwords' => [
        'clients' => [
            'provider' => 'clients',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];

