<?php

namespace CurrencyCloud\Model;

use DateTime;

class Balance
{

    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $accountId;
    /**
     * @var string
     */
    private $currency;
    /**
     * @var string
     */
    private $amount;
    /**
     * @var DateTime
     */
    private $createdAt;
    /**
     * @var DateTime
     */
    private $updatedAt;

    /**
     * @param string $accountId
     * @param string $currency
     * @param string $amount
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     */
    public function __construct(
        $accountId,
        $currency,
        $amount,
        DateTime $createdAt,
        DateTime $updatedAt
    ) {
        $this->accountId = (string) $accountId;
        $this->currency = (string) $currency;
        $this->amount = (string) $amount;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
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
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
