<?php

use Philo\Blade\Blade;

function view($path, $data = [])
{
    $view = realpath(__DIR__ . "/../../../resources/views");
    $cache = realpath(__DIR__ . "/../../../resources/cache");

    $blade = new Blade($view, $cache);
    echo $blade->view()->make($path, $data)->render();
}

function slugify($string)
{
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
}
