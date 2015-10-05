<?php

namespace CurrencyCloud\Model;

class SettlementAccount
{

    /**
     * @var string
     */
    private $bankAccountHolderName;
    /**
     * @var array
     */
    private $beneficiaryAddress;
    /**
     * @var string
     */
    private $beneficiaryCountry;
    /**
     * @var string
     */
    private $bankName;
    /**
     * @var array
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
    private $bicSwift;
    /**
     * @var string
     */
    private $iban;
    /**
     * @var string
     */
    private $accountNumber;
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
    private $routingCodeType2;
    /**
     * @var string
     */
    private $routingCodeValue2;

    /**
     * @param string $bankAccountHolderName
     * @param array $beneficiaryAddress
     * @param string $beneficiaryCountry
     * @param string $bankName
     * @param array $bankAddress
     * @param string $bankCountry
     * @param string $currency
     * @param string $bicSwift
     * @param string $iban
     * @param string $accountNumber
     * @param string $routingCodeType1
     * @param string $routingCodeValue1
     * @param string $routingCodeType2
     * @param string $routingCodeValue2
     */
    public function __construct(
        $bankAccountHolderName,
        array $beneficiaryAddress,
        $beneficiaryCountry,
        $bankName,
        array $bankAddress,
        $bankCountry,
        $currency,
        $bicSwift,
        $iban,
        $accountNumber,
        $routingCodeType1,
        $routingCodeValue1,
        $routingCodeType2,
        $routingCodeValue2
    ) {
        $this->bankAccountHolderName = (string) $bankAccountHolderName;
        $this->beneficiaryAddress = $beneficiaryAddress;
        $this->beneficiaryCountry = (string) $beneficiaryCountry;
        $this->bankName = (string) $bankName;
        $this->bankAddress = $bankAddress;
        $this->bankCountry = (string) $bankCountry;
        $this->currency = (string) $currency;
        $this->bicSwift = (string) $bicSwift;
        $this->iban = (string) $iban;
        $this->accountNumber = (string) $accountNumber;
        $this->routingCodeType1 = (string) $routingCodeType1;
        $this->routingCodeValue1 = (string) $routingCodeValue1;
        $this->routingCodeType2 = (string) $routingCodeType2;
        $this->routingCodeValue2 = (string) $routingCodeValue2;
    }

    /**
     * @return string
     */
    public function getBankAccountHolderName()
    {
        return $this->bankAccountHolderName;
    }

    /**
     * @return array
     */
    public function getBeneficiaryAddress()
    {
        return $this->beneficiaryAddress;
    }

    /**
     * @return string
     */
    public function getBeneficiaryCountry()
    {
        return $this->beneficiaryCountry;
    }

    /**
     * @return string
     */
    public function getBankName()
    {
        return $this->bankName;
    }

    /**
     * @return array
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
    public function getBicSwift()
    {
        return $this->bicSwift;
    }

    /**
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
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
    public function getRoutingCodeType1()
    {
        return $this->routingCodeType1;
    }

    /**
     * @return string
     */
    public function getRoutingCodeValue1()
    {
        return $this->routingCodeValue1;
    }

    /**
     * @return string
     */
    public function getRoutingCodeType2()
    {
        return $this->routingCodeType2;
    }

    /**
     * @return string
     */
    public function getRoutingCodeValue2()
    {
        return $this->routingCodeValue2;
    }
}
