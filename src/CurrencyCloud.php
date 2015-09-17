<?php

namespace CurrencyCloud;

use CurrencyCloud\EntryPoint\AuthenticateEntryPoint;
use CurrencyCloud\EntryPoint\ReferenceEntryPoint;
use GuzzleHttp\Client;
use InvalidArgumentException;
use LogicException;

class CurrencyCloud
{
    /**
     * @var ReferenceEntryPoint
     */
    private $referenceEntryPoint;
    /**
     * @var Session
     */
    private $session;
    /**
     * @var AuthenticateEntryPoint
     */
    private $authenticateEntryPoint;

    /**
     * @param Session $session
     * @param AuthenticateEntryPoint $authenticateEntryPoint
     * @param ReferenceEntryPoint $referenceEntryPoint
     */
    public function __construct(
        Session $session,
        AuthenticateEntryPoint $authenticateEntryPoint,
        ReferenceEntryPoint $referenceEntryPoint
    ) {
        $this->referenceEntryPoint = $referenceEntryPoint;
        $this->session = $session;
        $this->authenticateEntryPoint = $authenticateEntryPoint;
    }

    public static function createDefault(Session $session, Client $client = null)
    {
        if (null === $client) {
            $client = new Client([
                'http_errors' => true
            ]);
        }
        return new CurrencyCloud(
            $session,
            new AuthenticateEntryPoint($session, $client),
            new ReferenceEntryPoint($session, $client)
        );
    }

    /**
     * @return ReferenceEntryPoint
     */
    public function reference()
    {
        return $this->referenceEntryPoint;
    }

    /**
     * @return AuthenticateEntryPoint
     */
    public function authenticate()
    {
        return $this->authenticateEntryPoint;
    }

    /**
     * @param $contactId
     * @param callable $callable
     * @throws InvalidArgumentException When contact ID is not UUID
     * @throws LogicException If already in on-behalf-of call
     */
    public function onBehalfOf($contactId, callable $callable)
    {
        $this->session->setOnBehalfOf($contactId);

        try {
            call_user_func($callable, $this);
        } finally {
            $this->session->clearOnBehalfOf();
        }
    }
}
