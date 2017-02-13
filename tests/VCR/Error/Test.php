<?php

namespace CurrencyCloud\Tests\VCR\Error;

use CurrencyCloud\CurrencyCloud;
use CurrencyCloud\Exception\AuthenticationException;
use CurrencyCloud\Exception\BadRequestException;
use CurrencyCloud\Exception\ForbiddenException;
use CurrencyCloud\Exception\InternalApplicationException;
use CurrencyCloud\Exception\NotFoundException;
use CurrencyCloud\Exception\ToManyRequestsException;
use CurrencyCloud\Tests\BaseCurrencyCloudVCRTestCase;
use Exception;

class Test extends BaseCurrencyCloudVCRTestCase
{

    /**
     * @vcr Error/contains_full_details_for_api_error.yaml
     * @test
     */
    public function containsFullDetailForApiError()
    {
        try {
            $this->getInvalidClient()
                ->authenticate()
                ->login();
            $this->fail('Exception was not thrown');
        } catch (BadRequestException $e) {
            $expected = <<<EOT
BadRequestException
---
platform: 'PHP %s'
request:
    parameters:
        login_id: non-existent-login-id
        api_key: ef0fd50fca1fb14c1fab3a8436b9ecb57528f0
    verb: post
    url: 'https://devapi.currencycloud.com/v2/authenticate/api'
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
            $this->assertSame(sprintf($expected, phpversion()), (string) $e);
            $this->assertSame(
                'api_key should be 64 character(s) long',
                $e->getMessage()
            );
            $this->assertSame(
                'auth_invalid_user_login_details',
                $e->getApiCode()
            );
            $this->assertSame('Wed, 29 Apr 2015 22:46:53 GMT', $e->getDate());
            $this->assertSame('2775253392756800903', $e->getRequestId());
            $this->assertSame(400, $e->getStatusCode());
            $this->assertSame('https://devapi.currencycloud.com/v2/authenticate/api', $e->getUrl());
            $this->assertSame('post', $e->getHttpMethod());
            $this->assertSame(400, $e->getStatusCode());
            $this->assertSame('auth_invalid_user_login_details', $e->getApiCode());

            $errors = $e->getErrors();
            $this->assertInternalType('array', $errors);
            $this->assertArrayHasKey(0, $errors);
            $this->assertCount(1, $errors);
            $sub = $errors[0];
            $this->assertCount(4, $sub);
            $this->assertArrayHasKey('field', $sub);
            $this->assertArrayHasKey('code', $sub);
            $this->assertArrayHasKey('message', $sub);
            $this->assertArrayHasKey('params', $sub);

            $this->assertSame('api_key', $sub['field']);
            $this->assertSame('api_key_length_is_invalid', $sub['code']);
            $this->assertSame('api_key should be 64 character(s) long', $sub['message']);

            $params = $sub['params'];

            $this->assertInternalType('array', $params);
            $this->assertCount(1, $params);
            $this->assertArrayHasKey('length', $params);
            $this->assertSame(64, $params['length']);

            $params = $e->getParameters();

            $this->assertInternalType('array', $params);
            $this->assertCount(2, $params);
            $this->assertArrayHasKey('login_id', $params);
            $this->assertArrayHasKey('api_key', $params);

            $this->assertSame('non-existent-login-id', $params['login_id']);
            $this->assertSame('ef0fd50fca1fb14c1fab3a8436b9ecb57528f0', $params['api_key']);
        } catch (Exception $e) {
            $this->fail(
                sprintf('Expected to catch "%s", instead caught "%s"', BadRequestException::class, get_class($e))
            );
        }
    }

    /**
     * @param string $apiKey
     * @param string $loginId
     *
     * @return CurrencyCloud
     */
    protected function getInvalidClient(
        $apiKey = 'ef0fd50fca1fb14c1fab3a8436b9ecb57528f0',
        $loginId = 'non-existent-login-id'
    ) {
        return parent::getClient($loginId, $apiKey);
    }

    /**
     * @vcr Error/is_raised_on_a_bad_request.yaml
     * @test
     */
    public function isRaisedOnABadRequest()
    {

        $this->setExpectedException(BadRequestException::class);

        $this->getInvalidClient()
            ->authenticate()
            ->login();
    }

    /**
     * @vcr Error/is_raised_on_a_forbidden_request.yaml
     * @test
     */
    public function isRaisedOnAForbiddenRequest()
    {

        $this->setExpectedException(ForbiddenException::class);

        $this->getClient()
            ->authenticate()
            ->login();
    }

    /**
     * @vcr Error/is_raised_on_an_internal_server_error.yaml
     * @test
     */
    public function isRaisedOnAnInternalServerError()
    {

        $this->setExpectedException(InternalApplicationException::class);

        $this->getClient()
            ->authenticate()
            ->login();
    }

    /**
     * @vcr Error/is_raised_on_incorrect_authentication_details.yaml
     * @test
     */
    public function isRaisedOnIncorrectAuthenticationDetails()
    {

        $this->setExpectedException(AuthenticationException::class);

        $this->getInvalidClient('efb5ae2af84978b7a37f18dd61c8bbe139b403009faea83484405a3dcb64c4d8')
            ->authenticate()
            ->login();
    }

    /**
     * @vcr Error/is_raised_when_a_resource_is_not_found.yaml
     * @test
     */
    public function isRaisedWhenAResourceIsNotFound()
    {

        $this->setExpectedException(NotFoundException::class);

        $client = $this->getAuthenticatedClient();
        $client->beneficiaries()
            ->retrieve('081596c9-02de-483e-9f2a-4cf55dcdf98c');
    }

    /**
     * @vcr Error/is_raised_when_too_many_requests_have_been_issued.yaml
     * @test
     */
    public function isRaisedWhenToManyRequestsHaveBeenIssued()
    {

        $this->setExpectedException(ToManyRequestsException::class);

        $this->getClient()
            ->authenticate()
            ->login();
    }
}
