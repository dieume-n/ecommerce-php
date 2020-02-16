<?php

$router = new AltoRouter;

$router->map('GET', '/', 'HomeController@index', 'home');
$router->map('GET', '/about', 'HomeController@about', 'about us');
$router->map('GET', '/admin', 'Admin\DashboardController@index', 'admin dashboard');

$router->map('GET', '/admin/products/categories/create', 'Admin\ProductCategoryController@create', 'product_category');
$router->map(
    'POST',
    '/admin/products/categories',
    'Admin\ProductCategoryController@store',
    'create_product_category'
);

$router->map('GET', '/migrate/up', "MigrationController@up", 'create tables');
$router->map('GET', '/migrate/down', "MigrationController@down", 'drop tables');
