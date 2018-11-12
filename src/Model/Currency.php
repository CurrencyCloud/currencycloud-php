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
     * @var bool
     */
    private $canBuy;
    /**
     * @var bool
     */
    private $canSell;

    /**
     * @param string $code
     * @param int $decimalPlaces
     * @param string $name
     * @param bool $onlineTrading
     * @param bool $canBuy
     * @param bool $canSell
     */
    public function __construct($code, $decimalPlaces, $name, $onlineTrading, $canBuy, $canSell)
    {
        $this->code = strtoupper($code);
        $this->decimalPlaces = (int) $decimalPlaces;
        $this->name = (string) $name;
        $this->onlineTrading = (bool) $onlineTrading;
        $this->canBuy = (bool) $canBuy;
        $this->canSell = (bool) $canSell;
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

    /**
     * @return bool
     */
    public function getCanBuy()
    {
        return $this->canBuy;
    }

    /**
     * @return bool
     */
    public function getCanSell()
    {
        return $this->canSell;
    }
}
