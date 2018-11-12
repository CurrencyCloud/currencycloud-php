<?php
namespace CurrencyCloud\Model;

use DateTime;

class Van implements EntityInterface {

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $account_id;

    /**
     * @var string
     */
    private $virtualAccountNumber;

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
    private $routingCode;

    /**
     * @var DateTime
     */
    private $createdAt;

    /**
     * @var DateTime
     */
    private $updatedAt;

    /**
     * VAN constructor.
     * @param string $id
     * @param string $account_id
     * @param string $virtualAccountNumber
     * @param string $accountHolderName
     * @param string $bankInstitutionName
     * @param string $bankInstitutionAddress
     * @param string $bankInstitutionCountry
     * @param string $routingCode
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     */
    public function __construct($id, $account_id, $virtualAccountNumber, $accountHolderName, $bankInstitutionName, $bankInstitutionAddress, $bankInstitutionCountry, $routingCode, DateTime $createdAt, DateTime $updatedAt)
    {
        $this->id = $id;
        $this->account_id = $account_id;
        $this->virtualAccountNumber = $virtualAccountNumber;
        $this->accountHolderName = $accountHolderName;
        $this->bankInstitutionName = $bankInstitutionName;
        $this->bankInstitutionAddress = $bankInstitutionAddress;
        $this->bankInstitutionCountry = $bankInstitutionCountry;
        $this->routingCode = $routingCode;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
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
    public function getAccountId()
    {
        return $this->account_id;
    }

    /**
     * @return string
     */
    public function getVirtualAccountNumber()
    {
        return $this->virtualAccountNumber;
    }

    /**
     * @return string
     */
    public function getAccountHolderName()
    {
        return $this->accountHolderName;
    }

    /**
     * @return string
     */
    public function getBankInstitutionName()
    {
        return $this->bankInstitutionName;
    }

    /**
     * @return string
     */
    public function getBankInstitutionAddress()
    {
        return $this->bankInstitutionAddress;
    }

    /**
     * @return string
     */
    public function getBankInstitutionCountry()
    {
        return $this->bankInstitutionCountry;
    }

    /**
     * @return string
     */
    public function getRoutingCode()
    {
        return $this->routingCode;
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
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}