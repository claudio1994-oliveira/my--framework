<?php

use App\Provider\AppServiceProvider;
use App\Provider\ViewServiceProvider;
use App\Provider\RouteServiceProvider;
use App\Provider\AuthServiceProvider;
use App\Provider\CsrfServiceProvider;
use App\Provider\RequestServiceProvider;
use App\Provider\DatabaseServiceProvider;

return [

    'name' => env('APP_NAME', 'App'),
    'debug' => env('APP_DEBUG', false),

    'providers' => [
        AppServiceProvider::class,
        RequestServiceProvider::class,
        RouteServiceProvider::class,
        ViewServiceProvider::class,
        DatabaseServiceProvider::class,
        AuthServiceProvider::class,
        CsrfServiceProvider::class,
    ],

];
