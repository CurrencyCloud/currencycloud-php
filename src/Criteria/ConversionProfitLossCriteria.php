<?php
namespace CurrencyCloud\Criteria;

class ConversionProfitLossCriteria {

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
    private $conversionId;
    /**
     * @var string
     */
    private $eventType;
    /**
     * @var string
     */
    private $eventDateTimeFrom;
    /**
     * @var string
     */
    private $eventDateTimeTo;
    /**
     * @var string
     */
    private $amountFrom;
    /**
     * @var string
     */
    private $amountTo;
    /**
     * @var string
     */
    private $currency;
    /**
     * @var string
     */
    private $scope;

    /**
     * @return string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @param string $accountId
     * @return $this
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
        return $this;
    }

    /**
     * @return string
     */
    public function getContactId()
    {
        return $this->contactId;
    }

    /**
     * @param string $contactId
     * @return $this
     */
    public function setContactId($contactId)
    {
        $this->contactId = $contactId;
        return $this;
    }

    /**
     * @return string
     */
    public function getConversionId()
    {
        return $this->conversionId;
    }

    /**
     * @param string $conversionId
     * @return $this
     */
    public function setConversionId($conversionId)
    {
        $this->conversionId = $conversionId;
        return $this;
    }

    /**
     * @return string
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * @param string $eventType
     * @return $this
     */
    public function setEventType($eventType)
    {
        $this->eventType = $eventType;
        return $this;
    }

    /**
     * @return string
     */
    public function getEventDateTimeFrom()
    {
        return $this->eventDateTimeFrom;
    }

    /**
     * @param string $eventDateTimeFrom
     * @return $this
     */
    public function setEventDateTimeFrom($eventDateTimeFrom)
    {
        $this->eventDateTimeFrom = $eventDateTimeFrom;
        return $this;
    }

    /**
     * @return string
     */
    public function getEventDateTimeTo()
    {
        return $this->eventDateTimeTo;
    }

    /**
     * @param string $eventDateTimeTo
     * @return $this
     */
    public function setEventDateTimeTo($eventDateTimeTo)
    {
        $this->eventDateTimeTo = $eventDateTimeTo;
        return $this;
    }

    /**
     * @return string
     */
    public function getAmountFrom()
    {
        return $this->amountFrom;
    }

    /**
     * @param string $amountFrom
     * @return $this
     */
    public function setAmountFrom($amountFrom)
    {
        $this->amountFrom = $amountFrom;
        return $this;
    }

    /**
     * @return string
     */
    public function getAmountTo()
    {
        return $this->amountTo;
    }

    /**
     * @param string $amountTo
     * @return $this
     */
    public function setAmountTo($amountTo)
    {
        $this->amountTo = $amountTo;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @param string $scope
     * @return $this
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
        return $this;
    }

}