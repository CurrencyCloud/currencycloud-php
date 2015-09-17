<?php

namespace CurrencyCloud\Model;

class ConversionDates
{
    /**
     * @var InvalidConversionDate[]
     */
    private $invalidConversionDates;
    /**
     * @var string
     */
    private $firstConversionDay;
    /**
     * @var string
     */
    private $defaultConversionDay;

    /**
     * @param InvalidConversionDate[] $invalidConversionDates
     * @param string $firstConversionDay
     * @param string $defaultConversionDay
     */
    public function __construct(array $invalidConversionDates, $firstConversionDay, $defaultConversionDay)
    {
        $this->invalidConversionDates = $invalidConversionDates;
        $this->firstConversionDay = (string) $firstConversionDay;
        $this->defaultConversionDay = (string) $defaultConversionDay;
    }

    /**
     * @return InvalidConversionDate[]
     */
    public function getInvalidConversionDates()
    {
        return $this->invalidConversionDates;
    }

    /**
     * @return string
     */
    public function getFirstConversionDay()
    {
        return $this->firstConversionDay;
    }

    /**
     * @return string
     */
    public function getDefaultConversionDay()
    {
        return $this->defaultConversionDay;
    }
}
