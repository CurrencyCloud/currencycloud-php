<?php

namespace CurrencyCloud\Model;

class BankDetails
{

    /**
     * @var string
     */
    private $identifierValue;
    /**
     * @var string
     */
    private $identifierType;
    /**
     * @var string
     */
    private $accountNumber;
    /**
     * @var string
     */
    private $bicSwift;
    /**
     * @var string
     */
    private $bankName;
    /**
     * @var string
     */
    private $bankBranch;
    /**
     * @var string
    */
    private $bankAddress;
    /**
     * @var string
     */
    private $bankCity;
    /**
     * @var string
     */
    private $bankState;
    /**
     * @var string
     */
    private $bankPostCode;
    /**
     * @var string
     */
    private $bankCountry;
    /**
     * @var string
     */
    private $bankCountryISO;
    /**
     * @var string
     */
    private $currency;

    /**
     * @param string $identifierValue
     * @param string $identifierType
     * @param string $accountNumber
     * @param string $bicSwift
     * @param string $bankName
     * @param string $bankBranch
     * @param string $bankAddress
     * @param string $bankCity
     * @param string $bankState
     * @param string $bankPostCode
     * @param string $bankCountry
     * @param string $bankCountryISO
     * @param string $currency
     */
    public function __construct($identifierValue, $identifierType, $accountNumber, $bicSwift, $bankName, $bankBranch,
                                $bankAddress, $bankCity, $bankState, $bankPostCode, $bankCountry, $bankCountryISO, $currency)
    {
        $this->identifierValue = (string)$identifierValue;
        $this->identifierType = (string)$identifierType;
        $this->accountNumber = (string)$accountNumber;
        $this->bicSwift = (string)$bicSwift;
        $this->bankName = (string)$bankName;
        $this->bankBranch = (string)$bankBranch;
        $this->bankAddress = (string)$bankAddress;
        $this->bankCity = (string)$bankCity;
        $this->bankState = (string)$bankState;
        $this->bankPostCode = (string)$bankPostCode;
        $this->bankCountry = (string)$bankCountry;
        $this->bankCountryISO = (string)$bankCountryISO;
        $this->currency = (string)$currency;
    }

    /**
     * @return string
     */
    public function getIdentifierValue()
    {
        return $this->identifierValue;
    }

    /**
     * @return string
     */
    public function getIdentifierType()
    {
        return $this->identifierType;
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
    public function getBicSwift()
    {
        return $this->bicSwift;
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
    public function getBankBranch()
    {
        return $this->bankBranch;
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
    public function getBankCity()
    {
        return $this->bankCity;
    }

    /**
     * @return string
     */
    public function getBankState()
    {
        return $this->bankState;
    }

    /**
     * @return string
     */
    public function getBankPostCode()
    {
        return $this->bankPostCode;
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
    public function getBankCountryISO()
    {
        return $this->bankCountryISO;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }


}
