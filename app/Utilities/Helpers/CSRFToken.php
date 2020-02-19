<?php

namespace App\Utilities\Helpers;

use App\Utilities\Session\SessionManager;

class CSRFToken
{
    /**
     * Generate a CSRF token
     *
     * @return string
     */
    public static function token()
    {

        if (!SessionManager::has('token')) {
            $token = base64_encode(openssl_random_pseudo_bytes(32));
            SessionManager::set('token', $token);
        }
        return SessionManager::get('token');
    }

    /**
     * Check and if CSRF token is from our site
     *
     * @param string $token
     * @return bool
     */
    public static function verifyCSRFToken($token, $regenearte = true)
    {
        if (SessionManager::has('token') && SessionManager::get('token') === $token) {
            if ($regenearte) {
                SessionManager::remove('token');
            }

            return true;
        }
        return false;
    }
}
