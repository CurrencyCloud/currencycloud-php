<?php

namespace CurrencyCloud\Model;

class QuotePaymentFee
{

    /**
     * @var string
     */
    private $paymentType;
    /**
     * @var null|string
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
     * @var string
     */
    private $accountId;
    /**
     * @var string
     */
    private $paymentCurrency;
    /**
     * @var string
     */
    private $paymentDestinationCountry;


    /**
     * @param string $accountId
     * @param string $paymentCurrency
     * @param string $paymentDestinationCountry
     * @param string $paymentType
     * @param null|string $chargeType
     * @param string $feeAmount
     * @param string $feeCurrency
     */
    public function __construct($accountId, $paymentCurrency, $paymentDestinationCountry, $paymentType, $chargeType, $feeAmount, $feeCurrency)
    {
        $this->accountId = (string)$accountId;
        $this->paymentCurrency = (string)$paymentCurrency;
        $this->paymentDestinationCountry = (string)$paymentDestinationCountry;
        $this->paymentType = (string)$paymentType;
        $this->chargeType = $chargeType;
        $this->feeAmount = (string)$feeAmount;
        $this->feeCurrency = (string)$feeCurrency;
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
    public function getPaymentCurrency()
    {
        return $this->paymentCurrency;
    }

    /**
     * @return string
     */
    public function getPaymentDestinationCurrency()
    {
        return $this->paymentDestinationCountry;
    }

    /**
     * @return string
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * @return null|string
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
