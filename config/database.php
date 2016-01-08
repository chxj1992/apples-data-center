<?php

return [

    // 默认为 PDO::FETCH_BOTH
    'fetch' => PDO::FETCH_CLASS,

    'default' => 'apples_data_center',

    'connections' => [

        'apples_data_center'=> [
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'port' => 3306,
            'database' => 'apples_data_center',
            'username' => 'root',
            'password' => env('DB_PASS', '87822971'),
            'charset' => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix' => ''
        ],

    ],

];
