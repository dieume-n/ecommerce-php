<?php

use Dotenv\Dotenv;

require_once(realpath(__DIR__ . "/../vendor/autoload.php"));

$dotenv = Dotenv::createMutable(realpath(__DIR__ . "/..//"), ".env");
$dotenv->load();
$dotenv->required([
    'DB_HOST',
    'DB_DATABASE',
    'DB_DRIVER',
    'SESSION_DRIVER'
]);

echo getenv('APP_NAME');
