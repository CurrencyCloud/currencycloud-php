<?php

namespace CurrencyCloud\Model;

use DateTime;

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
     * @param string $id
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
        $id,
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

        $this->id = (string) $id;
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
}
