<?php

namespace CurrencyCloud\Model;

use DateTime;

class AccountCreateRequest
{
    /**
     * @var string
     */
    private $legalEntityType;
    /**
     * @var string
     */
    private $accountName;
    /**
     * @var string
     */
    private $brand;
    /**
     * @var string
     */
    private $yourReference;
    /**
     * @var string
     */
    private $status;
    /**
     * @var string
     */
    private $street;
    /**
     * @var string
     */
    private $city;
    /**
     * @var string
     */
    private $stateOrProvince;
    /**
     * @var string
     */
    private $country;
    /**
     * @var string
     */
    private $postalCode;
    /**
     * @var string
     */
    private $spreadTable;
    /**
     * @var string
     */
    private $identificationType;
    /**
     * @var string
     */
    private $identificationValue;
    /**
     * @var string
     */
    private $shortReference;
    /**
     * @var bool
     */
    private $termsAndConditionsAccepted;
    /**
     * @var bool
     */
    private $apiTrading;
    /**
     * @var bool
     */
    private $onlineTrading;
    /**
     * @var bool
     */
    private $phoneTrading;
    /**
     * @var string
     */
    private $legalEntitySubType;
    /**
     * @var DateTime
     */
    private $identificationExpiration;
    /**
     * @var string
     */
    private $identificationIssuer;
    /**
     * @var string
     */
    private $industryType;
    /**
     * @var string
     */
    private $businessWebsiteUrl;
    /**
     * @var string
     */
    private $countryOfCitizenship;
    /**
     * @var DateTime
     */
    private $dateOfIncorporation;
    /**
     * @var string
     */
    private $tradingAddressStreet;
    /**
     * @var string
     */
    private $tradingAddressCity;
    /**
     * @var string
     */
    private $tradingAddressState;
    /**
     * @var string
     */
    private $tradingAddressPostalcode;
    /**
     * @var string
     */
    private $tradingAddressCountry;
    /**
     * @var string
     */
    private $taxIdentification;
    /**
     * @var string
     */
    private $nationalIdentification;
    /**
     * @var string
     */
    private $customerRisk;
    /**
     * @var string
     */
    private $expectedMonthlyActivityVolume;
    /**
     * @var string
     */
    private $expectedMonthlyActivityValue;
    /**
     * @var Array[string]
     */
    private $expectedTransactionCurrencies;
    /**
     * @var Array[string]
     */
    private $expectedTransactionCountries;

    /**
     * @param string $accountName
     * @param string $legalEntityType
     *
     * @return Account
     */
    public static function create($accountName, $legalEntityType)
    {
        return (new AccountCreateRequest())->setAccountName($accountName)
            ->setLegalEntityType($legalEntityType);
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
    public function getLegalEntityType()
    {
        return $this->legalEntityType;
    }

    /**
     * @param string $legalEntityType
     *
     * @return $this
     */
    public function setLegalEntityType($legalEntityType)
    {
        $this->legalEntityType = (null === $legalEntityType) ? null : (string) $legalEntityType;
        return $this;
    }


    /**
     * @return string
     */
    public function getAccountName()
    {
        return $this->accountName;
    }

    /**
     * @param string $accountName
     *
     * @return $this
     */
    public function setAccountName($accountName)
    {
        $this->accountName = (null === $accountName) ? null : (string) $accountName;
        return $this;
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     *
     * @return $this
     */
    public function setBrand($brand)
    {
        $this->brand = (null === $brand) ? null : (string) $brand;
        return $this;
    }

    /**
     * @return string
     */
    public function getYourReference()
    {
        return $this->yourReference;
    }

    /**
     * @param string $yourReference
     *
     * @return $this
     */
    public function setYourReference($yourReference)
    {
        $this->yourReference = (null === $yourReference) ? null : (string) $yourReference;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = (null === $status) ? null : (string) $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     *
     * @return $this
     */
    public function setStreet($street)
    {
        $this->street = (null === $street) ? null : (string) $street;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = (null === $city) ? null : (string) $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getStateOrProvince()
    {
        return $this->stateOrProvince;
    }

    /**
     * @param string $stateOrProvince
     *
     * @return $this
     */
    public function setStateOrProvince($stateOrProvince)
    {
        $this->stateOrProvince = (null === $stateOrProvince) ? null : (string) $stateOrProvince;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     *
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = (null === $country) ? null : (string) $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     *
     * @return $this
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = (null === $postalCode) ? null : (string) $postalCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getSpreadTable()
    {
        return $this->spreadTable;
    }

    /**
     * @param string $spreadTable
     *
     * @return $this
     */
    public function setSpreadTable($spreadTable)
    {
        $this->spreadTable = (null === $spreadTable) ? null : (string) $spreadTable;
        return $this;
    }


    /**
     * @return string
     */
    public function getIdentificationType()
    {
        return $this->identificationType;
    }

    /**
     * @param string $identificationType
     *
     * @return $this
     */
    public function setIdentificationType($identificationType)
    {
        $this->identificationType = (null === $identificationType) ? null : (string) $identificationType;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdentificationValue()
    {
        return $this->identificationValue;
    }

    /**
     * @param string $identificationValue
     *
     * @return $this
     */
    public function setIdentificationValue($identificationValue)
    {
        $this->identificationValue = (null === $identificationValue) ? null : (string) $identificationValue;
        return $this;
    }


    /**
     * @return string
     */
    public function getShortReference()
    {
        return $this->shortReference;
    }

    /**
     * @param string $shortReference
     *
     * @return $this
     */
    public function setShortReference($shortReference)
    {
        $this->shortReference = (null === $shortReference) ? null : (string) $shortReference;
        return $this;
    }

    /**
     * @return bool
     */
    public function isTermsAndConditionsAccepted()
    {
        return $this->termsAndConditionsAccepted;
    }

    /**
     * @param bool $termsAndConditionsAccepted
     *
     * @return $this
     */
    public function setTermsAndConditionsAccepted($termsAndConditionsAccepted)
    {
        $this->termsAndConditionsAccepted = (null === $termsAndConditionsAccepted) ? null : (bool)$termsAndConditionsAccepted;
        return $this;
    }

    /**
     * @return bool
     */
    public function isApiTRading()
    {
        return $this->apiTrading;
    }

    /**
     * @param bool $apiTrading
     *
     * @return $this
     */
    public function setApiTrading($apiTrading)
    {
        $this->apiTrading = (null === $apiTrading) ? null : (bool)$apiTrading;
        return $this;
    }

    /**
     * @return bool
     */
    public function isOnlineTRading()
    {
        return $this->onlineTrading;
    }

    /**
     * @param bool $apiTrading
     *
     * @return $onlineTrading
     */
    public function setOnlineTrading($onlineTrading)
    {
        $this->onlineTrading = (null === $onlineTrading) ? null : (bool)$onlineTrading;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPhoneTrading()
    {
        return $this->phoneTrading;
    }

    /**
     * @param bool $phoneTrading
     *
     * @return $this
     */
    public function setPhoneTrading($phoneTrading)
    {
        $this->phoneTrading = (null === $phoneTrading) ? null : (bool)$phoneTrading;
        return $this;
    }

    /**
     * @return string
     */
    public function getLegalEntitySubType()
    {
        return $this->legalEntitySubType;
    }

    /**
     * @param string $legalEntitySubType
     *
     * @return $this
     */
    public function setLegalEntitySubType($legalEntitySubType)
    {
        $this->legalEntitySubType = (null === $legalEntitySubType) ? null : (string) $legalEntitySubType;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdentificationIssuer()
    {
        return $this->identificationIssuer;
    }

    /**
     * @param string $identificationIssuer
     *
     * @return $this
     */
    public function setIdentificationIssuer($identificationIssuer)
    {
        $this->identificationIssuer = (null === $identificationIssuer) ? null : (string) $identificationIssuer;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getIdentificationExpiration()
    {
        return $this->identificationExpiration;
    }

    /**
     * @param DateTime $identificationExpiration
     *
     * @return $this
     */
    public function setIdentificationExpiration(DateTime $identificationExpiration)
    {
        $this->identificationExpiration = (null === $identificationExpiration) ? null : $identificationExpiration;
        return $this;
    }

    /**
     * @return string
     */
    public function getIndustryType()
    {
        return $this->industryType;
    }

    /**
     * @param string
     *
     * @return $this
     */
    public function setIndustryType($industryType)
    {
        $this->industryType = (null === $industryType) ? null : (string) $industryType;
        return $this;
    }

    /**
     * @return string
     */
    public function getBusinessWebsiteUrl()
    {
        return $this->businessWebsiteUrl;
    }

    /**
     * @param string
     *
     * @return $this
     */
    public function setBusinessWebsiteUrl($businessWebsiteUrl)
    {
        $this->businessWebsiteUrl = (null === $businessWebsiteUrl) ? null : (string) $businessWebsiteUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountryOfCitizenship()
    {
        return $this->countryOfCitizenship;
    }

    /**
     * @param string
     *
     * @return $this
     */
    public function setCountryOfCitizenship($countryOfCitizenship)
    {
        $this->countryOfCitizenship = (null === $countryOfCitizenship) ? null : (string) $countryOfCitizenship;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateOfIncorporation()
    {
        return $this->dateOfIncorporation;
    }

    /**
     * @param DateTime
     *
     * @return $this
     */
    public function setDateOfIncorporation(DateTime $dateOfIncorporation)
    {
        $this->dateOfIncorporation = (null === $dateOfIncorporation) ? null : $dateOfIncorporation;
        return $this;
    }

    /**
     * @return string
     */
    public function getTradingAddressStreet()
    {
        return $this->tradingAddressStreet;
    }

    /**
     * @param string
     *
     * @return $this
     */
    public function setTradingAddressStreet($tradingAddressStreet)
    {
        $this->tradingAddressStreet = (null === $tradingAddressStreet) ? null : (string) $tradingAddressStreet;
        return $this;
    }

    /**
     * @return string
     */
    public function getTradingAddressCity()
    {
        return $this->tradingAddressCity;
    }

    /**
     * @param string
     *
     * @return $this
     */
    public function setTradingAddressCity($tradingAddressCity)
    {
        $this->tradingAddressCity = (null === $tradingAddressCity) ? null : (string) $tradingAddressCity;
        return $this;
    }

    /**
     * @return string
     */
    public function getTradingAddressState()
    {
        return $this->tradingAddressState;
    }

    /**
     * @param string
     *
     * @return $this
     */
    public function setTradingAddressState($tradingAddressState)
    {
        $this->tradingAddressState = (null === $tradingAddressState) ? null : (string) $tradingAddressState;
        return $this;
    }

    /**
     * @return string
     */
    public function getTradingAddressPostalcode()
    {
        return $this->tradingAddressPostalcode;
    }

    /**
     * @param string
     *
     * @return $this
     */
    public function setTradingAddressPostalcode($tradingAddressPostalcode)
    {
        $this->tradingAddressPostalcode = (null === $tradingAddressPostalcode) ? null : (string) $tradingAddressPostalcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getTradingAddressCountry()
    {
        return $this->tradingAddressCountry;
    }

    /**
     * @param string
     *
     * @return $this
     */
    public function setTradingAddressCountry($tradingAddressCountry)
    {
        $this->tradingAddressCountry = (null === $tradingAddressCountry) ? null : (string) $tradingAddressCountry;
        return $this;
    }

    /**
     * @return string
     */
    public function getTaxIdentification()
    {
        return $this->taxIdentification;
    }

    /**
     * @param string
     *
     * @return $this
     */
    public function setTaxIdentification($taxIdentification)
    {
        $this->taxIdentification = (null === $taxIdentification) ? null : (string) $taxIdentification;
        return $this;
    }

    /**
     * @return string
     */
    public function getNationalIdentification()
    {
        return $this->nationalIdentification;
    }

    /**
     * @param string
     *
     * @return $this
     */
    public function setNationalIdentification($nationalIdentification)
    {
        $this->nationalIdentification = (null === $nationalIdentification) ? null : (string) $nationalIdentification;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerRisk()
    {
        return $this->customerRisk;
    }

    /**
     * @param string
     *
     * @return $this
     */
    public function setCustomerRisk($customerRisk)
    {
        $this->customerRisk = (null === $customerRisk) ? null : (string) $customerRisk;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpectedMonthlyActivityVolume()
    {
        return $this->expectedMonthlyActivityVolume;
    }

    /**
     * @param string
     *
     * @return $this
     */
    public function setExpectedMonthlyActivityVolume($expectedMonthlyActivityVolume)
    {
        $this->expectedMonthlyActivityVolume = (null === $expectedMonthlyActivityVolume) ? null : (string) $expectedMonthlyActivityVolume;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpectedMonthlyActivityValue()
    {
        return $this->expectedMonthlyActivityValue;
    }

    /**
     * @param string
     *
     * @return $this
     */
    public function setExpectedMonthlyActivityValue($expectedMonthlyActivityValue)
    {
        $this->expectedMonthlyActivityValue = (null === $expectedMonthlyActivityValue) ? null : (string) $expectedMonthlyActivityValue;
        return $this;
    }

    /**
     * @return Array[string]
     */
    public function getExpectedTransactionCurrencies()
    {
        return $this->expectedTransactionCurrencies;
    }

    /**
     * @param Array[string]
     *
     * @return $this
     */
    public function setExpectedTransactionCurrencies($expectedTransactionCurrencies)
    {
        $this->expectedTransactionCurrencies = (null === $expectedTransactionCurrencies) ? null : (array) $expectedTransactionCurrencies;
        return $this;
    }

    /**
     * @return Array[string]
     */
    public function getExpectedTransactionCountries()
    {
        return $this->expectedTransactionCountries;
    }

    /**
     * @param Array[string]
     *
     * @return $this
     */
    public function setExpectedTransactionCountries($expectedTransactionCountries)
    {
        $this->expectedTransactionCountries = (null === $expectedTransactionCountries) ? null : (array) $expectedTransactionCountries;
        return $this;
    }

    /**
     * @return array
     */
    public function convertToRequest()
    {
        $dateOfIncorporation = $this->getDateOfIncorporation();
        $identificationExpiration = $this->getIdentificationExpiration();

        return [
            'legal_entity_type' => $this->getLegalEntityType(),
            'legal_entity_sub_type' => $this->getLegalEntitySubType(),
            'account_name' => $this->getAccountName(),
            'your_reference' => $this->getYourReference(),
            'status' => $this->getStatus(),
            'street' => $this->getStreet(),
            'city' => $this->getCity(),
            'state_or_province' => $this->getStateOrProvince(),
            'postal_code' => $this->getPostalCode(),
            'country' => $this->getCountry(),
            'brand' => $this->getBrand(),
            'spread_table' => $this->getSpreadTable(),
            'identification_type' => $this->getIdentificationType(),
            'identification_value' => $this->getIdentificationValue(),
            'identification_expiration' => (null === $identificationExpiration) ? null : $identificationExpiration->format('Y-m-d'),
            'identification_issuer' => $this->getIdentificationIssuer(),
            'terms_and_conditions_accepted' => $this->boolToString($this->isTermsAndConditionsAccepted()),
            'api_trading' => $this->boolToString($this->isApiTrading()),
            'online_trading' => $this->boolToString($this->isOnlineTrading()),
            'phone_trading' => $this->boolToString($this->isPhoneTrading()),
            'industry_type' => $this->getIndustryType(),
            'business_website_url' => $this->getBusinessWebsiteUrl(),
            'country_of_citizenship' => $this->getCountryOfCitizenship(),
            'date_of_incorporation' => (null === $dateOfIncorporation) ? null : $dateOfIncorporation->format('Y-m-d'),
            'trading_address_street' => $this->getTradingAddressStreet(),
            'trading_address_city' => $this->getTradingAddressCity(),
            'trading_address_state' => $this->getTradingAddressState(),
            'trading_address_postalcode' => $this->getTradingAddressPostalcode(),
            'trading_address_country' => $this->getTradingAddressCountry(),
            'tax_identification' => $this->getTaxIdentification(),
            'national_identification' => $this->getNationalIdentification(),
            'customer_risk' => $this->getCustomerRisk(),
            'expected_monthly_activity_volume' => $this->getExpectedMonthlyActivityVolume(),
            'expected_monthly_activity_value' => $this->getExpectedMonthlyActivityValue(),
            'expected_transaction_currencies' => $this->getExpectedTransactionCurrencies(),
            'expected_transaction_countries' => $this->getExpectedTransactionCountries(),
        ];
    }

    private function boolToString($boolVal)
    {
        return (null === $boolVal) ? null : ($boolVal ? 'true' : 'false');
    }
}
