<?php
namespace CurrencyCloud\Model;

use DateTime;

class ConversionDateChangeQuote {

    /**
     * @var string
     */
    private $conversionId;
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
    private $newConversionDate;
    /**
     * @var DateTime
     */
    private $newSettlementDate;
    /**
     * @var DateTime
     */
    private $oldConversionDate;
    /**
     * @var DateTime
     */
    private $oldSettlementDate;
    /**
     * @var DateTime
     */
    private $eventDateTime;

    /**
     * ConversionDateChangeQuote constructor.
     * @param string $conversionId
     * @param string $amount
     * @param string $currency
     * @param DateTime $newConversionDate
     * @param DateTime $newSettlementDate
     * @param DateTime $oldConversionDate
     * @param DateTime $oldSettlementDate
     * @param DateTime $eventDateTime
     */
    public function __construct($conversionId, $amount, $currency, DateTime $newConversionDate, DateTime $newSettlementDate, DateTime $oldConversionDate, DateTime $oldSettlementDate, DateTime $eventDateTime)
    {
        $this->conversionId = $conversionId;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->newConversionDate = $newConversionDate;
        $this->newSettlementDate = $newSettlementDate;
        $this->oldConversionDate = $oldConversionDate;
        $this->oldSettlementDate = $oldSettlementDate;
        $this->eventDateTime = $eventDateTime;
    }

    /**
     * @return string
     */
    public function getConversionId()
    {
        return $this->conversionId;
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
    public function getNewConversionDate()
    {
        return $this->newConversionDate;
    }

    /**
     * @return DateTime
     */
    public function getNewSettlementDate()
    {
        return $this->newSettlementDate;
    }

    /**
     * @return DateTime
     */
    public function getOldConversionDate()
    {
        return $this->oldConversionDate;
    }

    /**
     * @return DateTime
     */
    public function getOldSettlementDate()
    {
        return $this->oldSettlementDate;
    }

    /**
     * @return DateTime
     */
    public function getEventDateTime()
    {
        return $this->eventDateTime;
    }
}