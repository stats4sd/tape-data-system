<?php

return [
    'panels' => [
        'app' => [
            'enabled' => env('ADMIN_PANEL_LOCAL_LOGINS_ENABLED', env('APP_ENV') === 'local'),
            'emails' => [
                'admin@example.com',
                'test@example.com',
            ],
        ],
    ],
];
