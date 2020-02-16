<?php

$router = new AltoRouter;

$router->map('GET', '/', 'HomeController@index', 'home');
$router->map('GET', '/about', 'HomeController@about', 'about us');
$router->map('GET', '/admin', 'Admin\DashboardController@index', 'admin dashboard');
// $router->map('GET', '/migrate/up', "MigrationController@run", 'create tables');
// $router->map('GET', '/migrate/down', "MigrationController@down", 'drop tables');
