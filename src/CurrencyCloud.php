<?php

namespace CurrencyCloud;

use CurrencyCloud\EntryPoint\AccountsEntryPoint;
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
     * @var AccountsEntryPoint
     */
    private $accountsEntryPoint;

    /**
     * @param Session $session
     * @param AuthenticateEntryPoint $authenticateEntryPoint
     * @param AccountsEntryPoint $accountsEntryPoint
     * @param ReferenceEntryPoint $referenceEntryPoint
     */
    public function __construct(
        Session $session,
        AuthenticateEntryPoint $authenticateEntryPoint,
        AccountsEntryPoint $accountsEntryPoint,
        ReferenceEntryPoint $referenceEntryPoint
    ) {
        $this->referenceEntryPoint = $referenceEntryPoint;
        $this->session = $session;
        $this->authenticateEntryPoint = $authenticateEntryPoint;
        $this->accountsEntryPoint = $accountsEntryPoint;
    }

    public static function createDefault(Session $session, Client $client = null)
    {
        if (null === $client) {
            $client = new Client();
        }
        return new CurrencyCloud(
            $session,
            new AuthenticateEntryPoint($session, $client),
            new AccountsEntryPoint($session, $client),
            new ReferenceEntryPoint($session, $client)
        );
    }

    /**
     * @return AuthenticateEntryPoint
     */
    public function authenticate()
    {
        return $this->authenticateEntryPoint;
    }

    /**
     * @return AccountsEntryPoint
     */
    public function accounts()
    {
        return $this->accountsEntryPoint;
    }

    /**
     * @return ReferenceEntryPoint
     */
    public function reference()
    {
        return $this->referenceEntryPoint;
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
