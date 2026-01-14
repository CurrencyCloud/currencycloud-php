<?php

namespace CurrencyCloud\Model;

use DateTime;
use stdClass;

class AccountComplianceSetting
{
    /**
    * @var string
    */
    private $accountId;
    /**
     * @var string
     */
    private $industryType;
    /**
     * @var string
     */
    private $countryOfIncorporation;
    /**
     * @var DateTime
     */
    private $dateOfIncorporation;
    /**
     * @var string
     */
    private $businessWebsiteUrl;
    /**
     * @var string
     */
    private $expectedTransactionCountries;
    /**
     * @var array[string]
     */
    private $expectedTransactionCurrencies;
    /**
     * @var array[string]
     */
    private $expectedMonthlyActivityVolume;
    /**
     * @var string
     */
    private $expectedMonthlyActivityValue;
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
    private $countryOfCitizenship;
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
    private $customerRisk;

    /**
     * @param stdClass $response

     * @return AccountComplianceSetting
     */
    public static function createFromResponse(stdClass $response)
    {
        $acs = new AccountComplianceSetting();

        $dateOfIncorporation = (null !== $response->date_of_incorporation) ? new DateTime($response->date_of_incorporation) : null;

        $acs->setAccountId($response->account_id)
            ->setIndustryType($response->industry_type)
            ->setCountryOfIncorporation($response->country_of_incorporation)
            ->setDateOfIncorporation($dateOfIncorporation)
            ->setBusinessWebsiteUrl($response->business_website_url)
            ->setExpectedMonthlyActivityVolume($response->expected_monthly_activity_volume)
            ->setExpectedMonthlyActivityValue($response->expected_monthly_activity_value)
            ->setTaxIdentification($response->tax_identification)
            ->setNationalIdentification($response->national_identification)
            ->setCountryOfCitizenship($response->country_of_citizenship)
            ->setTradingAddressStreet($response->trading_address_street)
            ->setTradingAddressCity($response->trading_address_city)
            ->setTradingAddressState($response->trading_address_state)
            ->setTradingAddressPostalcode($response->trading_address_postalcode)
            ->setTradingAddressCountry($response->trading_address_country)
            ->setCustomerRisk($response->customer_risk)
            ->setExpectedTransactionCountries($response->expected_transaction_countries)
            ->setExpectedTransactionCurrencies($response->expected_transaction_currencies);

        return $acs;
    }

    /**
     * @return array
     */
    public function convertToRequest()
    {
        $dateOfIncorporation = $this->getDateOfIncorporation();

        return [
            'industry_type' => $this->getIndustryType(),
            'business_website_url' => $this->getBusinessWebsiteUrl(),
            'country_of_incorporation' => $this->getCountryOfIncorporation(),
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

    /**
     * @return string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @param string $accountId
     *
     * @return $this
     */
    public function setAccountId($accountId)
    {
        $this->accountId = (null === $accountId) ? null : (string) $accountId;
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
     * @param string $industryType
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
    public function getCountryOfIncorporation()
    {
        return $this->countryOfIncorporation;
    }

    /**
     * @param string $countryOfIncorporation
     *
     * @return $this
     */
    public function setCountryOfIncorporation($countryOfIncorporation)
    {
        $this->countryOfIncorporation = (null === $countryOfIncorporation) ? null : (string) $countryOfIncorporation;
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
     * @param DateTime $dateOfIncorporation
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
    public function getBusinessWebsiteUrl()
    {
        return $this->businessWebsiteUrl;
    }

    /**
     * @param string $businessWebsiteUrl
     *
     * @return $this
     */
    public function setBusinessWebsiteUrl($businessWebsiteUrl)
    {
        $this->businessWebsiteUrl = (null === $businessWebsiteUrl) ? null : (string) $businessWebsiteUrl;
        return $this;
    }

    /**
     * @return array[string]
     */
    public function getExpectedTransactionCountries()
    {
        return $this->expectedTransactionCountries;
    }

    /**
     * @param array[string] $expectedTransactionCountries
     *
     * @return $this
     */
    public function setExpectedTransactionCountries($expectedTransactionCountries)
    {
        $this->expectedTransactionCountries = (null === $expectedTransactionCountries) ? null : (array) $expectedTransactionCountries;
        return $this;
    }

    /**
     * @return array[string]
     */
    public function getExpectedTransactionCurrencies()
    {
        return $this->expectedTransactionCurrencies;
    }

    /**
     * @param array[string] $expectedTransactionCurrencies
     *
     * @return $this
     */
    public function setExpectedTransactionCurrencies($expectedTransactionCurrencies)
    {
        $this->expectedTransactionCurrencies = (null === $expectedTransactionCurrencies) ? null : (array) $expectedTransactionCurrencies;
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
     * @param string $expectedMonthlyActivityVolume
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
     * @param string $expectedMonthlyActivityValue
     *
     * @return $this
     */
    public function setExpectedMonthlyActivityValue($expectedMonthlyActivityValue)
    {
        $this->expectedMonthlyActivityValue = (null === $expectedMonthlyActivityValue) ? null : (string) $expectedMonthlyActivityValue;
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
     * @param string $taxIdentification
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
     * @param string $nationalIdentification
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
    public function getCountryOfCitizenship()
    {
        return $this->countryOfCitizenship;
    }

    /**
     * @param string $countryOfCitizenship
     *
     * @return $this
     */
    public function setCountryOfCitizenship($countryOfCitizenship)
    {
        $this->countryOfCitizenship = (null === $countryOfCitizenship) ? null : (string) $countryOfCitizenship;
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
     * @param string $tradingAddressStreet
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
     * @param string $tradingAddressCity
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
     * @param string $tradingAddressState
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
     * @param string $tradingAddressPostalcode
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
     * @param string $tradingAddressCountry
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
    public function getCustomerRisk()
    {
        return $this->customerRisk;
    }

    /**
     * @param string $customerRisk
     *
     * @return $this
     */
    public function setCustomerRisk($customerRisk)
    {
        $this->customerRisk = (null === $customerRisk) ? null : (string) $customerRisk;
        return $this;
    }
}
