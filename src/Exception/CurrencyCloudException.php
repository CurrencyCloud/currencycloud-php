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
     * @var string
     */
    private $apiCode;

    /**
     * CurrencyCloudException constructor.
     *
     * @param string $parameters
     * @param string $httpMethod
     * @param string $url
     * @param string $message
     * @param string $apiCode
     * @param Exception|null $previous
     */
    public function __construct(
        $parameters,
        $httpMethod,
        $url,
        $message = '',
        $apiCode = '',
        Exception $previous = null
    ) {
        parent::__construct($message, 0, $previous);
        $this->parameters = $parameters;
        $this->httpMethod = strtolower($httpMethod);
        $this->url = (string) $url;
        $this->apiCode = (string) $apiCode;
    }

    /**
     * @return string
     */
    public function getApiCode()
    {
        return $this->apiCode;
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
            $this->compiled = trim(sprintf(
                "%s\n---\n%s",
                basename(str_replace('\\', '/', get_class($this))),
                $dumper->dump($this->getCompileProperties(), PHP_INT_MAX)
            ));
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
                'verb' => $this->httpMethod,
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
     * @return string
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
