<?php

return [
    'name' => env('APP_NAME', 'MY-APP'),
    'env' => env('APP_ENV', 'production'),
    'debug' => env('APP_DEBUG', false),
    'url' => env('APP_URL', 'http://localhost'),
    'timezone' => 'Asia/Jakarta',
    'locale' => 'id',
    'fallback_locale' => 'en',
    
    'providers' => [
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        App\Providers\AppServiceProvider::class,
    ],
];
