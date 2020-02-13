<?php

namespace App\Utilities\Routing;

use AltoRouter;
use Exception;

class RouteDispatcher
{
    protected $match;
    private $namespace = "App\\Controllers\\";
    protected $controller;
    protected $method;


    public function __construct(AltoRouter $router)
    {
        $this->match = $router->match();

        if (!$this->match) {
            header($_SERVER['SERVER_PROTOCOL'] . '404 Not Found');
            view('errors/404');
            exit;
        }
        list($controller, $method) = explode('@', $this->match['target']);
        $this->controller = $this->namespace . $controller;
        $this->method = $method;

        if (!class_exists($this->controller)) {
            throw new Exception("class {$this->controller} does not exist");
        }
        if (!method_exists(new $this->controller, $this->method)) {
            throw new Exception("method: {$this->method} does not exist in class {$this->controller}");
        }
        // if (!is_callable([new $this->controller, $this->method])) {
        //     trigger_error("Method {$this->method} does not exist", E_USER_WARNING);
        // }
        call_user_func_array([new $this->controller, $this->method], $this->match['params']);
    }
}
