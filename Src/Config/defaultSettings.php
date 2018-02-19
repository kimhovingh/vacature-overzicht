<?php

return [
    'settings' => [
        'displayErrorDetails' => true,

        // View settings
        'view' => [
            'template_path' => __DIR__ . '/../Views',
            'twig' => [
                'debug' => true,
                'auto_reload' => true,
            ],
        ],
        // monolog settings
        'logger' => [
            'debug' => true,
            'name' => 'default',
            'path' => __DIR__ . '/../../default.log',
        ],
    ],
];
