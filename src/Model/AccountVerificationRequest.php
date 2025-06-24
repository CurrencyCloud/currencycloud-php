<?php

namespace CurrencyCloud\Model;

class AccountVerificationRequest
{
    /**
     * @var array
     */
    private $paymentType;
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
    private $accountNumber;
    /**
     * @var string
     */
    private $beneficiaryEntityType;
    /**
     * @var string
     */
    private $beneficiaryCompanyName;
    /**
     * @var string
     */
    private $beneficiaryFirstName;
    /**
     * @var string
     */
    private $beneficiaryLastName;
    /**
     * @var string
     */
    private $routingCodeType1;
    /**
     * @var string
     */
    private $routingCodeValue1;
    /**
     * @var string
     */
    private $secondaryReferenceData;


    public function __construct($paymentType = null, $bankCountry = null, $currency = null, $accountNumber = null, $beneficiaryEntityType = null, $beneficiaryCompanyName = null, $beneficiaryFirstName = null, $beneficiaryLastName = null, $routingCodeType1 = null, $routingCodeValue1 = null, $secondaryReferenceData = null)
    {
        $this->paymentType = $paymentType;
        $this->bankCountry = $bankCountry;
        $this->currency = $currency;
        $this->accountNumber = $accountNumber;
        $this->beneficiaryEntityType = $beneficiaryEntityType;
        $this->beneficiaryCompanyName = $beneficiaryCompanyName;
        $this->beneficiaryFirstName = $beneficiaryFirstName;
        $this->beneficiaryLastName = $beneficiaryLastName;
        $this->routingCodeType1 = $routingCodeType1;
        $this->routingCodeValue1 = $routingCodeValue1;
        $this->secondaryReferenceData = $secondaryReferenceData;
    }

    /**
     * @return array
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * @param array $paymentTypes
     *
     * @return $this
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;
        return $this;
    }

    /**
     * @return string
     */
    public function getBankCountry()
    {
        return $this->bankCountry;
    }

    /**
     * @param string $bankCountry
     *
     * @return $this
     */
    public function setBankCountry($bankCountry)
    {
        $this->bankCountry = (string) $bankCountry;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = (string) $currency;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * @param string $accountNumber
     *
     * @return $this
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = (string) $accountNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getBeneficiaryEntityType()
    {
        return $this->beneficiaryEntityType;
    }

    /**
     * @param string $beneficiaryEntityType
     *
     * @return $this
     */
    public function setBeneficiaryEntityType($beneficiaryEntityType)
    {
        $this->beneficiaryEntityType = (string) $beneficiaryEntityType;
        return $this;
    }

    /**
     * @return string
     */
    public function getBeneficiaryCompanyName()
    {
        return $this->beneficiaryCompanyName;
    }

    /**
     * @param string $beneficiaryCompanyName
     *
     * @return $this
     */
    public function setBeneficiaryCompanyName($beneficiaryCompanyName)
    {
        $this->beneficiaryCompanyName = (string) $beneficiaryCompanyName;
        return $this;
    }

    /**
     * @return string
     */
    public function getBeneficiaryFirstName()
    {
        return $this->beneficiaryFirstName;
    }

    /**
     * @param string $beneficiaryFirstName
     *
     * @return $this
     */
    public function setBeneficiaryFirstName($beneficiaryFirstName)
    {
        $this->beneficiaryFirstName = (string) $beneficiaryFirstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getBeneficiaryLastName()
    {
        return $this->beneficiaryLastName;
    }

    /**
     * @param string $beneficiaryLastName
     *
     * @return $this
     */
    public function setBeneficiaryLastName($beneficiaryLastName)
    {
        $this->beneficiaryLastName = (string) $beneficiaryLastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getRoutingCodeType1()
    {
        return $this->routingCodeType1;
    }

    /**
     * @param string $routingCodeType1
     *
     * @return $this
     */
    public function setRoutingCodeType1($routingCodeType1)
    {
        $this->routingCodeType1 = (string) $routingCodeType1;
        return $this;
    }

    /**
     * @return string
     */
    public function getRoutingCodeValue1()
    {
        return $this->routingCodeValue1;
    }

    /**
     * @param string $routingCodeValue1
     *
     * @return $this
     */
    public function setRoutingCodeValue1($routingCodeValue1)
    {
        $this->routingCodeValue1 = (string) $routingCodeValue1;
        return $this;
    }

    /**
     * @return string
     */
    public function getSecondaryReferenceData()
    {
        return $this->secondaryReferenceData;
    }

    /**
     * @param string $routingCodeValue1
     *
     * @return $this
     */
    public function setSecondaryReferenceData($secondaryReferenceData)
    {
        $this->secondaryReferenceData = (string) $secondaryReferenceData;
        return $this;
    }
}
