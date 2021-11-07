<?php

use code\logger\monolog\MessageHandler;
use Monolog\Handler\RotatingFileHandler;
use Psr\Log\LogLevel;

return [
    'logs' => [
        'path' => COREPATH_LOGS,
        'handlers' => [
            'default' => function ($container, array $args) {
                        return new RotatingFileHandler(
                                $args['filename'],
                                7,
                                $args['level']
                        );
                    }
        ],
        'channels' => [
            'message' => [
                'enabled' => true,
                'level' => LogLevel::INFO,
                'handlers' => [
                    MessageHandler::class,
                ],
            ],
            'error' => [
                'enabled' => true,
                'level' => LogLevel::ERROR,
                'handlers' => [
                    'rotating'
                ]
            ],
            'info' => [
                'enabled' => true,
                'level' => LogLevel::INFO,
                'handlers' => [
                    'rotating'
                ]
            ],
        ]
    ]
];
