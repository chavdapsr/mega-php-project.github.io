<?php

return [
    'name' => 'Mega PHP Learning Project',
    'url' => 'http://localhost:8000',
    'timezone' => 'UTC',
    'session' => [
        'lifetime' => 7200, // 2 hours
        'secure' => false, // Set to true in production with HTTPS
        'httponly' => true,
        'samesite' => 'lax'
    ],
    'csrf' => [
        'token_name' => 'csrf_token'
    ]
];
