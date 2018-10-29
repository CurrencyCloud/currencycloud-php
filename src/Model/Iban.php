<?php
namespace CurrencyCloud\Model;

use DateTime;

class Iban {

    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $accountId;
    /**
     * @var string
     */
    private $ibanCode;
    /**
     * @var string
     */
    private $currency;
    /**
     * @var string
     */
    private $accountHolderName;
    /**
     * @var string
     */
    private $bankInstitutionName;
    /**
     * @var string
     */
    private $bankInstitutionAddress;
    /**
     * @var string
     */
    private $bankInstitutionCountry;
    /**
     * @var string
     */
    private $bicSwift;
    /**
     * @var DateTime
     */
    private $createdAt;
    /**
     * @var DateTime
     */
    private $updatedAt;

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
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @param string $accountId
     * @return $this
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
        return $this;
    }

    /**
     * @return string
     */
    public function getIbanCode()
    {
        return $this->ibanCode;
    }

    /**
     * @param string $ibanCode
     * @return $this
     */
    public function setIbanCode($ibanCode)
    {
        $this->ibanCode = $ibanCode;
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
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccountHolderName()
    {
        return $this->accountHolderName;
    }

    /**
     * @param string $accountHolderName
     * @return $this
     */
    public function setAccountHolderName($accountHolderName)
    {
        $this->accountHolderName = $accountHolderName;
        return $this;
    }

    /**
     * @return string
     */
    public function getBankInstitutionName()
    {
        return $this->bankInstitutionName;
    }

    /**
     * @param string $bankInstitutionName
     * @return $this
     */
    public function setBankInstitutionName($bankInstitutionName)
    {
        $this->bankInstitutionName = $bankInstitutionName;
        return $this;
    }

    /**
     * @return string
     */
    public function getBankInstitutionAddress()
    {
        return $this->bankInstitutionAddress;
    }

    /**
     * @param string $bankInstitutionAddress
     * @return $this
     */
    public function setBankInstitutionAddress($bankInstitutionAddress)
    {
        $this->bankInstitutionAddress = $bankInstitutionAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getBankInstitutionCountry()
    {
        return $this->bankInstitutionCountry;
    }

    /**
     * @param string $bankInstitutionCountry
     * @return $this
     */
    public function setBankInstitutionCountry($bankInstitutionCountry)
    {
        $this->bankInstitutionCountry = $bankInstitutionCountry;
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
     * @return $this
     */
    public function setBicSwift($bicSwift)
    {
        $this->bicSwift = $bicSwift;
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
     * @param DateTime $updatedAt
     * @return $this
     */
    public function setUpdatedAt(DateTime $updatedAt = null)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

}