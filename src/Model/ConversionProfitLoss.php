<?php
namespace CurrencyCloud\Model;

use DateTime;

class ConversionProfitLoss {

    /**
     * @var string
     */
    private $accountId;
    /**
     * @var string
     */
    private $contactId;
    /**
     * @var string
     */
    private $eventAccountId;
    /**
     * @var string
     */
    private $eventContactId;
    /**
     * @var string
     */
    private $conversionId;
    /**
     * @var string
     */
    private $eventType;
    /**
     * @var string
     */
    private $amount;
    /**
     * @var string
     */
    private $currency;
    /**
     * @var string
     */
    private $notes;
    /**
     * @var DateTime
     */
    private $eventDateTime;

    /**
     * ConversionProfitLoss constructor.
     * @param string $accountId
     * @param string $contactId
     * @param string $eventAccountId
     * @param string $eventContactId
     * @param string $conversionId
     * @param string $eventType
     * @param string $amount
     * @param string $currency
     * @param string $notes
     * @param DateTime $eventDateTime
     */
    public function __construct($accountId, $contactId, $eventAccountId, $eventContactId, $conversionId, $eventType, $amount, $currency, $notes, $eventDateTime)
    {
        $this->accountId = $accountId;
        $this->contactId = $contactId;
        $this->eventAccountId = $eventAccountId;
        $this->eventContactId = $eventContactId;
        $this->conversionId = $conversionId;
        $this->eventType = $eventType;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->notes = $notes;
        $this->eventDateTime = $eventDateTime;
    }

    /**
     * @return string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @return string
     */
    public function getContactId()
    {
        return $this->contactId;
    }

    /**
     * @return string
     */
    public function getEventAccountId()
    {
        return $this->eventAccountId;
    }

    /**
     * @return string
     */
    public function getEventContactId()
    {
        return $this->eventContactId;
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
    public function getEventType()
    {
        return $this->eventType;
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
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @return DateTime
     */
    public function getEventDateTime()
    {
        return $this->eventDateTime;
    }

}