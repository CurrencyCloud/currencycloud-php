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
     * @param \stdClass $response
     * @return PaymentDates
     */
    public static function createFromResponse(\stdClass $response)
    {
        $invalidDates = [];

        foreach ($response->invalid_payment_dates as $date => $description) {
            $invalidDates[] = new InvalidPaymentDate($date, $description);
        }

        return new PaymentDates(
            $invalidDates,
            $response->first_payment_date
        );
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
