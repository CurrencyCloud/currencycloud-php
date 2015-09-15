<?php

namespace CurrencyCloud\Model;

class InvalidConversionDate
{
    /**
     * @var string
     */
    private $date;
    /**
     * @var string
     */
    private $description;

    /**
     * @param string $date
     * @param string $description
     */
    public function __construct($date, $description)
    {
        $this->date = (string) $date;
        $this->description = (string) $description;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
