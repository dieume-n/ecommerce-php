<?php

namespace AppTest\Unit\Utilities;

use App\Utilities\Helpers\RequestValidator;
use AppTest\BaseCase;

class RequestValidatorTest extends BaseCase
{
    public function testCanValidateEmail()
    {
        $email  = "dieume@gmail.com";
        $this->assertTrue(
            RequestValidator::email('email', $email, true),
            "RequestValidator::email did not return true after calling RequestValidator::email"
        );
    }

    public function testCanValidateStringNumberAndMixed()
    {
        $string  = "Dieu Merci";
        $number = 123.5;
        $mixed = "this isader@41";

        $this->assertTrue(
            RequestValidator::number('number', $number, true),
            "RequestValidator::number did not return true after calling RequestValidator::number"
        );

        $this->assertTrue(
            RequestValidator::mixed('mixed', $mixed, true),
            "RequestValidator::mixed did not return true after calling RequestValidator::mixed"
        );

        $this->assertTrue(
            RequestValidator::string('string', $string, true),
            "RequestValidator::string did not return true after calling RequestValidator::string"
        );
    }

    public function testCanValidateMultiple()
    {
        $rules = [
            'name' => ['required' => true, 'maxLength' => 5, 'string' => true]
        ];
        $validate = new RequestValidator;
        $validate->abide(['name' => "Dieu Merci"], $rules);
        $error = $validate->hasError();

        $this->assertTrue(
            $validate->hasError(),
            "RequestValidator::hasError return false after calling RequestValidator::abide with bad data"
        );

        $this->assertCount(
            1,
            $validate->getErrorMessages(),
            "RequestValidator::getErrorMessages did not return 1 after calling RequestValidator::abide with bad data"
        );
    }
}
