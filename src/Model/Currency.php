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
     * @param string $code
     * @param int $decimalPlaces
     * @param string $name
     */
    public function __construct($code, $decimalPlaces, $name)
    {
        $this->code = strtoupper($code);
        $this->decimalPlaces = (int) $decimalPlaces;
        $this->name = (string) $name;
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
}
