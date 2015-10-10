<?php

namespace CurrencyCloud\Exception;

use Exception;
use RuntimeException;
use Symfony\Component\Yaml\Dumper;

abstract class CurrencyCloudException extends RuntimeException
{

    /**
     * @var string
     */
    private $parameters;
    /**
     * @var string
     */
    private $httpMethod;
    /**
     * @var string
     */
    private $url;
    /**
     * @var string
     */
    private $compiled;

    /**
     * CurrencyCloudException constructor.
     *
     * @param string $parameters
     * @param string $httpMethod
     * @param string $url
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct($parameters, $httpMethod, $url, $message = '', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->parameters = $parameters;
        $this->httpMethod = $httpMethod;
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getCompiled();
    }

    /**
     * @return string
     */
    protected function getCompiled()
    {
        if (null === $this->compiled) {
            $dumper = new Dumper();
            $this->compiled = sprintf(
                "%s\n---\n%s",
                basename(str_replace('\\', '/', get_class($this))),
                $dumper->dump($this->getCompileProperties(), PHP_INT_MAX)
            );
        }
        return $this->compiled;
    }

    /**
     * @return array
     */
    protected function getCompileProperties()
    {
        return [
            'platform' => sprintf('PHP %s', phpversion()),
            'request' => [
                'parameters' => $this->parameters,
                'verb' => strtolower($this->httpMethod),
                'url' => $this->url
            ]
        ];
    }

    /**
     * @return string
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param string $parameters
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * @param string $httpMethod
     */
    public function setHttpMethod($httpMethod)
    {
        $this->httpMethod = $httpMethod;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
}
