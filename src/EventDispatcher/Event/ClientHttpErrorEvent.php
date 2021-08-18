<?php

namespace CurrencyCloud\EventDispatcher\Event;

use Psr\Http\Message\ResponseInterface;
use Symfony\Contracts\EventDispatcher\Event;


final class ClientHttpErrorEvent extends Event
{
    const NAME = 'client.response.error.event';
    /**
     * @var ResponseInterface
     */
    private $response;
    /**
     * @var
     */
    private $requestParams;
    /**
     * @var
     */
    private $method;
    /**
     * @var
     */
    private $url;
    /**
     * @var array
     */
    private $originalRequest;
    /**
     * @var mixed
     */
    private $interceptedResponse;

    /**
     * @param ResponseInterface $response
     * @param array $requestParams
     * @param string $method
     * @param string $url
     * @param array $originalRequest
     */
    public function __construct(ResponseInterface $response, array $requestParams, $method, $url, array $originalRequest)
    {
        $this->response = $response;
        $this->requestParams = $requestParams;
        $this->method = $method;
        $this->url = $url;
        $this->originalRequest = $originalRequest;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return mixed
     */
    public function getRequestParams()
    {
        return $this->requestParams;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return array
     */
    public function getOriginalRequest()
    {
        return $this->originalRequest;
    }

    /**
     * @param mixed $response
     */
    public function setInterceptedResponse($response)
    {
        $this->interceptedResponse = $response;
    }

    /**
     * @return mixed
     */
    public function getInterceptedResponse()
    {
        return $this->interceptedResponse;
    }
}
