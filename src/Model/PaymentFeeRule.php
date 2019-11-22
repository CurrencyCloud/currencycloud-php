<?php

namespace CurrencyCloud\Model;

class PaymentFeeRule
{


    /**
     * @var string
     */
    private $paymentType;
    /**
     * @var string
     */
    private $chargeType;
    /**
     * @var string
     */
    private $feeAmount;
    /**
     * @var string
     */
    private $feeCurrency;


    /**
     * @param string $paymentType
     * @param string $chargeType
     * @param string $feeAmount
     * @param string $feeCurrency
     */
    public function __construct($paymentType, $chargeType, $feeAmount, $feeCurrency)
    {
        $this->paymentType = (string)$paymentType;
        $this->chargeType = (string)$chargeType;
        $this->feeAmount = (string)$feeAmount;
        $this->feeCurrency = (string)$feeCurrency;
    }

    /**
     * @return string
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * @return string
     */
    public function getChargeType()
    {
        return $this->chargeType;
    }

    /**
     * @return string
     */
    public function getFeeAmount()
    {
        return $this->feeAmount;
    }

    /**
     * @return string
     */
    public function getFeeCurrency()
    {
        return $this->feeCurrency;
    }
}
