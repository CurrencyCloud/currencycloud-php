<?php

namespace CurrencyCloud\Model;

use DateTime;

class Transaction
{
    /**
     * @var null|string
     */
    private $balanceId;
    /**
     * @var null|string
     */
    private $accountId;
    /**
     * @var null|string
     */
    private $currency;
    /**
     * @var null|string
     */
    private $amount;
    /**
     * @var null|string
     */
    private $balanceAmount;
    /**
     * @var null|string
     */
    private $type;
    /**
     * @var null|string
     */
    private $action;
    /**
     * @var null|string
     */
    private $relatedEntityType;
    /**
     * @var null|string
     */
    private $relatedEntityId;
    /**
     * @var null|string
     */
    private $relatedEntityShortReference;
    /**
     * @var null|string
     */
    private $status;
    /**
     * @var null|string
     */
    private $reason;
    /**
     * @var DateTime|null
     */
    private $settlesAt;
    /**
     * @var DateTime|null
     */
    private $createdAt;
    /**
     * @var DateTime|null
     */
    private $updatedAt;

    /**
     * @param null|string $balanceId
     * @param null|string $accountId
     * @param null|string $currency
     * @param null|string $amount
     * @param null|string $balanceAmount
     * @param null|string $type
     * @param null|string $action
     * @param null|string $relatedEntityType
     * @param null|string $relatedEntityId
     * @param null|string $relatedEntityShortReference
     * @param null|string $status
     * @param null|string $reason
     * @param string|null $settlesAt
     * @param string|null $createdAt
     * @param string|null $updatedAt
     */
    public function __construct(
        $balanceId = null,
        $accountId = null,
        $currency = null,
        $amount = null,
        $balanceAmount = null,
        $type = null,
        $action = null,
        $relatedEntityType = null,
        $relatedEntityId = null,
        $relatedEntityShortReference = null,
        $status = null,
        $reason = null,
        $settlesAt = null,
        $createdAt = null,
        $updatedAt = null
    ) {

        $this->balanceId = (null === $balanceId) ? null : (string) $balanceId;
        $this->accountId = (null === $accountId) ? null : (string) $accountId;
        $this->currency = (null === $currency) ? null : (string) $currency;
        $this->amount = (null === $amount) ? null : (string) $amount;
        $this->balanceAmount = (null === $balanceAmount) ? null : (string) $balanceAmount;
        $this->type = (null === $type) ? null : (string) $type;
        $this->action = (null === $action) ? null : (string) $action;
        $this->relatedEntityType = (null === $relatedEntityType) ? null : (string) $relatedEntityType;
        $this->relatedEntityId = (null === $relatedEntityId) ? null : (string) $relatedEntityId;
        $this->relatedEntityShortReference = (null === $relatedEntityShortReference) ? null : (string) $relatedEntityShortReference;
        $this->status = (null === $status) ? null : (string) $status;
        $this->reason = (null === $reason) ? null : (string) $reason;
        $this->settlesAt = (null === $settlesAt) ? null : new DateTime((string) $settlesAt);
        $this->createdAt = (null === $createdAt) ? null : new DateTime((string) $createdAt);
        $this->updatedAt = (null === $updatedAt) ? null : new DateTime((string) $updatedAt);
    }

    /**
     * @return Transaction
     */
    public static function create()
    {
        return new Transaction();
    }

    /**
     * @return null|string
     */
    public function getBalanceId()
    {
        return $this->balanceId;
    }

    /**
     * @return null|string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @return null|string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return null|string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return null|string
     */
    public function getBalanceAmount()
    {
        return $this->balanceAmount;
    }

    /**
     * @return null|string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return null|string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return null|string
     */
    public function getRelatedEntityType()
    {
        return $this->relatedEntityType;
    }

    /**
     * @return null|string
     */
    public function getRelatedEntityId()
    {
        return $this->relatedEntityId;
    }

    /**
     * @return null|string
     */
    public function getRelatedEntityShortReference()
    {
        return $this->relatedEntityShortReference;
    }

    /**
     * @return null|string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return null|string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @return DateTime|null
     */
    public function getSettlesAt()
    {
        return $this->settlesAt;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param null|string $balanceId
     */
    public function setBalanceId($balanceId)
    {
        $this->balanceId = (string) $balanceId;
    }

    /**
     * @param null|string $accountId
     */
    public function setAccountId($accountId)
    {
        $this->accountId = (string) $accountId;
    }

    /**
     * @param null|string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = (string) $currency;
    }

    /**
     * @param null|string $amount
     */
    public function setAmount($amount)
    {
        $this->amount = (string) $amount;
    }

    /**
     * @param null|string $balanceAmount
     */
    public function setBalanceAmount($balanceAmount)
    {
        $this->balanceAmount = (string) $balanceAmount;
    }

    /**
     * @param null|string $type
     */
    public function setType($type)
    {
        $this->type = (string) $type;
    }

    /**
     * @param null|string $action
     */
    public function setAction($action)
    {
        $this->action = (string) $action;
    }

    /**
     * @param null|string $relatedEntityType
     */
    public function setRelatedEntityType($relatedEntityType)
    {
        $this->relatedEntityType = (string) $relatedEntityType;
    }

    /**
     * @param null|string $relatedEntityId
     */
    public function setRelatedEntityId($relatedEntityId)
    {
        $this->relatedEntityId = (string) $relatedEntityId;
    }

    /**
     * @param null|string $relatedEntityShortReference
     */
    public function setRelatedEntityShortReference($relatedEntityShortReference)
    {
        $this->relatedEntityShortReference = (string) $relatedEntityShortReference;
    }

    /**
     * @param null|string $status
     */
    public function setStatus($status)
    {
        $this->status = (string) $status;
    }

    /**
     * @param null|string $reason
     */
    public function setReason($reason)
    {
        $this->reason = (string) $reason;
    }

    /**
     * @param DateTime|null $settlesAt
     */
    public function setSettlesAt(DateTime $settlesAt = null)
    {
        $this->settlesAt = $settlesAt;
    }

    /**
     * @param DateTime|null $createdAt
     */
    public function setCreatedAt(DateTime $createdAt = null)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @param DateTime|null $updatedAt
     */
    public function setUpdatedAt(DateTime $updatedAt = null)
    {
        $this->updatedAt = $updatedAt;
    }
}
