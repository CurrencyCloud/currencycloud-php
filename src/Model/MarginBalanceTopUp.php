<?php

namespace CurrencyCloud\Model;

use DateTime;

class MarginBalanceTopUp
{

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
    private $transferredAmount;
    /**
     * @var DateTime
     */
    private $transferCompletedAt;

    /**
     * @param string $accountId
     * @param string $currency
     * @param string $transferredAmount
     * @param DateTime $transferCompletedAt
     */
    public function __construct(
        $accountId,
        $currency,
        $transferredAmount,
        DateTime $transferCompletedAt
    ) {
        $this->accountId = (string) $accountId;
        $this->currency = (string) $currency;
        $this->transferredAmount = (string) $transferredAmount;
        $this->transferCompletedAt = $transferCompletedAt;
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
    public function getTransferredAmount()
    {
        return $this->transferredAmount;
    }

    /**
     * @return DateTime
     */
    public function getTransferCompletedAt()
    {
        return $this->transferCompletedAt;
    }
}
