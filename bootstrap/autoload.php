<?php

require_once(realpath(__DIR__ . "/../vendor/autoload.php"));

require_once __DIR__ . "/../app/routes.php";

use Dotenv\Dotenv;
use App\Utilities\Database\Database;
use App\Utilities\Session\SessionManager;
use App\Utilities\Routing\RouteDispatcher;


$dotenv = Dotenv::createMutable(realpath(__DIR__ . "/..//"), ".env");
$dotenv->load();
$dotenv->required([
    'DB_HOST',
    'DB_DATABASE',
    'DB_DRIVER',
    'SESSION_DRIVER'
]);
SessionManager::start();
new Database;
new RouteDispatcher($router);
