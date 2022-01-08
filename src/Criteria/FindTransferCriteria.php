<?php
namespace CurrencyCloud\Criteria;

use CurrencyCloud\Model\Transfer;
use DateTime;

class FindTransferCriteria {

    /**
     * @var string
     */
    private $shortReference;

    /**
     * @var string
     */
    private $sourceAccountId;

    /**
     * @var string
     */
    private $destinationAccountId;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $amountFrom;

    /**
     * @var string
     */
    private $amountTo;

    /**
     * @var DateTime
     */
    private $createdAtFrom;

    /**
     * @var DateTime
     */
    private $createdAtTo;

    /**
     * @var DateTime
     */
    private $updatedAtFrom;

    /**
     * @var DateTime
     */
    private $updatedAtTo;

    /**
     * @var DateTime
     */
    private $completedAtFrom;

    /**
     * @var DateTime
     */
    private $completedAtTo;

    /**
     * @var string
     */
    private $creatorContactId;

    /**
     * @var string
     */
    private $creatorAccountId;

    /**
     * @var string
     */
    private $uniqueRequestId;

    /**
     * @return string
     */
    public function getOnBehalfOf()
    {
        return $this->onBehalfOf;
    }

    /**
     * @param string $onBehalfOf
     * @return $this
     */
    public function setOnBehalfOf($onBehalfOf)
    {
        $this->onBehalfOf = $onBehalfOf;
        return $this;
    }

    /**
     * @return string
     */
    public function getShortReference()
    {
        return $this->shortReference;
    }

    /**
     * @param string $shortReference
     * @eturn $this
     */
    public function setShortReference($shortReference)
    {
        $this->shortReference = $shortReference;
        return $this;
    }

    /**
     * @return string
     */
    public function getSourceAccountId()
    {
        return $this->sourceAccountId;
    }

    /**
     * @param string $sourceAccountId
     * @return $this
     */
    public function setSourceAccountId($sourceAccountId)
    {
        $this->sourceAccountId = $sourceAccountId;
        return $this;
    }

    /**
     * @return string
     */
    public function getDestinationAccountId()
    {
        return $this->destinationAccountId;
    }

    /**
     * @param string $destinationAccountId
     * @return $this
     */
    public function setDestinationAccountId($destinationAccountId)
    {
        $this->destinationAccountId = $destinationAccountId;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
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
     * @return DateTime
     */
    public function getCreatedAtFrom()
    {
        return $this->createdAtFrom;
    }

    /**
     * @param DateTime $createdAtFrom
     * @return $this
     */
    public function setCreatedAtFrom($createdAtFrom)
    {
        $this->createdAtFrom = $createdAtFrom;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAtTo()
    {
        return $this->createdAtTo;
    }

    /**
     * @param DateTime $createdAtTo
     * @return $this
     */
    public function setCreatedAtTo($createdAtTo)
    {
        $this->createdAtTo = $createdAtTo;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAtFrom()
    {
        return $this->updatedAtFrom;
    }

    /**
     * @param DateTime $updatedAtFrom
     * @return $this
     */
    public function setUpdatedAtFrom($updatedAtFrom)
    {
        $this->updatedAtFrom = $updatedAtFrom;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAtTo()
    {
        return $this->updatedAtTo;
    }

    /**
     * @param DateTime $updatedAtTo
     * @return $this
     */
    public function setUpdatedAtTo($updatedAtTo)
    {
        $this->updatedAtTo = $updatedAtTo;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCompletedAtFrom()
    {
        return $this->completedAtFrom;
    }

    /**
     * @param DateTime $completedAtFrom
     * @return $this
     */
    public function setCompletedAtFrom($completedAtFrom)
    {
        $this->completedAtFrom = $completedAtFrom;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCompletedAtTo()
    {
        return $this->completedAtTo;
    }

    /**
     * @param DateTime $completedAtTo
     * @return $this
     */
    public function setCompletedAtTo($completedAtTo)
    {
        $this->completedAtTo = $completedAtTo;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatorContactId()
    {
        return $this->creatorContactId;
    }

    /**
     * @param string $creatorContactId
     * @return $this
     */
    public function setCreatorContactId($creatorContactId)
    {
        $this->creatorContactId = $creatorContactId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatorAccountId()
    {
        return $this->creatorAccountId;
    }

    /**
     * @param string $creatorAccountId
     * @return $this
     */
    public function setCreatorAccountId($creatorAccountId)
    {
        $this->creatorAccountId = $creatorAccountId;
        return $this;
    }

    /**
     * @return string
     */
    public function getUniqueRequestId()
    {
        return $this->uniqueRequestId;
    }

    /**
     * @param string $uniqueRequestId
     * @return $this
     */
    public function setUniqueRequestId($uniqueRequestId)
    {
        $this->uniqueRequestId = $uniqueRequestId;
        return $this;
    }

}