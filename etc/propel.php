<?php

return [
    'propel' => [
        'paths' => [
            // The directory where Propel expects to find your `schema.xml` file.
            'schemaDir' => '../etc',

            // The directory where Propel should output generated object model classes.
            'phpDir' => 'models',
        ],
        'database' => [
            'connections' => [
//                'default' => [
//                    'adapter' => 'sqlite',
//                    'dsn' => 'sqlite:c:\sviluppo\php\ApiApp/my.app.sq3',
//                    'user' => 'root',
//                    'password' => 'root',
//                    'settings' => [
//                        'charset' => 'utf8',
//                        'queries' =>
//                        [],
//                    ],
//                    'classname' => '\\Propel\\Runtime\\Connection\\ConnectionWrapper',
//                    'model_paths' =>
//                    [
//                        0 => 'src',
//                        1 => 'vendor',
//                    ],
//                ]
                'default' => [
                    'adapter' => 'pgsql',
                    'dsn' => 'pgsql:host=192.168.178.40;port=5432;dbname=apiapp',
                    'user' => 'postgres',
                    'password' => '21033200',
                    'settings' => [
                        'charset' => 'utf8',
                        'queries' =>
                        [],
                    ],
                    'classname' => '\\Propel\\Runtime\\Connection\\ConnectionWrapper',
                    'model_paths' =>
                    [
                        0 => 'models',
                        1 => 'vendor',
                    ],
                    ]
            ]
        ],
        'runtime' => [
            'defaultConnection' => 'default',
            'connections' => ['default']
        ],
        'generator' => [
            'defaultConnection' => 'default',
            'connections' => ['default']
        ],
        'maps' => array (
            0 => '\\models\\Map\\UsersTableMap',
            1 => '\\models\\Map\\UserGroupsTableMap',
            2 => '\\models\\Map\\UserPermissionsTableMap',
            3 => '\\models\\Map\\GroupPermissionsTableMap',
          ),
    ]
];
