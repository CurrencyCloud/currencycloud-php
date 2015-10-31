<?php

namespace CurrencyCloud\Tests;

use CurrencyCloud\Session;
use InvalidArgumentException;
use LogicException;
use PHPUnit_Framework_TestCase;

class SessionTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Session
     */
    private $session;

    public function setUp()
    {
        $this->session = new Session(Session::ENVIRONMENT_DEMONSTRATION, 'a', 'b');
    }

    /**
     * @test
     */
    public function invalidEnvironmentThrowsException()
    {
        $this->setExpectedException(
            InvalidArgumentException::class,
            'Invalid environment test provided, expected one of [prod, demonstration, uat]'
        );
        new Session('test', 'test', 'test');
    }

    /**
     * @test
     */
    public function invalidLoginIdThrowsException()
    {
        $this->setExpectedException(InvalidArgumentException::class, 'Login ID can not be nul');
        new Session(Session::ENVIRONMENT_DEMONSTRATION, null, 'test');
    }

    /**
     * @test
     */
    public function invalidApiKeyThrowsException()
    {
        $this->setExpectedException(InvalidArgumentException::class, 'API key can not be null');
        new Session(Session::ENVIRONMENT_DEMONSTRATION, 'test', null);
    }

    /**
     * @test
     */
    public function onBehalfOfCanNotBeNull()
    {
        $this->setExpectedException(InvalidArgumentException::class, 'Contact ID expected to be UUID');
        $this->session->setOnBehalfOf(null);
    }

    /**
     * @test
     */
    public function onBehalfOfMustBeValidUUID()
    {
        $this->setExpectedException(InvalidArgumentException::class, 'Contact ID expected to be UUID');
        $this->session->setOnBehalfOf('bok');
    }

    /**
     * @test
     */
    public function onBehalfOfCanNotBeSetBeforeItIsUnset()
    {
        $this->setExpectedException(LogicException::class, 'Already in on-behalf-of call with ID: aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa');
        $this->session->setOnBehalfOf('aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa');
        $this->session->setOnBehalfOf('aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaab');
    }

    /**
     * @test
     */
    public function onBehalfOfCanBeSetAfterUnset()
    {
        $this->session->setOnBehalfOf('aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa');
        $this->assertEquals('aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa', $this->session->getOnBehalfOf());
        $this->session->clearOnBehalfOf();
        $this->assertNull($this->session->getOnBehalfOf());
        $this->session->setOnBehalfOf('aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaab');
        $this->assertEquals('aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaab', $this->session->getOnBehalfOf());
    }
}
