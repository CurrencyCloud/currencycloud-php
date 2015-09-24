<?php

namespace CurrencyCloud\Model;

use stdClass;

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
     * @param stdClass $response
     * @return Currency
     */
    public static function createFromResponse(stdClass $response)
    {
        return new Currency(
            $response->code,
            $response->decimal_places,
            $response->name
        );
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
