<?php
require "config/database.php";

return [
    'paths' => [
        'migrations' => 'app/Migration/db',
        'template'  => 'phinx-template.php.dist'
    ],
    'migration_base_class' => '\Vaah\Migration\Migration',
    'environments' => [
        'default_migration_table' => 'vaah_migration',
        'default_database' => 'dev',
        'dev' => [
            'adapter' => 'mysql',
            'host' => DB_HOST,
            'name' => DB_NAME,
            'user' => DB_USER,
            'pass' => DB_PASSWORD,
        ]
    ]
];