<?php

namespace CurrencyCloud\EntryPoint;

class AuthenticateEntryPoint extends AbstractEntryPoint
{

    /**
     *
     */
    public function login()
    {
        $response = $this->request(
            'POST', 'authenticate/api', [], [
                'form_params' => [
                    'login_id' => $this->session->getLoginId(),
                    'api_key' => $this->session->getApiKey(),
                ]
            ], false
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
