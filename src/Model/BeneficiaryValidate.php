<?php

namespace CurrencyCloud\Model;

use DateTime;
use stdClass;

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
     * @param DateTime $beneficiaryDateOfBirth
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
        $this->beneficiaryDateOfBirth = new DateTime((string) $beneficiaryDateOfBirth);
        $this->beneficiaryIdentificationType = (string) $beneficiaryIdentificationType;
        $this->beneficiaryIdentificationValue = (string) $beneficiaryIdentificationValue;
        $this->routingCodeType1 = (string) $routingCodeType1;
        $this->routingCodeValue1 = (string) $routingCodeValue1;
        $this->routingCodeType2 = (string) $routingCodeType2;
        $this->routingCodeValue2 = (string) $routingCodeValue2;
        $this->beneficiaryAddress = $beneficiaryAddress;
    }

    /**
     * @param stdClass $response
     * @return BeneficiaryValidate
     */
    public static function createFromResponse(stdClass $response)
    {
        return new BeneficiaryValidate(
            $response->payment_types,
            $response->bank_name,
            $response->bank_address,
            $response->beneficiary_country,
            $response->currency,
            $response->account_number,
            $response->iban,
            $response->bicSwift,
            $response->bank_account_type,
            $response->beneficiary_address,
            $response->beneficiary_country,
            $response->beneficiary_entity_type,
            $response->beneficiary_company_name,
            $response->beneficiary_first_name,
            $response->beneficiary_last_name,
            $response->beneficiary_city,
            $response->beneficiary_postcode,
            $response->beneficiary_state_or_province,
            $response->beneficiary_date_of_birth,
            $response->beneficiary_identification_type,
            $response->beneficiary_identification_value,
            $response->routing_code_value_1,
            $response->routing_code_value_1,
            $response->routing_code_type_2,
            $response->routing_code_value_2
        );
    }

    /**
     * @param BeneficiaryValidate $beneficiaryValidate
     * @return array
     */
    public static function toRequestArray(BeneficiaryValidate $beneficiaryValidate)
    {
        return [
            'bank_country' => $beneficiaryValidate->bankCountry,
            'currency' => $beneficiaryValidate->currency,
            'beneficiary_country' => $beneficiaryValidate->beneficiaryCountry,
            'account_number' => $beneficiaryValidate->accountNumber,
            'routing_code_type_1' => $beneficiaryValidate->routingCodeType1,
            'routing_code_value_1' => $beneficiaryValidate->routingCodeValue1,
            'routing_code_type_2' => $beneficiaryValidate->routingCodeType2,
            'routing_code_value_2' => $beneficiaryValidate->routingCodeValue2,
            'bic_swift' => $beneficiaryValidate->bicSwift,
            'iban' => $beneficiaryValidate->iban,
            'bank_address' => $beneficiaryValidate->bankAddress,
            'bank_name' => $beneficiaryValidate->bankName,
            'bank_account_type' => $beneficiaryValidate->bankAccountType,
            'beneficiary_entity_type' => $beneficiaryValidate->beneficiaryEntityType,
            'beneficiary_company_name' => $beneficiaryValidate->beneficiaryCompanyName,
            'beneficiary_first_name' => $beneficiaryValidate->beneficiaryFirstName,
            'beneficiary_last_name' => $beneficiaryValidate->beneficiaryLastName,
            'beneficiary_city' => $beneficiaryValidate->beneficiaryCity,
            'beneficiary_postcode' => $beneficiaryValidate->beneficiaryPostCode,
            'beneficiary_state_or_province' => $beneficiaryValidate->beneficiaryStateOrProvince,
            'beneficiary_date_of_birth' => (null === $beneficiaryValidate->beneficiaryDateOfBirth) ? null : $beneficiaryValidate->beneficiaryDateOfBirth->format(
                DateTime::ISO8601
            ),
            'beneficiary_identification_type' => $beneficiaryValidate->beneficiaryIdentificationType,
            'beneficiary_identification_value' => $beneficiaryValidate->beneficiaryIdentificationValue,
            'payment_types' => $beneficiaryValidate->paymentTypes
        ];
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
}
