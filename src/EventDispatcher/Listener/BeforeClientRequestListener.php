<?php

namespace CurrencyCloud\EventDispatcher\Listener;

use CurrencyCloud\EntryPoint\AuthenticateEntryPoint;
use CurrencyCloud\EventDispatcher\Event\BeforeClientRequestEvent;
use CurrencyCloud\Session;

class BeforeClientRequestListener
{

    /**
     * @var AuthenticateEntryPoint
     */
    private $authenticateEntryPoint;
    /**
     * @var Session
     */
    private $session;

    /**
     * @param Session $session
     * @param AuthenticateEntryPoint $authenticateEntryPoint
     */
    public function __construct(Session $session, AuthenticateEntryPoint $authenticateEntryPoint)
    {
        $this->authenticateEntryPoint = $authenticateEntryPoint;
        $this->session = $session;
    }

    public function onBeforeClientRequestEvent(BeforeClientRequestEvent $event)
    {
        if ($event->isSecured()) {
            if (null === $this->session->getAuthToken()) {
                $this->authenticateEntryPoint->login();
            }
        }
    }
}
