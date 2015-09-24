<?php

namespace CurrencyCloud\Model;

use DateTime;

class Balance implements EntityInterface
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
     * @param string $createdAt
     * @param string $updatedAt
     */
    public function __construct(
        $accountId,
        $currency,
        $amount,
        $createdAt,
        $updatedAt
    ) {
        $this->accountId = (string) $accountId;
        $this->currency = (string) $currency;
        $this->amount = (string) $amount;
        $this->createdAt = new DateTime((string) $createdAt);
        $this->updatedAt = new DateTime((string) $updatedAt);
    }

    /**
     * @param $response
     * @return Balance
     */
    public static function createFromResponse($response)
    {
        $balance = new Balance(
            $response->account_id,
            $response->currency,
            $response->amount,
            $response->created_at,
            $response->updated_at
        );
        $balance->id = (string) $response->id;
        return $balance;
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
