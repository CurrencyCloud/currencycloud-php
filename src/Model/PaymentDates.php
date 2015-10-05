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
     * @param DateTime $firstPaymentDay
     */
    public function __construct(array $invalidPaymentDates, DateTime $firstPaymentDay)
    {
        $this->invalidPaymentDates = $invalidPaymentDates;
        $this->firstPaymentDay = $firstPaymentDay;
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
