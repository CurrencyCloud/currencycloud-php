<?php

namespace CurrencyCloud;

use CurrencyCloud\EventDispatcher\Event\BeforeClientRequestEvent;
use CurrencyCloud\EventDispatcher\Event\ClientHttpErrorEvent;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use stdClass;
use Symfony\Component\EventDispatcher\EventDispatcher;

class Client
{


    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;
    /**
     * @var Session
     */
    protected $session;
    /**
     * @var EventDispatcher
     */
    private $eventDispatcher;

    /**
     * @param Session $session
     * @param \GuzzleHttp\Client $client
     * @param EventDispatcher $eventDispatcher
     */
    public function __construct(Session $session, \GuzzleHttp\Client $client, EventDispatcher $eventDispatcher)
    {
        $this->client = $client;
        $this->session = $session;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param string $method
     * @param string$uri
     * @param array $queryParams
     * @param array $requestParams
     * @param array $options
     * @param bool $secured
     *
     * @return array|stdClass
     * @throws GuzzleException
     * @throws Exception
     */
    public function request(
        $method,
        $uri,
        array $queryParams,
        array $requestParams,
        array $options,
        $secured
    ) {
        $this->eventDispatcher->dispatch(BeforeClientRequestEvent::NAME, new BeforeClientRequestEvent(
            $method,
            $uri,
            $queryParams,
            $requestParams,
            $options,
            $secured
        ));

        $originalRequest = [
            'method' => $method,
            'uri' => $uri,
            'queryParams' => $queryParams,
            'requestParams' => $requestParams,
            'option' => $options,
            'secured' => $secured
        ];

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

            $options['headers']['User-Agent'] = "CurrencyCloudSDK/2.0 PHP/0.11.0";

            $queryParams = array_filter($queryParams);
            $requestParams = array_filter($requestParams);
            if (count($requestParams) > 0) {
                if (!isset($options['form_params'])) {
                    $options['form_params'] = [];
                }
                $options['form_params'] = array_merge($options['form_params'], $requestParams);
            }

            //Force no-exceptions in order to provide descriptive error messages
            $options['http_errors'] = false;
            $url = $this->applyApiBaseUrl($uri, $queryParams);

            $response = $this->client->request($method, $url, $options);

            switch ($response->getStatusCode()) {
                case 200:
                    $data = json_decode(
                        $response->getBody()
                            ->getContents()
                    );
                    return $data;
                default:
                    //Everything that's not 200 consider error and dispatch event
                    $event = new ClientHttpErrorEvent(
                        $response,
                        $requestParams,
                        $method,
                        $url,
                        $originalRequest
                    );
                    $this->eventDispatcher->dispatch(ClientHttpErrorEvent::NAME, $event);
                    $interceptedResponse = $event->getInterceptedResponse();
                    if (null !== $interceptedResponse) {
                        return $interceptedResponse;
                    }
            }
        } finally {
            //If on-behalf-of was injected through params, clear it now
            if ($isOnBehalfOfUsedInParams) {
                $this->session->clearOnBehalfOf();
            }
        }
        throw new Exception(
            $response->getBody()
                ->getContents()
        );
    }

    /**
     * @param string $path
     * @param array $queryParams
     *
     * @return string
     */
    protected function applyApiBaseUrl($path, array $queryParams)
    {
        if (count($queryParams) > 0) {
            return sprintf('%s%s?%s', $this->session->getApiUrl(), $path, http_build_query($queryParams));
        }
        return sprintf('%s%s', $this->session->getApiUrl(), $path);
    }
}
