<?php

namespace CurrencyCloud\Model;

use DateTime;

class PaymentDates
{
    /**
     * @var InvalidPaymentDate[]
     */
    private $invalidPaymentDates;
    /**
     * @var DateTime
     */
    private $firstPaymentDay;

    /**
     * @param InvalidPaymentDate[] $invalidPaymentDates
     * @param string $firstPaymentDay
     */
    public function __construct(array $invalidPaymentDates, $firstPaymentDay)
    {
        $this->invalidPaymentDates = $invalidPaymentDates;
        $this->firstPaymentDay = new DateTime((string) $firstPaymentDay);
    }

    /**
     * @return InvalidPaymentDate[]
     */
    public function getInvalidPaymentDates()
    {
        return $this->invalidPaymentDates;
    }

    /**
     * @return DateTime
     */
    public function getFirstPaymentDay()
    {
        return $this->firstPaymentDay;
    }
}
