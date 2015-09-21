<?php

namespace CurrencyCloud\Model;

class BeneficiaryValidate
{
    /**
     * @var array
     */
    private $paymentTypes;
    /**
     * @var string
     */
    private $bankCountry;
    /**
     * @var string
     */
    private $bankName;
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
    private $iban;
    /**
     * @var array
     */
    private $bankAddress;
    /**
     * @var string
     */
    private $bicSwift;
    /**
     * @var string
     */
    private $bankAccountType;
    /**
     * @var string
     */
    private $beneficiaryCountry;
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
    private $beneficiaryCity;
    /**
     * @var string
     */
    private $beneficiaryPostCode;
    /**
     * @var string
     */
    private $beneficiaryStateOrProvince;
    /**
     * @var string
     */
    private $beneficiaryDateOfBirth;
    /**
     * @var string
     */
    private $beneficiaryIdentificationType;
    /**
     * @var string
     */
    private $beneficiaryIdentificationValue;
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
     * @var array
     */
    private $beneficiaryAddress;

    /**
     * @param array $paymentTypes
     * @param string $bankName
     * @param array $bankAddress
     * @param string $bankCountry
     * @param string $currency
     * @param string $accountNumber
     * @param string $iban
     * @param string $bicSwift
     * @param string $bankAccountType
     * @param array $beneficiaryAddress
     * @param string $beneficiaryCountry
     * @param string $beneficiaryEntityType
     * @param string $beneficiaryCompanyName
     * @param string $beneficiaryFirstName
     * @param string $beneficiaryLastName
     * @param string $beneficiaryCity
     * @param string $beneficiaryPostCode
     * @param string $beneficiaryStateOrProvince
     * @param string $beneficiaryDateOfBirth
     * @param string $beneficiaryIdentificationType
     * @param string $beneficiaryIdentificationValue
     * @param string $routingCodeType1
     * @param string $routingCodeValue1
     * @param string $routingCodeType2
     * @param string $routingCodeValue2
     */
    public function __construct(
        array $paymentTypes,
        $bankName,
        array $bankAddress,
        $bankCountry,
        $currency,
        $accountNumber,
        $iban,
        $bicSwift,
        $bankAccountType,
        array $beneficiaryAddress,
        $beneficiaryCountry,
        $beneficiaryEntityType,
        $beneficiaryCompanyName,
        $beneficiaryFirstName,
        $beneficiaryLastName,
        $beneficiaryCity,
        $beneficiaryPostCode,
        $beneficiaryStateOrProvince,
        $beneficiaryDateOfBirth,
        $beneficiaryIdentificationType,
        $beneficiaryIdentificationValue,
        $routingCodeType1,
        $routingCodeValue1,
        $routingCodeType2,
        $routingCodeValue2
    ) {
        $this->paymentTypes = $paymentTypes;
        $this->bankName = (string) $bankName;
        $this->bankAddress = $bankAddress;
        $this->bankCountry = (string) $bankCountry;
        $this->currency = (string) $currency;
        $this->accountNumber =(string)  $accountNumber;
        $this->iban = (string) $iban;
        $this->bicSwift =(string)  $bicSwift;
        $this->bankAccountType = (string) $bankAccountType;
        $this->beneficiaryCountry = (string) $beneficiaryCountry;
        $this->beneficiaryEntityType = (string) $beneficiaryEntityType;
        $this->beneficiaryCompanyName = (string) $beneficiaryCompanyName;
        $this->beneficiaryFirstName = (string) $beneficiaryFirstName;
        $this->beneficiaryLastName = (string) $beneficiaryLastName;
        $this->beneficiaryCity = (string) $beneficiaryCity;
        $this->beneficiaryPostCode = (string) $beneficiaryPostCode;
        $this->beneficiaryStateOrProvince = (string) $beneficiaryStateOrProvince;
        $this->beneficiaryDateOfBirth = (string) $beneficiaryDateOfBirth;
        $this->beneficiaryIdentificationType = (string) $beneficiaryIdentificationType;
        $this->beneficiaryIdentificationValue = (string) $beneficiaryIdentificationValue;
        $this->routingCodeType1 = (string) $routingCodeType1;
        $this->routingCodeValue1 = (string) $routingCodeValue1;
        $this->routingCodeType2 = (string) $routingCodeType2;
        $this->routingCodeValue2 = (string) $routingCodeValue2;
        $this->beneficiaryAddress = $beneficiaryAddress;
    }

    /**
     * @return array
     */
    public function getPaymentTypes()
    {
        return $this->paymentTypes;
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
    public function getBankName()
    {
        return $this->bankName;
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
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
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
    public function getBicSwift()
    {
        return $this->bicSwift;
    }

    /**
     * @return string
     */
    public function getBankAccountType()
    {
        return $this->bankAccountType;
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
    public function getBeneficiaryEntityType()
    {
        return $this->beneficiaryEntityType;
    }

    /**
     * @return string
     */
    public function getBeneficiaryCompanyName()
    {
        return $this->beneficiaryCompanyName;
    }

    /**
     * @return string
     */
    public function getBeneficiaryFirstName()
    {
        return $this->beneficiaryFirstName;
    }

    /**
     * @return string
     */
    public function getBeneficiaryLastName()
    {
        return $this->beneficiaryLastName;
    }

    /**
     * @return string
     */
    public function getBeneficiaryCity()
    {
        return $this->beneficiaryCity;
    }

    /**
     * @return string
     */
    public function getBeneficiaryPostCode()
    {
        return $this->beneficiaryPostCode;
    }

    /**
     * @return string
     */
    public function getBeneficiaryStateOrProvince()
    {
        return $this->beneficiaryStateOrProvince;
    }

    /**
     * @return string
     */
    public function getBeneficiaryDateOfBirth()
    {
        return $this->beneficiaryDateOfBirth;
    }

    /**
     * @return string
     */
    public function getBeneficiaryIdentificationType()
    {
        return $this->beneficiaryIdentificationType;
    }

    /**
     * @return string
     */
    public function getBeneficiaryIdentificationValue()
    {
        return $this->beneficiaryIdentificationValue;
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

    /**
     * @return array
     */
    public function getBeneficiaryAddress()
    {
        return $this->beneficiaryAddress;
    }
}
