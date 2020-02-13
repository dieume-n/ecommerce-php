<?php

namespace App\Utilities\Session;

use Dotenv\Dotenv;

class SessionManager
{
    /**
     * Delegate class to a method 
     * of the chosen session class
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        $session = static::className();
        return call_user_func_array([new $session, $name], $arguments);
    }

    /**
     * Get qualifying session driver class name
     *
     * @return string
     */
    public static function className()
    {
        $driver = getenv('SESSION_DRIVER');
        return __NAMESPACE__ . "\\" . ucfirst($driver) . "Session";
    }
}
