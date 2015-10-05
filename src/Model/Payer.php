<?php

namespace CurrencyCloud\Model;

use DateTime;

class Payer implements EntityInterface
{

    /**
     * @var string|null
     */
    private $id;
    /**
     * @var null|string
     */
    private $legalEntityType;
    /**
     * @var null|string
     */
    private $companyName;
    /**
     * @var null|string
     */
    private $firstName;
    /**
     * @var null|string
     */
    private $lastName;
    /**
     * @var array|null
     */
    private $address;
    /**
     * @var null|string
     */
    private $city;
    /**
     * @var null|string
     */
    private $stateOrProvince;
    /**
     * @var null|string
     */
    private $country;
    /**
     * @var null|string
     */
    private $identificationType;
    /**
     * @var null|string
     */
    private $identificationValue;
    /**
     * @var null|string
     */
    private $postcode;
    /**
     * @var DateTime|null
     */
    private $dateOfBirth;
    /**
     * @var DateTime|null
     */
    private $createdAt;
    /**
     * @var DateTime|null
     */
    private $updatedAt;

    /**
     * @param string $legalEntityType
     * @param string $companyName
     * @param string $firstName
     * @param string $lastName
     * @param array $address
     * @param $city
     * @param string $stateOrProvince
     * @param string $country
     * @param string $identificationType
     * @param string $identificationValue
     * @param $postcode
     * @param DateTime $dateOfBirth
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     */
    public function __construct(
        $legalEntityType,
        $companyName,
        $firstName,
        $lastName,
        array $address,
        $city,
        $stateOrProvince,
        $country,
        $identificationType,
        $identificationValue,
        $postcode,
        DateTime $dateOfBirth,
        DateTime $createdAt,
        DateTime $updatedAt
    ) {
        $this->legalEntityType = (string) $legalEntityType;
        $this->companyName = (string) $companyName;
        $this->firstName = (string) $firstName;
        $this->lastName = (string) $lastName;
        $this->address = $address;
        $this->city = (string) $city;
        $this->stateOrProvince = (string) $stateOrProvince;
        $this->country = (string) $country;
        $this->identificationType = (string) $identificationType;
        $this->identificationValue = (string) $identificationValue;
        $this->postcode = (string) $postcode;
        $this->dateOfBirth = $dateOfBirth;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getLegalEntityType()
    {
        return $this->legalEntityType;
    }

    /**
     * @return null|string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @return null|string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return null|string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return array|null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return null|string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return null|string
     */
    public function getStateOrProvince()
    {
        return $this->stateOrProvince;
    }

    /**
     * @return null|string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return null|string
     */
    public function getIdentificationType()
    {
        return $this->identificationType;
    }

    /**
     * @return null|string
     */
    public function getIdentificationValue()
    {
        return $this->identificationValue;
    }

    /**
     * @return null|string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @return DateTime|null
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
