<?php

require_once(realpath(__DIR__ . "/../vendor/autoload.php"));

use Dotenv\Dotenv;
use App\Utilities\Session\SessionManager;


$dotenv = Dotenv::createMutable(realpath(__DIR__ . "/..//"), ".env");
$dotenv->load();
$dotenv->required([
    'DB_HOST',
    'DB_DATABASE',
    'DB_DRIVER',
    'SESSION_DRIVER'
]);
SessionManager::start();
