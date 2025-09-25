<?php

namespace CurrencyCloud\Model;

class PaymentValidationResult
{

    private const HEADER_SCA_ID = 'x-sca-id';
    private const HEADER_SCA_REQUIRED = 'x-sca-required';
    private const HEADER_SCA_TYPE = 'x-sca-type';

    /**
     * @var string
     */
    private $validationResult;

    /**
     * @var array
     */
    private $responseHeaders = [];

    public function __construct($validationResult, $responseHeaders)
    {
        $this->validationResult = (string)$validationResult;
        $this->responseHeaders = $responseHeaders;
    }

    /**
     * @return string
     */
    public function getValidationResult()
    {
        return $this->validationResult;
    }

    /**
     * @param string $validationResult
     *
     * @return $this
     */
    public function setValidationResult($validationResult)
    {
        $this->validationResult = $validationResult;
        return $this;
    }

    private function getHeader($key)
    {
        return isset($this->responseHeaders[$key]) ? $this->responseHeaders[$key][0] : null;
    }

    /**
     * @return string
     */
    public function getScaId()
    {
        return $this->getHeader(self::HEADER_SCA_ID);
    }

    /**
     * @return string
     */
    public function getScaRequired()
    {
        return $this->getHeader(self::HEADER_SCA_REQUIRED);
    }

    /**
     * @return string
     */
    public function getScaType()
    {
        return $this->getHeader(self::HEADER_SCA_TYPE);
    }
}
