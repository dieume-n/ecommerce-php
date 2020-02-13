<?php

namespace AppTest\Unit\Utilities;

use AppTest\BaseCase;
use App\Utilities\Session\SessionManager;

class SessionTest extends BaseCase
{
    public function testCanSetAndGetSession()
    {
        SessionManager::start();
        SessionManager::set('test', 1234);
        $this->assertTrue(
            SessionManager::has('test'),
            "Session::has returned false after calling Session::set"
        );
        $this->assertEquals(
            1234,
            SessionManager::get('test'),
            "Session::get returned false value after calling Session::get"
        );
    }

    /**
     * @depends testCanSetAndGetSession
     */
    public function testCanRemoveSession()
    {
        SessionManager::remove('test');
        $this->assertFalse(
            SessionManager::has('test'),
            "Session::has returned false after calling Session::remove"
        );
        $this->assertCount(
            0,
            SessionManager::all(),
            "Session::all did not return 0 after calling Session::remove"
        );
    }

    public function testCanDestroySession()
    {
        SessionManager::start();
        SessionManager::set('test', [123, 'abc']);

        $this->assertTrue(
            SessionManager::has('test'),
            "Session::has returned false after calling Session::set with array"
        );
        $this->assertEquals(
            [123, "abc"],
            SessionManager::get('test'),
            "Session::get returned incorrect value after calling Session::set with array"
        );

        SessionManager::destroy();

        $this->assertCount(
            0,
            SessionManager::all(),
            "Session::all did not return 0 records after calling Session::destroy"
        );
    }
}
