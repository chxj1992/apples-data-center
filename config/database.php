<?php

return [

    // 默认为 PDO::FETCH_BOTH
    'fetch' => PDO::FETCH_CLASS,

    'default' => 'apples_data_center',

    'connections' => [

        'apples_data_center'=> [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => 'apples_data_center',
            'username' => 'root',
            'password' => env('DB_PASS', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix' => ''
        ],

    ],

];
