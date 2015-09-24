<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\Pagination;
use CurrencyCloud\Session;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use stdClass;

abstract class AbstractEntryPoint
{
    /**
     * @var Client
     */
    protected $client;
    /**
     * @var Session
     */
    protected $session;

    /**
     * @param Session $session
     * @param Client $client
     */
    public function __construct(Session $session, Client $client)
    {
        $this->client = $client;
        $this->session = $session;
    }

    /**
     * @param string $path
     * @param array $queryParams
     * @return string
     */
    protected function applyApiBaseUrl($path, array $queryParams)
    {
        if (count($queryParams) > 0) {
            return sprintf('%s/%s?%s', $this->session->getApiUrl(), $path, http_build_query($queryParams));
        }
        return sprintf('%s/%s', $this->session->getApiUrl(), $path);
    }

    /**
     * @param $method
     * @param $uri
     * @param array $queryParams
     * @param array $requestParams
     * @param array $options
     * @param bool $secured
     * @return array|stdClass
     * @throws GuzzleException
     * @throws Exception
     */
    protected function request(
        $method,
        $uri,
        array $queryParams = [],
        array $requestParams = [],
        array $options = [],
        $secured = true
    ) {
        //Check for on behalf of in order to inject it if needed
        $isOnBehalfOfUsedInParams = false;
        foreach ([&$queryParams, &$requestParams] as &$paramsArray) {
            if (array_key_exists('on_behalf_of', $paramsArray)) { //isset is not used because id skips null-s
                if (null !== $paramsArray['on_behalf_of']) {
                    $this->session->setOnBehalfOf($paramsArray['on_behalf_of']);
                    $isOnBehalfOfUsedInParams = true;
                } else {
                    $onBehalfOf = $this->session->getOnBehalfOf();
                    if (null !== $onBehalfOf) {
                        $paramsArray['on_behalf_of'] = $onBehalfOf;
                    }
                }
            }
        }
        try {
            //Wrap whole section if someone, for example, throws exceptions for PHP warnings etc.
            if ($secured) {
                //Perhaps check here if auth token set?
                $options['headers']['X-Auth-Token'] = $this->session->getAuthToken();
            }
            if (count($requestParams) > 0) {
                $requestParams = array_filter($requestParams, function ($v) {
                    return null !== $v;
                });
                if (!isset($options['form_params'])) {
                    $options['form_params'] = [];
                }
                $options['form_params'] = array_merge($options['form_params'], $requestParams);
            }

            //Force no-exceptions in order to provide descriptive error messages
            $options['http_errors'] = false;

            $response = $this->client->request($method, $this->applyApiBaseUrl($uri, $queryParams), $options);

            switch ($response->getStatusCode()) {
                case 200:
                    $data = json_decode($response->getBody()->getContents());

                    if (
                        !is_array($data)
                        &&
                        !is_object($data)
                    ) {
                        //throw exception
                    }

                    return $data;
            }
        } finally {
            //If on-behalf-of was injected through params, clear it now
            if ($isOnBehalfOfUsedInParams) {
                $this->session->clearOnBehalfOf();
            }
        }
        throw new Exception($response->getBody()->getContents());
    }
}
