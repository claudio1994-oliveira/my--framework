<?php

use App\Provider\AppServiceProvider;
use App\Provider\RequestServiceProvider;
use App\Provider\RouteServiceProvider;
use App\Provider\ViewServiceProvider;

return [

    'name' => env('APP_NAME', 'App'),
    'debug' => env('APP_DEBUG', false),

    'providers' => [
        AppServiceProvider::class,
        RequestServiceProvider::class,
        RouteServiceProvider::class,
        ViewServiceProvider::class,
    ],

];
