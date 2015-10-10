<?php

namespace VCR\Error;

use CurrencyCloud\CurrencyCloud;
use CurrencyCloud\Exception\BadRequestException;
use CurrencyCloud\Session;
use Exception;
use PHPUnit_Framework_TestCase;

class Test extends PHPUnit_Framework_TestCase
{

    /**
     * @vcr Error/contains_full_details_for_api_error.yaml
     * @test
     */
    public function containsFullDetailForApiError()
    {

        $session = new Session(
            Session::ENVIRONMENT_DEMONSTRATION, 'non-existent-login-id', 'ef0fd50fca1fb14c1fab3a8436b9ecb57528f0'
        );
        $client = CurrencyCloud::createDefault($session);

        try {
            $client->authenticate()
                ->login();
            $this->fail('Exception was not thrown');
        } catch (BadRequestException $e) {
            $expected = <<<EOT
BadRequestException
---
platform: 'PHP 5.6.14-1+deb.sury.org~trusty+1'
request:
    parameters:
        login_id: non-existent-login-id
        api_key: ef0fd50fca1fb14c1fab3a8436b9ecb57528f0
    verb: post
    url: 'https://devapi.thecurrencycloud.com/v2/authenticate/api'
response:
    status_code: 400
    date: 'Wed, 29 Apr 2015 22:46:53 GMT'
    request_id: '2775253392756800903'
errors:
    -
        field: api_key
        code: api_key_length_is_invalid
        message: 'api_key should be 64 character(s) long'
        params:
            length: 64

EOT;
            $this->assertEquals($expected, (string) $e);
            $this->assertEquals(
                'api_key should be 64 character(s) long',
                $e->getMessage()
            );
            $this->assertEquals(
                'auth_invalid_user_login_details',
                $e->getApiCode()
            );
        } catch (Exception $e) {
            $this->fail(
                sprintf('Expected to catch "%s", instead caught "%s"', BadRequestException::class, get_class($e))
            );
        }
    }
}
