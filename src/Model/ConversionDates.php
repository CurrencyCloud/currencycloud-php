<?php

namespace CurrencyCloud\Model;

use DateTime;
use stdClass;

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
     * @param string $firstConversionDay
     * @param string $defaultConversionDay
     */
    public function __construct(array $invalidConversionDates, $firstConversionDay, $defaultConversionDay)
    {
        $this->invalidConversionDates = $invalidConversionDates;
        $this->firstConversionDay = new DateTime((string) $firstConversionDay);
        $this->defaultConversionDay = new DateTime((string) $defaultConversionDay);
    }

    /**
     * @param stdClass $response
     * @return ConversionDates
     */
    public static function createFromResponse(stdClass $response)
    {
        $invalidDates = [];

        foreach ($response->invalid_conversion_dates as $date => $description) {
            $invalidDates[] = new InvalidConversionDate($date, $description);
        }

        return new ConversionDates(
            $invalidDates,
            $response->first_conversion_date,
            $response->default_conversion_date
        );
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
