<?php
require_once(__DIR__.'../../../../../wp-config.php');

function vaah_db_config()
{
    $db = [
        'driver' => 'mysql',
        'host' => DB_HOST,
        //'port' => DB_PORT,
        'database' => DB_NAME,
        'username' => DB_USER,
        'password' => DB_PASSWORD,
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ];

    return $db;
}