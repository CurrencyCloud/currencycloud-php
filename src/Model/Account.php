<?php

namespace CurrencyCloud\Model;

use DateTime;
use stdClass;

class Account implements EntityInterface
{
    /**
     * @var string
     */
    private $id;
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
     * @var DateTime
     */
    private $createdAt;
    /**
     * @var DateTime
     */
    private $updatedAd;
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
     * @param string $legalEntityType
     * @param string $accountName
     * @param string $brand
     * @param string $yourReference
     * @param string $status
     * @param string $street
     * @param string $city
     * @param string $stateOrProvince
     * @param string $country
     * @param string $postalCode
     * @param string $spreadTable
     * @param string $createdAt
     * @param string $updatedAd
     * @param string $identificationType
     * @param string $identificationValue
     * @param string $shortReference
     */
    public function __construct(
        $legalEntityType,
        $accountName,
        $brand,
        $yourReference,
        $status,
        $street,
        $city,
        $stateOrProvince,
        $country,
        $postalCode,
        $spreadTable,
        $createdAt,
        $updatedAd,
        $identificationType,
        $identificationValue,
        $shortReference
    ) {
        $this->legalEntityType = (string) $legalEntityType;
        $this->accountName = (string) $accountName;
        $this->brand = (string) $brand;
        $this->yourReference = (string) $yourReference;
        $this->status = (string) $status;
        $this->street = (string) $street;
        $this->city = (string) $city;
        $this->stateOrProvince = (string) $stateOrProvince;
        $this->country = (string) $country;
        $this->postalCode = (string) $postalCode;
        $this->spreadTable = (string) $spreadTable;
        $this->createdAt = new DateTime((string) $createdAt);
        $this->updatedAd = new DateTime((string) $updatedAd);
        $this->identificationType = (string) $identificationType;
        $this->identificationValue = (string) $identificationValue;
        $this->shortReference = (string) $shortReference;
    }

    /**
     * @param stdClass $response
     * @return Account
     */
    public static function createFromResponse(stdClass $response)
    {
        $account = new Account(
            $response->legal_entity_type,
            $response->account_name,
            $response->brand,
            $response->your_reference,
            $response->status,
            $response->street,
            $response->city,
            $response->state_or_province,
            $response->country,
            $response->postal_code,
            $response->spread_table,
            $response->created_at,
            $response->updated_at,
            $response->identification_type,
            $response->identification_value,
            $response->short_reference
        );
        $account->id = (string) $response->id;
        return $account;
    }

    /**
     * @param Account $account
     * @return array
     */
    public static function convertToRequest(Account $account)
    {
        return [
            'id' => $account->id,
            'account_name' => $account->accountName,
            'legal_entity_type' => $account->legalEntityType,
            'your_reference' => $account->yourReference,
            'status' => $account->status,
            'street' => $account->street,
            'city' => $account->city,
            'state_or_province' => $account->stateOrProvince,
            'postal_code' => $account->postalCode,
            'country' => $account->country,
            'spread_table' => $account->spreadTable,
            'identification_type' => $account->identificationType,
            'identification_value' => $account->identificationValue
        ];
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
     * @return string
     */
    public function getAccountName()
    {
        return $this->accountName;
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @return string
     */
    public function getYourReference()
    {
        return $this->yourReference;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getStateOrProvince()
    {
        return $this->stateOrProvince;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @return string
     */
    public function getSpreadTable()
    {
        return $this->spreadTable;
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
    public function getUpdatedAd()
    {
        return $this->updatedAd;
    }

    /**
     * @return string
     */
    public function getIdentificationType()
    {
        return $this->identificationType;
    }

    /**
     * @return string
     */
    public function getIdentificationValue()
    {
        return $this->identificationValue;
    }

    /**
     * @return string
     */
    public function getShortReference()
    {
        return $this->shortReference;
    }

    /**
     * @param string $legalEntityType
     */
    public function setLegalEntityType($legalEntityType)
    {
        $this->legalEntityType = (string) $legalEntityType;
    }

    /**
     * @param string $accountName
     */
    public function setAccountName($accountName)
    {
        $this->accountName = (string) $accountName;
    }

    /**
     * @param string $brand
     */
    public function setBrand($brand)
    {
        $this->brand = (string) $brand;
    }

    /**
     * @param string $yourReference
     */
    public function setYourReference($yourReference)
    {
        $this->yourReference = (string) $yourReference;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = (string) $status;
    }

    /**
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = (string) $street;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = (string) $city;
    }

    /**
     * @param string $stateOrProvince
     */
    public function setStateOrProvince($stateOrProvince)
    {
        $this->stateOrProvince = (string) $stateOrProvince;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = (string) $country;
    }

    /**
     * @param string $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = (string) $postalCode;
    }

    /**
     * @param string $spreadTable
     */
    public function setSpreadTable($spreadTable)
    {
        $this->spreadTable = (string) $spreadTable;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @param DateTime $updatedAd
     */
    public function setUpdatedAd(DateTime $updatedAd)
    {
        $this->updatedAd = $updatedAd;
    }

    /**
     * @param string $identificationType
     */
    public function setIdentificationType($identificationType)
    {
        $this->identificationType = (string) $identificationType;
    }

    /**
     * @param string $identificationValue
     */
    public function setIdentificationValue($identificationValue)
    {
        $this->identificationValue = (string) $identificationValue;
    }

    /**
     * @param string $shortReference
     */
    public function setShortReference($shortReference)
    {
        $this->shortReference = (string) $shortReference;
    }
}
