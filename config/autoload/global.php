<?php
return [
    'api-tools-content-negotiation' => [
        'selectors' => [],
    ],
    'db' => [
        'adapters' => [
            'dummy' => [],
        ],
    ],
    'api-tools-mvc-auth' => [
        'authentication' => [
            'map' => [
                'StatusTest\\V1' => 'status',
                'blog\\V1' => 'basic_http_auth',
            ],
        ],
    ],
];
