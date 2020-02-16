<?php

namespace AppTest\Unit\Utilities;

use AppTest\BaseCase;
use App\Utilities\Session\SessionManager;
use App\Utilities\Helpers\CSRFToken;

class CSRFTokenTest extends BaseCase
{
    public function testCanGenerateToken()
    {
        SessionManager::start();
        CSRFToken::token();
        $this->assertTrue(
            SessionManager::has('token'),
            "Session::has returned false after calling CSRFToken::token"
        );
    }

    /**
     * @depends testCanGenerateToken
     */
    public function testCanVerifyCSRFToken()
    {
        $this->assertTrue(
            CSRFToken::verifyCSRFToken(CSRFToken::token()),
            "CSRFToken::verifyCSRFToken has returned false after calling CSRF::verifyCSRFToken"
        );

        $this->assertFalse(
            SessionManager::has('token'),
            "SessionManager::has has return True after calling SessionManager::remove in CSRFToken::verifyCSRFToken"
        );
    }
}
