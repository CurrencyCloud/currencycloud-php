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
     * @param string $accountName
     * @param string $legalEntityType
     * @param string|null $brand
     * @param string|null $yourReference
     * @param string|null $status
     * @param string|null $street
     * @param string|null $city
     * @param string|null $stateOrProvince
     * @param string|null $country
     * @param string|null $postalCode
     * @param string|null $spreadTable
     * @param string|null $createdAt
     * @param string|null $updatedAd
     * @param string|null $identificationType
     * @param string|null $identificationValue
     * @param string|null $shortReference
     */
    public function __construct(
        $accountName,
        $legalEntityType,
        $brand = null,
        $yourReference = null,
        $status = null,
        $street = null,
        $city = null,
        $stateOrProvince = null,
        $country = null,
        $postalCode = null,
        $spreadTable = null,
        $createdAt = null,
        $updatedAd = null,
        $identificationType = null,
        $identificationValue = null,
        $shortReference = null
    ) {
        $this->accountName = (null === $accountName) ? null : (string) $accountName;
        $this->legalEntityType = (null === $legalEntityType) ? null : (string) $legalEntityType;
        $this->brand = (null === $brand) ? $brand : (string) $brand;
        $this->yourReference = (null === $yourReference) ? $yourReference : (string) $yourReference;
        $this->status = (null === $status) ? $status : (string) $status;
        $this->street = (null === $street) ? $street : (string) $street;
        $this->city = (null === $city) ? $city : (string) $city;
        $this->stateOrProvince = (null === $stateOrProvince) ? $stateOrProvince : (string) $stateOrProvince;
        $this->country = (null === $country) ? $country : (string) $country;
        $this->postalCode = (null === $postalCode) ? $postalCode : (string) $postalCode;
        $this->spreadTable = (null === $spreadTable) ? $spreadTable : (string) $spreadTable;
        $this->createdAt = (null === $createdAt) ? null : new DateTime((string) $createdAt);
        $this->updatedAd = (null === $updatedAd) ? null : new DateTime((string) $updatedAd);
        $this->identificationType = (null === $identificationType) ? $identificationType : (string) $identificationType;
        $this->identificationValue = (null === $identificationValue) ?
            $identificationValue : (string) $identificationValue;
        $this->shortReference = (null === $shortReference) ? $shortReference : (string) $shortReference;
    }

    /**
     * @return Account
     */
    public static function create()
    {
        return new Account(null, null);
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
