<?php

$router = new AltoRouter;

$router->map('GET', '/', 'HomeController@index', 'home');
$router->map('GET', '/about', 'HomeController@about', 'about us');
$router->map('GET', '/admin', 'Admin\DashboardController@index', 'admin dashboard');

$router->map('GET', '/admin/categories/create', 'Admin\CategoryController@create', 'product_category');
$router->map('GET', '/admin/categories', 'Admin\CategoryController@index', 'list_category');
$router->map(
    'POST',
    '/admin/categories',
    'Admin\CategoryController@store',
    'create_category'
);
$router->map(
    'POST',
    '/admin/categories/[i:id]/edit',
    'Admin\CategoryController@update',
    'edit_category'
);

$router->map('GET', '/migrate/up', "MigrationController@up", 'create tables');
$router->map('GET', '/migrate/down', "MigrationController@down", 'drop tables');
