<?php

$router = new AltoRouter;

$router->map('GET', '/', 'HomeController@index', 'home');
$router->map('GET', '/about', 'HomeController@about', 'about us');
$router->map('GET', '/migrate', "MigrationController@run", 'create tables');
