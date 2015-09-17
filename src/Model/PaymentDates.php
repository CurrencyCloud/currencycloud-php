<?php

namespace CurrencyCloud\Model;

class PaymentDates
{
    /**
     * @var InvalidPaymentDate[]
     */
    private $invalidPaymentDates;
    /**
     * @var string
     */
    private $firstPaymentDay;

    /**
     * @param InvalidPaymentDate[] $invalidPaymentDates
     * @param string $firstPaymentDay
     */
    public function __construct(array $invalidPaymentDates, $firstPaymentDay)
    {
        $this->invalidPaymentDates = $invalidPaymentDates;
        $this->firstPaymentDay = (string) $firstPaymentDay;
    }

    /**
     * @return InvalidPaymentDate[]
     */
    public function getInvalidPaymentDates()
    {
        return $this->invalidPaymentDates;
    }

    /**
     * @return string
     */
    public function getFirstPaymentDay()
    {
        return $this->firstPaymentDay;
    }
}
