<?php

return [

    'env' => env('APP_ENV', 'local'),
    'debug' => env('APP_DEBUG', 'true'),
    'key' => env('APP_KEY', 'Unwy9QbUfvGKMGKH6T4eVWBvHZB5Vqr5'),
    'cipher' => 'AES-256-CBC',
    'timezone' => 'Asia/Shanghai',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'log' => 'daily',

    'crawler_path' => env('CRAWLER_PATH', '/var/www/crawlers/'),

];
