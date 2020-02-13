<?php

namespace App\Utilities\Session;

class FileSession implements SessionContract
{
    /**
     * Start session
     *
     * @return void
     */
    public function start()
    {
        session_start([
            'save_path' => realpath(__DIR__ . "/../../../" . getenv('SESSION_PATH'))
        ]);
    }

    /**
     * Get all sessions
     *
     * @return array
     */
    public function all()
    {
        return $_SESSION;
    }
    /**
     * Check if session has a given key.    
     *
     * @param string $key
     * @return boolean
     */
    public function has($key)
    {
        return array_key_exists($key, $_SESSION);
    }

    /**
     * Set session
     *
     * @param mixed $key
     * @param mixed $value
     * @return void
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Get session value for the specified key
     *
     * @param mixed $key
     * @return mixed
     */
    public function get($key)
    {
        if (!$this->has($key)) {
            return null;
        }
        return $_SESSION[$key];
    }

    /**
     * Remove session by key
     *
     * @param mixed $key
     * @return void
     */
    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * Destroy session
     *
     * @return void
     */
    public function destroy()
    {
        session_destroy();
    }
}
