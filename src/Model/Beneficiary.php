<?php

namespace CurrencyCloud\Model;

use DateTime;

class Beneficiary implements EntityInterface
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
    private $creatorContactId;
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
    private $beneficiaryExternalReference;
    /**
     * @var boolean
     */
    private $isDefaultBeneficiary;
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
     * @var string
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
     * @var DateTime
     */
    private $createdAt;
    /**
     * @var DateTime
     */
    private $updatedAt;

    /**
     * Since PHP can not have two distinct constructors, this is easy to implement variant using static method
     *
     * @param string $bankCountry
     * @param string $currency
     * @param string $beneficiaryCountry
     *
     * @return Beneficiary
     */
    public static function createForValidate($bankCountry, $currency, $beneficiaryCountry)
    {
        return (new Beneficiary())->setBankCountry($bankCountry)
            ->setCurrency($currency)
            ->setBeneficiaryCountry($beneficiaryCountry);
    }

    /**
     * @param $bankAccountHolderName
     * @param $bankCountry
     * @param $currency
     * @param $name
     *
     * @return Beneficiary
     */
    public static function create($bankAccountHolderName, $bankCountry, $currency, $name)
    {
        return (new Beneficiary())->setBankAccountHolderName($bankAccountHolderName)
            ->setBankCountry($bankCountry)
            ->setCurrency($currency)
            ->setName($name);
    }

    /**
     * @return array
     */
    public function getPaymentTypes()
    {
        return $this->paymentTypes;
    }

    /**
     * @param array $paymentTypes
     *
     * @return $this
     */
    public function setPaymentTypes(array $paymentTypes)
    {
        $this->paymentTypes = $paymentTypes;
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
    public function getBankName()
    {
        return $this->bankName;
    }

    /**
     * @param string $bankName
     *
     * @return $this
     */
    public function setBankName($bankName)
    {
        $this->bankName = (string) $bankName;
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
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * @param string $iban
     *
     * @return $this
     */
    public function setIban($iban)
    {
        $this->iban = (string) $iban;
        return $this;
    }

    /**
     * @return array
     */
    public function getBankAddress()
    {
        return $this->bankAddress;
    }

    /**
     * @param array $bankAddress
     *
     * @return $this
     */
    public function setBankAddress(array $bankAddress = null)
    {
        $this->bankAddress = $bankAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getBicSwift()
    {
        return $this->bicSwift;
    }

    /**
     * @param string $bicSwift
     *
     * @return $this
     */
    public function setBicSwift($bicSwift)
    {
        $this->bicSwift = (string) $bicSwift;
        return $this;
    }

    /**
     * @return string
     */
    public function getBankAccountType()
    {
        return $this->bankAccountType;
    }

    /**
     * @param string $bankAccountType
     *
     * @return $this
     */
    public function setBankAccountType($bankAccountType)
    {
        $this->bankAccountType = (string) $bankAccountType;
        return $this;
    }

    /**
     * @return string
     */
    public function getBeneficiaryCountry()
    {
        return $this->beneficiaryCountry;
    }

    /**
     * @param string $beneficiaryCountry
     *
     * @return $this
     */
    public function setBeneficiaryCountry($beneficiaryCountry)
    {
        $this->beneficiaryCountry = (string) $beneficiaryCountry;
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
    public function getBeneficiaryCity()
    {
        return $this->beneficiaryCity;
    }

    /**
     * @param string $beneficiaryCity
     *
     * @return $this
     */
    public function setBeneficiaryCity($beneficiaryCity)
    {
        $this->beneficiaryCity = (string) $beneficiaryCity;
        return $this;
    }

    /**
     * @return string
     */
    public function getBeneficiaryPostCode()
    {
        return $this->beneficiaryPostCode;
    }

    /**
     * @param string $beneficiaryPostCode
     *
     * @return $this
     */
    public function setBeneficiaryPostCode($beneficiaryPostCode)
    {
        $this->beneficiaryPostCode = (string) $beneficiaryPostCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getBeneficiaryStateOrProvince()
    {
        return $this->beneficiaryStateOrProvince;
    }

    /**
     * @param string $beneficiaryStateOrProvince
     *
     * @return $this
     */
    public function setBeneficiaryStateOrProvince($beneficiaryStateOrProvince)
    {
        $this->beneficiaryStateOrProvince = (string) $beneficiaryStateOrProvince;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getBeneficiaryDateOfBirth()
    {
        return $this->beneficiaryDateOfBirth;
    }

    /**
     * @param DateTime|null $beneficiaryDateOfBirth
     *
     * @return $this
     */
    public function setBeneficiaryDateOfBirth(DateTime $beneficiaryDateOfBirth = null)
    {
        $this->beneficiaryDateOfBirth = $beneficiaryDateOfBirth;
        return $this;
    }

    /**
     * @return string
     */
    public function getBeneficiaryIdentificationType()
    {
        return $this->beneficiaryIdentificationType;
    }

    /**
     * @param string $beneficiaryIdentificationType
     *
     * @return $this
     */
    public function setBeneficiaryIdentificationType($beneficiaryIdentificationType)
    {
        $this->beneficiaryIdentificationType = (string) $beneficiaryIdentificationType;
        return $this;
    }

    /**
     * @return string
     */
    public function getBeneficiaryIdentificationValue()
    {
        return $this->beneficiaryIdentificationValue;
    }

    /**
     * @param string $beneficiaryIdentificationValue
     *
     * @return $this
     */
    public function setBeneficiaryIdentificationValue($beneficiaryIdentificationValue)
    {
        $this->beneficiaryIdentificationValue = (string) $beneficiaryIdentificationValue;
        return $this;
    }

    /**
     * @return string
     */
    public function getBeneficiaryExternalReference()
    {
        return $this->beneficiaryExternalReference;
    }

    /**
     * @param string $beneficiaryExternalReference
     *
     * @return $this
     */
    public function setBeneficiaryExternalReference($beneficiaryExternalReference)
    {
        $this->beneficiaryExternalReference = (string) $beneficiaryExternalReference;
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
    public function getRoutingCodeType2()
    {
        return $this->routingCodeType2;
    }

    /**
     * @param string $routingCodeType2
     *
     * @return $this
     */
    public function setRoutingCodeType2($routingCodeType2)
    {
        $this->routingCodeType2 = (string) $routingCodeType2;
        return $this;
    }

    /**
     * @return string
     */
    public function getRoutingCodeValue2()
    {
        return $this->routingCodeValue2;
    }

    /**
     * @param string $routingCodeValue2
     *
     * @return $this
     */
    public function setRoutingCodeValue2($routingCodeValue2)
    {
        $this->routingCodeValue2 = (string) $routingCodeValue2;
        return $this;
    }

    /**
     * @return array
     */
    public function getBeneficiaryAddress()
    {
        return $this->beneficiaryAddress;
    }

    /**
     * @param string $beneficiaryAddress
     *
     * @return $this
     */
    public function setBeneficiaryAddress($beneficiaryAddress = null)
    {
        $this->beneficiaryAddress = $beneficiaryAddress;
        return $this;
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
     * @param string $bankAccountHolderName
     *
     * @return $this
     */
    public function setBankAccountHolderName($bankAccountHolderName)
    {
        $this->bankAccountHolderName = (string) $bankAccountHolderName;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = (string) $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = (string) $email;
        return $this;
    }

    /**
     * @param boolean $isDefaultBeneficiary
     *
     * @return $this
     */
    public function setIsDefaultBeneficiary($isDefaultBeneficiary)
    {
        $this->isDefaultBeneficiary = (boolean) $isDefaultBeneficiary;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDefaultBeneficiary()
    {
        return $this->isDefaultBeneficiary;
    }

    /**
     * @return string
     */
    public function getCreatorContactId()
    {
        return $this->creatorContactId;
    }

    /**
     * @param string $creatorContactId
     *
     * @return $this
     */
    public function setCreatorContactId($creatorContactId)
    {
        $this->creatorContactId = (string) $creatorContactId;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt(DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
