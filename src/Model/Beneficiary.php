<?php

namespace CurrencyCloud\Model;

use DateTime;

class Beneficiary
{
    /**
     * @var string
     */
    private $id;
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
     * @var DateTime
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
     * @var string
     */
    private $bankAccountHolderName;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $email;

    /**
     * @param $bankAccountHolderName
     * @param $bankCountry
     * @param $currency
     * @param $name
     * @param null|string $email
     * @param array|null $beneficiaryAddress
     * @param null|string $bankCountry
     * @param null|string $beneficiaryCountry
     * @param null|string $accountNumber
     * @param null|string $routingCodeType1
     * @param null|string $routingCodeValue1
     * @param null|string $routingCodeType2
     * @param null|string $routingCodeValue2
     * @param null|string $bicSwift
     * @param null|string $iban
     * @param null|string $defaultBeneficiary
     * @param array|null $bankAddress
     * @param null|string $bankName
     * @param null|string $bankAccountType
     * @param null|string $beneficiaryEntityType
     * @param null|string $beneficiaryCompanyName
     * @param null|string $beneficiaryFirstName
     * @param null|string $beneficiaryLastName
     * @param null|string $beneficiaryCity
     * @param null|string $beneficiaryPostCode
     * @param null|string $beneficiaryStateOrProvince
     * @param null|DateTime $beneficiaryDateOfBirth
     * @param null|string $beneficiaryIdentificationType
     * @param null|string $beneficiaryIdentificationValue
     * @param array|null $paymentTypes
     */
    public function __construct(
        $bankAccountHolderName,
        $bankCountry,
        $currency,
        $name,
        $email = null,
        array $beneficiaryAddress = null,
        $bankCountry = null,
        $beneficiaryCountry = null,
        $accountNumber = null,
        $routingCodeType1 = null,
        $routingCodeValue1 = null,
        $routingCodeType2 = null,
        $routingCodeValue2 = null,
        $bicSwift = null,
        $iban = null,
        $defaultBeneficiary = null,
        array $bankAddress = null,
        $bankName = null,
        $bankAccountType = null,
        $beneficiaryEntityType = null,
        $beneficiaryCompanyName = null,
        $beneficiaryFirstName = null,
        $beneficiaryLastName = null,
        $beneficiaryCity = null,
        $beneficiaryPostCode = null,
        $beneficiaryStateOrProvince = null,
        DateTime $beneficiaryDateOfBirth = null,
        $beneficiaryIdentificationType = null,
        $beneficiaryIdentificationValue = null,
        array $paymentTypes = null
    ) {
        $this->bankAccountHolderName = (null === $bankAccountHolderName) ? null : (string) $bankAccountHolderName;
        $this->bankCountry = (null === $bankCountry) ? null : (string) $bankCountry;
        $this->currency = (null === $currency) ? null : (string) $currency;
        $this->name = (null === $name) ? null : (string) $name;

        $this->email = (null === $email) ? null : (string) $email;
        $this->beneficiaryAddress = (null === $beneficiaryAddress) ? null : $beneficiaryAddress;
        $this->paymentTypes = (null === $paymentTypes) ? null : (string) $paymentTypes;
        $this->bankName = (null === $bankName) ? null : (string) $bankName;
        $this->bankAddress = (null === $bankAddress) ? null : $bankAddress;
        $this->accountNumber =(string)  $accountNumber;
        $this->iban = (null === $iban) ? null : (string) $iban;
        $this->bicSwift =(string)  $bicSwift;
        $this->bankAccountType = (null === $bankAccountType) ? null : (string) $bankAccountType;
        $this->beneficiaryCountry = (null === $beneficiaryCountry) ? null : (string) $beneficiaryCountry;
        $this->beneficiaryEntityType = (null === $beneficiaryEntityType) ? null : (string) $beneficiaryEntityType;
        $this->beneficiaryCompanyName = (null === $beneficiaryCompanyName) ? null : (string) $beneficiaryCompanyName;
        $this->beneficiaryFirstName = (null === $beneficiaryFirstName) ? null : (string) $beneficiaryFirstName;
        $this->beneficiaryLastName = (null === $beneficiaryLastName) ? null : (string) $beneficiaryLastName;
        $this->beneficiaryCity = (null === $beneficiaryCity) ? null : (string) $beneficiaryCity;
        $this->beneficiaryPostCode = (null === $beneficiaryPostCode) ? null : (string) $beneficiaryPostCode;
        $this->beneficiaryStateOrProvince = (null === $beneficiaryStateOrProvince) ?
            null : (string) $beneficiaryStateOrProvince;
        $this->beneficiaryDateOfBirth = (null === $beneficiaryDateOfBirth) ?
            null : new DateTime((string) $beneficiaryDateOfBirth);
        $this->beneficiaryIdentificationType = (null === $beneficiaryIdentificationType) ?
            null : (string) $beneficiaryIdentificationType;
        $this->beneficiaryIdentificationValue = (null === $beneficiaryIdentificationValue) ?
            null : (string) $beneficiaryIdentificationValue;
        $this->routingCodeType1 = (null === $routingCodeType1) ? null : (string) $routingCodeType1;
        $this->routingCodeValue1 = (null === $routingCodeValue1) ? null : (string) $routingCodeValue1;
        $this->routingCodeType2 = (null === $routingCodeType2) ? null : (string) $routingCodeType2;
        $this->routingCodeValue2 = (null === $routingCodeValue2) ? null : (string) $routingCodeValue2;
    }

    /**
     * Since PHP can not have two distinct constructors, this is easy to implement variant using static method
     * @param string $bankCountry
     * @param string $currency
     * @param string $beneficiaryCountry
     * @return Beneficiary
     */
    public static function createForValidate($bankCountry, $currency, $beneficiaryCountry)
    {
        return new Beneficiary(null, $bankCountry, $currency, null, null, null, null, $beneficiaryCountry);
    }

    /**
     * @return Beneficiary
     */
    public static function create()
    {
        return new Beneficiary(null, null, null, null);
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
     * @return DateTime
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

    /**
     * @param array $paymentTypes
     */
    public function setPaymentTypes(array $paymentTypes)
    {
        $this->paymentTypes = $paymentTypes;
    }

    /**
     * @param string $bankCountry
     */
    public function setBankCountry($bankCountry)
    {
        $this->bankCountry = (string) $bankCountry;
    }

    /**
     * @param string $bankName
     */
    public function setBankName($bankName)
    {
        $this->bankName = (string) $bankName;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = (string) $currency;
    }

    /**
     * @param string $accountNumber
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = (string) $accountNumber;
    }

    /**
     * @param string $iban
     */
    public function setIban($iban)
    {
        $this->iban = (string) $iban;
    }

    /**
     * @param array $bankAddress
     */
    public function setBankAddress(array $bankAddress)
    {
        $this->bankAddress = $bankAddress;
    }

    /**
     * @param string $bicSwift
     */
    public function setBicSwift($bicSwift)
    {
        $this->bicSwift = (string) $bicSwift;
    }

    /**
     * @param string $bankAccountType
     */
    public function setBankAccountType($bankAccountType)
    {
        $this->bankAccountType = (string) $bankAccountType;
    }

    /**
     * @param string $beneficiaryCountry
     */
    public function setBeneficiaryCountry($beneficiaryCountry)
    {
        $this->beneficiaryCountry = (string) $beneficiaryCountry;
    }

    /**
     * @param string $beneficiaryEntityType
     */
    public function setBeneficiaryEntityType($beneficiaryEntityType)
    {
        $this->beneficiaryEntityType = (string) $beneficiaryEntityType;
    }

    /**
     * @param string $beneficiaryCompanyName
     */
    public function setBeneficiaryCompanyName($beneficiaryCompanyName)
    {
        $this->beneficiaryCompanyName = (string) $beneficiaryCompanyName;
    }

    /**
     * @param string $beneficiaryFirstName
     */
    public function setBeneficiaryFirstName($beneficiaryFirstName)
    {
        $this->beneficiaryFirstName = (string) $beneficiaryFirstName;
    }

    /**
     * @param string $beneficiaryLastName
     */
    public function setBeneficiaryLastName($beneficiaryLastName)
    {
        $this->beneficiaryLastName = (string) $beneficiaryLastName;
    }

    /**
     * @param string $beneficiaryCity
     */
    public function setBeneficiaryCity($beneficiaryCity)
    {
        $this->beneficiaryCity = (string) $beneficiaryCity;
    }

    /**
     * @param string $beneficiaryPostCode
     */
    public function setBeneficiaryPostCode($beneficiaryPostCode)
    {
        $this->beneficiaryPostCode = (string) $beneficiaryPostCode;
    }

    /**
     * @param string $beneficiaryStateOrProvince
     */
    public function setBeneficiaryStateOrProvince($beneficiaryStateOrProvince)
    {
        $this->beneficiaryStateOrProvince = (string) $beneficiaryStateOrProvince;
    }

    /**
     * @param DateTime $beneficiaryDateOfBirth
     */
    public function setBeneficiaryDateOfBirth(DateTime $beneficiaryDateOfBirth)
    {
        $this->beneficiaryDateOfBirth = $beneficiaryDateOfBirth;
    }

    /**
     * @param string $beneficiaryIdentificationType
     */
    public function setBeneficiaryIdentificationType($beneficiaryIdentificationType)
    {
        $this->beneficiaryIdentificationType = (string) $beneficiaryIdentificationType;
    }

    /**
     * @param string $beneficiaryIdentificationValue
     */
    public function setBeneficiaryIdentificationValue($beneficiaryIdentificationValue)
    {
        $this->beneficiaryIdentificationValue = (string) $beneficiaryIdentificationValue;
    }

    /**
     * @param string $routingCodeType1
     */
    public function setRoutingCodeType1($routingCodeType1)
    {
        $this->routingCodeType1 = (string) $routingCodeType1;
    }

    /**
     * @param string $routingCodeValue1
     */
    public function setRoutingCodeValue1($routingCodeValue1)
    {
        $this->routingCodeValue1 = (string) $routingCodeValue1;
    }

    /**
     * @param string $routingCodeType2
     */
    public function setRoutingCodeType2($routingCodeType2)
    {
        $this->routingCodeType2 = (string) $routingCodeType2;
    }

    /**
     * @param string $routingCodeValue2
     */
    public function setRoutingCodeValue2($routingCodeValue2)
    {
        $this->routingCodeValue2 = (string) $routingCodeValue2;
    }

    /**
     * @param array $beneficiaryAddress
     */
    public function setBeneficiaryAddress($beneficiaryAddress)
    {
        $this->beneficiaryAddress = (string) $beneficiaryAddress;
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
    public function getBankAccountHolderName()
    {
        return $this->bankAccountHolderName;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $bankAccountHolderName
     */
    public function setBankAccountHolderName($bankAccountHolderName)
    {
        $this->bankAccountHolderName = (string) $bankAccountHolderName;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = (string) $name;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = (string) $email;
    }
}
