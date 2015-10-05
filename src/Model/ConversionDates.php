<?php

namespace CurrencyCloud\Model;

use DateTime;

class ConversionDates
{

    /**
     * @var InvalidConversionDate[]
     */
    private $invalidConversionDates;
    /**
     * @var DateTime
     */
    private $firstConversionDay;
    /**
     * @var DateTime
     */
    private $defaultConversionDay;

    /**
     * @param InvalidConversionDate[] $invalidConversionDates
     * @param DateTime $firstConversionDay
     * @param DateTime $defaultConversionDay
     */
    public function __construct(
        array $invalidConversionDates,
        DateTime $firstConversionDay,
        DateTime $defaultConversionDay
    ) {
        $this->invalidConversionDates = $invalidConversionDates;
        $this->firstConversionDay = $firstConversionDay;
        $this->defaultConversionDay = $defaultConversionDay;
    }

    /**
     * @return InvalidConversionDate[]
     */
    public function getInvalidConversionDates()
    {
        return $this->invalidConversionDates;
    }

    /**
     * @return DateTime
     */
    public function getFirstConversionDay()
    {
        return $this->firstConversionDay;
    }

    /**
     * @return DateTime
     */
    public function getDefaultConversionDay()
    {
        return $this->defaultConversionDay;
    }
}
