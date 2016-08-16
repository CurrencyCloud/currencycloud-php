<?php

namespace CurrencyCloud\Model;

class Currency
{

    /**
     * @var string
     */
    private $code;
    /**
     * @var int
     */
    private $decimalPlaces;
    /**
     * @var string
     */
    private $name;
    /**
     * @var bool
     */
    private $onlineTrading;

    /**
     * @param string $code
     * @param int $decimalPlaces
     * @param string $name
     * @param bool $onlineTrading
     */
    public function __construct($code, $decimalPlaces, $name, $onlineTrading)
    {
        $this->code = strtoupper($code);
        $this->decimalPlaces = (int) $decimalPlaces;
        $this->name = (string) $name;
        $this->onlineTrading = (bool) $onlineTrading;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return int
     */
    public function getDecimalPlaces()
    {
        return $this->decimalPlaces;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function getOnlineTrading()
    {
        return $this->onlineTrading;
    }
}
