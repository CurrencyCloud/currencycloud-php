<?php

namespace CurrencyCloud\EventDispatcher\Event;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\EventDispatcher\Event;

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
     * @param ResponseInterface $response
     * @param array $requestParams
     * @param string $method
     * @param string $url
     */
    public function __construct(ResponseInterface $response, array $requestParams, $method, $url)
    {
        $this->response = $response;
        $this->requestParams = $requestParams;
        $this->method = $method;
        $this->url = $url;
    }

    /**
     * @return mixed
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
}
