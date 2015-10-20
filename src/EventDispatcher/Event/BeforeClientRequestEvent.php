<?php

namespace CurrencyCloud\EventDispatcher\Event;

use Symfony\Component\EventDispatcher\Event;

final class BeforeClientRequestEvent extends Event
{

    const NAME = 'client.request.before.event';
    /**
     * @var string
     */
    private $method;
    /**
     * @var string
     */
    private $uri;
    /**
     * @var array
     */
    private $queryParams;
    /**
     * @var array
     */
    private $requestParams;
    /**
     * @var array
     */
    private $options;
    /**
     * @var bool
     */
    private $secured;

    /**
     * @param string $method
     * @param string $uri
     * @param array $queryParams
     * @param array $requestParams
     * @param array $options
     * @param bool $secured
     */
    public function __construct(
        $method,
        $uri,
        array $queryParams,
        array $requestParams,
        array $options,
        $secured
    ) {
        $this->method = $method;
        $this->uri = $uri;
        $this->queryParams = $queryParams;
        $this->requestParams = $requestParams;
        $this->options = $options;
        $this->secured = $secured;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return array
     */
    public function getQueryParams()
    {
        return $this->queryParams;
    }

    /**
     * @return array
     */
    public function getRequestParams()
    {
        return $this->requestParams;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @return boolean
     */
    public function isSecured()
    {
        return $this->secured;
    }
}
