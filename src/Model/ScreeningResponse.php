<?php

namespace CurrencyCloud\Model;

class ScreeningResponse
{

    /**
     * @var Uuid
     */
    private $transactionId;

    /**
     * @var Uuid
     */
    private $accountId;

    /**
     * @var Uuid
     */
    private $houseAccountId;

    /**
     * @var result
     */
    private $result;

    /**
     * @param Uuid $transactionId
     * @param Uuid $accountId
     * @param Uuid $houseAccountId
     * @param Result $result
     */
    public function __construct($transactionId, $accountId, $houseAccountId, $result)
    {
        $this->transactionId = $transactionId;
        $this->accountId = $accountId;
        $this->houseAccountId = $houseAccountId;
        $this->result = $result;
    }

    /**
     * @return Uuid
     */
    public function getHouseAccountId()
    {
        return $this->houseAccountId;
    }

    /**
     * @return Uuid
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @return Uuid
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @return Result
     */
    public function getResult()
    {
        return $this->result;
    }

}