<?php

namespace CurrencyCloud\Model;

class CollectionsScreeningResponse
{
    /**
     * @var string
     */
    private $transactionId;
    /**
     * @var string
     */
    private $accountId;
    /**
     * @var string
     */
    private $houseAccountId;
    /**
     * @var CollectionsScreeningResult
     */
    private $result;

    /**
     * @param string $transactionId
     * @param string $accountId
     * @param string $houseAccountId
     * @param CollectionsScreeningResult $result
     */
    public function __construct($transactionId, $accountId, $houseAccountId, CollectionsScreeningResult $result)
    {
        $this->transactionId = $transactionId;
        $this->accountId = $accountId;
        $this->houseAccountId = $houseAccountId;
        $this->result = $result;
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
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
    public function getHouseAccountId()
    {
        return $this->houseAccountId;
    }

    /**
     * @return CollectionsScreeningResult
     */
    public function getResult()
    {
        return $this->result;
    }
}
