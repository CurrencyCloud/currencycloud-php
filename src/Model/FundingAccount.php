<?php

namespace CurrencyCloud\Model;

use DateTime;

class FundingAccount implements EntityInterface
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
    private $accountNumber;
    /**
     * @var string
     */
    private $accountNumberType;
    /**
     * @var string
     */
    private $accountHolderName;
    /**
     * @var string
     */
    private $bankName;
    /**
     * @var string
     */
    private $bankAddress;
    /**
     * @var string
     */
    private $bankCountry;
    /**
     * @var string
     */
    private $currency;
    /**
     * @var string
     */
    private $paymentType;
    /**
     * @var string`
     */
    private $routingCode;
    /**
     * @var string
     */
    private $routingCodeType;
    /**
     * @var DateTime
     */
    private $createdAt;
    /**
     * @var DateTime
     */
    private $updatedAt;

    /**
     * FundingAccount constructor.
     * @param string $id
     * @param string $accountId
     * @param string $accountNumber
     * @param string $accountNumberType
     * @param string $accountHolderName
     * @param string $bankName
     * @param string $bankAddress
     * @param string $bankCountry
     * @param string $currency
     * @param string $paymentType
     * @param string $routingCode
     * @param string $routingCodeType
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     */
    public function __construct($id, $accountId, $accountNumber, $accountNumberType, $accountHolderName, $bankName,
                                $bankAddress, $bankCountry, $currency, $paymentType, $routingCode,
                                $routingCodeType, $createdAt,$updatedAt)
    {
        $this->id = $id;
        $this->accountId = $accountId;
        $this->accountNumber = $accountNumber;
        $this->accountNumberType = $accountNumberType;
        $this->accountHolderName = $accountHolderName;
        $this->bankName = $bankName;
        $this->bankAddress = $bankAddress;
        $this->bankCountry = $bankCountry;
        $this->currency = $currency;
        $this->paymentType = $paymentType;
        $this->routingCode = $routingCode;
        $this->routingCodeType = $routingCodeType;
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
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * @return string
     */
    public function getAccountNumberType()
    {
        return $this->accountNumberType;
    }

    /**
     * @return string
     */
    public function getAccountHolderName()
    {
        return $this->accountHolderName;
    }

    /**
     * @return string
     */
    public function getBankName()
    {
        return $this->bankName;
    }

    /**
     * @return string
     */
    public function getBankAddress()
    {
        return $this->bankAddress;
    }

    /**
     * @return string
     */
    public function getBankCountry()
    {
        return $this->bankCountry;
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
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * @return string
     */
    public function getRoutingCode()
    {
        return $this->routingCode;
    }

    /**
     * @return string
     */
    public function getRoutingCodeType()
    {
        return $this->routingCodeType;
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
