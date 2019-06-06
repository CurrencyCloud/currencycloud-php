<?php

namespace CurrencyCloud\Model;

class PaymentDeliveryDate
{

    /**
     * @var DateTime
     */
    private $paymentDate;
    /**
     * @var DateTime
     */
    private $paymentDeliveryDate;
    /**
     * @var DateTime
     */
    private $paymentCutoffTime;
    /**
     * @var string
     */
    private $paymentType;
    /**
     * @var string
     */
    private $currency;
    /**
     * @var string
     */
    private $bankCountry;

    /**
     * @param DateTime $paymentDate
     * @param DateTime $paymentDeliveryDate
     * @param DateTime $paymentCutoffTime
     * @param string $paymentType
     * @param string $currency
     * @param string $canSell
     */
    public function __construct($paymentDate, $paymentDeliveryDate, $paymentCutoffTime, $paymentType, $currency, $bankCountry)
    {
        $this->paymentDate =  $paymentDate;
        $this->paymentDeliveryDate = $paymentDeliveryDate;
        $this->paymentCutoffTime =  $paymentCutoffTime;
        $this->paymentType = (string) $paymentType;
        $this->currency = (string) $currency;
        $this->bankCountry = (string) $bankCountry;
    }

    /**
     * @return DateTime
     */
    public function getPaymentDate()
    {
        return $this->paymentDate;
    }

    /**
     * @return DateTime
     */
    public function getPaymentDeliveryDate()
    {
        return $this->paymentDeliveryDate;
    }

    /**
     * @return DateTime
     */
    public function getPaymentCutoffTime()
    {
        return $this->paymentCutoffTime;
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
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getBankCountry()
    {
        return $this->bankCountry;
    }


}
