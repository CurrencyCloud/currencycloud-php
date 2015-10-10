<?php

namespace CurrencyCloud\Model;

class SettlementEntry
{

    /**
     * @var string
     */
    private $sendAmount;
    /**
     * @var string
     */
    private $receiveAmount;

    /**
     * @param string $sendAmount
     * @param string $receiveAmount
     */
    public function __construct($sendAmount, $receiveAmount)
    {
        $this->sendAmount = $sendAmount;
        $this->receiveAmount = $receiveAmount;
    }

    /**
     * @return string
     */
    public function getSendAmount()
    {
        return $this->sendAmount;
    }

    /**
     * @return string
     */
    public function getReceiveAmount()
    {
        return $this->receiveAmount;
    }
}
