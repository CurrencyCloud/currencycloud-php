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
    private $regularRoutingCode;
    /**
     * @var string
     */
    private $regularRoutingCodeType;
    /**
     * @var string`
     */
    private $priorityRoutingCode;
    /**
     * @var string
     */
    private $priorityRoutingCodeType;
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
     * @param string $regularRoutingCode
     * @param string $regularRoutingCodeType
     * @param string $priorityRoutingCode
     * @param string $priorityRoutingCodeType
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     */
    public function __construct($id, $accountId, $accountNumber, $accountNumberType, $accountHolderName, $bankName,
                                $bankAddress, $bankCountry, $currency, $paymentType, $regularRoutingCode,
                                $regularRoutingCodeType, $priorityRoutingCode, $priorityRoutingCodeType, $createdAt,
                                $updatedAt)
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
        $this->regularRoutingCode = $regularRoutingCode;
        $this->regularRoutingCodeType = $regularRoutingCodeType;
        $this->priorityRoutingCode = $priorityRoutingCode;
        $this->priorityRoutingCodeType = $priorityRoutingCodeType;
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
    public function getRegularRoutingCode()
    {
        return $this->regularRoutingCode;
    }

    /**
     * @return string
     */
    public function getRegularRoutingCodeType()
    {
        return $this->regularRoutingCodeType;
    }

    /**
     * @return string
     */
    public function getPriorityRoutingCode()
    {
        return $this->priorityRoutingCode;
    }

    /**
     * @return string
     */
    public function getPriorityRoutingCodeType()
    {
        return $this->priorityRoutingCodeType;
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
