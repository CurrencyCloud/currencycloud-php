<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Client;
use CurrencyCloud\Session;

class AuthenticateEntryPoint extends AbstractEntryPoint
{

    /**
     * @var Session
     */
    private $session;

    /**
     * @param Session $session
     * @param Client $client
     */
    public function __construct(Session $session, Client $client)
    {
        parent::__construct($client);
        $this->session = $session;
    }

    /**
     *
     */
    public function login()
    {
        $response = $this->request(
            'POST',
            'authenticate/api',
            [],
            [
                'login_id' => $this->session->getLoginId(),
                'api_key' => $this->session->getApiKey()
            ],
            [],
            false
        );

        $this->session->setAuthToken($response->auth_token);
    }

    /**
     *
     */
    public function close()
    {
        $this->request('POST', 'authenticate/close_session');
        $this->session->setAuthToken(null);
    }
}
