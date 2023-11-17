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
    private $updatedAt;
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
     * @param string $accountName
     * @param string $legalEntityType
     *
     * @return Account
     */
    public static function create($accountName, $legalEntityType)
    {
        return (new Account())->setAccountName($accountName)
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
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime|null $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(DateTime $createdAt = null)
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
     * @param DateTime|null $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt(DateTime $updatedAt = null)
    {
        $this->updatedAt = $updatedAt;
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


}
