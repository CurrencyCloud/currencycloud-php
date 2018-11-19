<?php
namespace CurrencyCloud\Model;

use DateTime;

class ConversionCancellationQuote {

    /**
     * @var string
     */
    private $amount;
    /**
     * @var string
     */
    private $currency;
    /**
     * @var DateTime
     */
    private $eventDateTime;

    /**
     * ConversionCancellationQuote constructor.
     * @param string $amount
     * @param string $currency
     * @param DateTime $eventDateTime
     */
    public function __construct($amount, $currency, DateTime $eventDateTime)
    {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->eventDateTime = $eventDateTime;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return DateTime
     */
    public function getEventDateTime()
    {
        return $this->eventDateTime;
    }
}