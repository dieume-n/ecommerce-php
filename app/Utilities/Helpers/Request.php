<?php

namespace App\Utilities\Helpers;

class Request
{
    /**
     * return all request available (GET, POST and FILES)
     *
     * @param boolean $is_array
     * @return mixed
     */
    public static function all($is_array = false)
    {
        $request = [];
        if (count($_GET) > 0) $request['get'] = $_GET;
        if (count($_POST) > 0) $request['post'] = $_POST;
        $request['file'] = $_FILES;

        return json_decode(json_encode($request), $is_array);
    }

    /**
     * Get specific type of request (GET or POST)
     *
     * @param string $key
     * @return mixed
     */
    public static function get($key)
    {
        $object = new static;
        $request = $object->all(true);
        return $request->$key;
    }

    public static function has($key)
    {
        return (array_key_exists($key, self::all(true))) ? true : false;
    }

    /**
     * Old request data
     *
     * @param string $key
     * @param string $value
     * @return mixed
     */
    public function old($key, $value)
    {
        $object = new static;
        $request = $object->all();
        return isset($request->$key->$value) ? $request->$key->$value : null;
    }
    /**
     * Reseting Super gobal variables
     *
     * @return void
     */
    public static function refresh()
    {
        $_POST =  [];
        $_GET = [];
        $_FILES = [];
    }
}
