<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'members',
    ],
    'api' => [
        'driver' => 'token',
        'provider' => 'members',
    ],
],

'providers' => [
    'members' => [
        'driver' => 'eloquent',
        'model' => App\Models\Member::class,
    ],
],


    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the user is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => 10800,

];
