<?php

declare(strict_types=1);

return [
    'db' => [
        'host' => getenv('DB_HOST') ?: 'localhost',
        'port' => getenv('DB_PORT') ?: '3306',
        'database' => getenv('DB_NAME') ?: 'database',
        'user' => getenv('DB_USER') ?: 'user_database',
        'password' => getenv('DB_PASS') ?: ''
    ]
];
