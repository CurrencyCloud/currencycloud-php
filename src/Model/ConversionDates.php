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
     * @var DateTime
     */
    private $firstConversionCutoffDatetime;
    /**
     * @var DateTime
     */
    private $optimizeLiquidityConversionDate;
    /**
     * @var DateTime
     */
    private $nextDayConversionDate;

    /**
     * @param InvalidConversionDate[] $invalidConversionDates
     * @param DateTime $firstConversionDay
     * @param DateTime $defaultConversionDay
     * @param DateTime $firstConversionCutoffDatetime
     * @param DateTime $optimizeLiquidityConversionDate
     * @param DateTime $nextDayConversionDate
     */
    public function __construct(
        array $invalidConversionDates,
        DateTime $firstConversionDay,
        DateTime $defaultConversionDay,
        DateTime $firstConversionCutoffDatetime,
        DateTime $optimizeLiquidityConversionDate,
        DateTime $nextDayConversionDate
    ) {
        $this->invalidConversionDates = $invalidConversionDates;
        $this->firstConversionDay = $firstConversionDay;
        $this->defaultConversionDay = $defaultConversionDay;
        $this->firstConversionCutoffDatetime = $firstConversionCutoffDatetime;
        $this->optimizeLiquidityConversionDate = $optimizeLiquidityConversionDate;
        $this->nextDayConversionDate = $nextDayConversionDate;
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
    public function getFirstConversionDate()
    {
        return $this->firstConversionDay;
    }

    /**
     * @return DateTime
     */
    public function getDefaultConversionDate()
    {
        return $this->defaultConversionDay;
    }

    /**
     * @return DateTime
     */
    public function getFirstConversionCutoffDatetime()
    {
        return $this->firstConversionCutoffDatetime;
    }

    /**
     * @return DateTime
     */
    public function getOptimizeLiquidityConversionDate()
    {
        return $this->optimizeLiquidityConversionDate;
    }

    /**
     * @return DateTime
     */
    public function getNextDayConversionDate()
    {
        return $this->nextDayConversionDate;
    }


}
