<?php

namespace AppTest\Unit\Utilities;

use App\Utilities\Helpers\Request;
use AppTest\BaseCase;

class RequestTest extends BaseCase
{
    public function testCanGetAvailableRequest()
    {
        $_GET['name'] = "Cool";
        $_POST['dog'] = "Max";

        $this->assertCount(
            3,
            Request::all(true),
            "Request::all did not return 2 after setting 2 request data"
        );

        $this->assertTrue(
            Request::has('post'),
            "Request::has returned false when calling Request::has"
        );
        $this->assertTrue(
            Request::has('get'),
            "Request::has returned false when calling Request::has"
        );
    }

    /**
     * @depends testCanGetAvailableRequest
     */
    public function testCanRefreshRequest()
    {
        Request::refresh();
        $this->assertCount(
            1,
            Request::all(true),
            "Request::all did not return o after calling Request::refresh"
        );

        $this->assertFalse(
            Request::has('get'),
            "Request::has returned true after calling Request::refresh"
        );
    }
}
