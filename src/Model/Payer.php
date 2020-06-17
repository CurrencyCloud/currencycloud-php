<?php

namespace CurrencyCloud\Model;

use DateTime;

class Payer
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
     * @var null|string
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
     * @param string|null $legalEntityType
     * @param string|null $companyName
     * @param string|null $firstName
     * @param string|null $lastName
     * @param string|null $address
     * @param string|null $city
     * @param string|null $stateOrProvince
     * @param string|null $country
     * @param string|null $identificationType
     * @param string|null $identificationValue
     * @param string|null $postcode
     * @param DateTime|null $dateOfBirth
     * @param DateTime|null $createdAt
     * @param DateTime|null $updatedAt
     */
    public function __construct(
        $legalEntityType = null,
        $companyName = null,
        $firstName = null,
        $lastName = null,
        $address = null,
        $city = null,
        $stateOrProvince = null,
        $country = null,
        $identificationType = null,
        $identificationValue = null,
        $postcode = null,
        DateTime $dateOfBirth = null,
        DateTime $createdAt = null,
        DateTime $updatedAt = null
    ) {
        $this->legalEntityType = (null === $legalEntityType) ? null : (string) $legalEntityType;
        $this->companyName = (null === $companyName) ? null : (string) $companyName;
        $this->firstName = (null === $firstName) ? null : (string) $firstName;
        $this->lastName = (null === $lastName) ? null : (string) $lastName;
        $this->address = (null === $address) ? null : (string) $address;
        $this->city = (null === $city) ? null : (string) $city;
        $this->stateOrProvince = (null === $stateOrProvince) ? null : (string) $stateOrProvince;
        $this->country = (null === $country) ? null : (string) $country;
        $this->identificationType = (null === $identificationType) ? null : (string) $identificationType;
        $this->identificationValue = (null === $identificationValue) ? null : (string) $identificationValue;
        $this->postcode = (null === $postcode) ? null : (string) $postcode;
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

    /**
     * @param null|string $legalEntityType
     *
     * @return $this
     */
    public function setLegalEntityType($legalEntityType)
    {
        $this->legalEntityType = $legalEntityType;
        return $this;
    }

    /**
     * @param null|string $companyName
     *
     * @return $this
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
        return $this;
    }

    /**
     * @param null|string $firstName
     *
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @param null|string $lastName
     *
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @param null|string $address
     *
     * @return $this
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @param null|string $city
     *
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @param null|string $stateOrProvince
     *
     * @return $this
     */
    public function setStateOrProvince($stateOrProvince)
    {
        $this->stateOrProvince = $stateOrProvince;
        return $this;
    }

    /**
     * @param null|string $country
     *
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @param null|string $identificationType
     *
     * @return $this
     */
    public function setIdentificationType($identificationType)
    {
        $this->identificationType = $identificationType;
        return $this;
    }

    /**
     * @param null|string $identificationValue
     *
     * @return $this
     */
    public function setIdentificationValue($identificationValue)
    {
        $this->identificationValue = $identificationValue;
        return $this;
    }

    /**
     * @param null|string $postcode
     *
     * @return $this
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
        return $this;
    }

    /**
     * @param DateTime|null $dateOfBirth
     *
     * @return $this
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
        return $this;
    }

    /**
     * @param DateTime|null $createdAt
     *
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @param DateTime|null $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
