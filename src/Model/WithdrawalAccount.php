<?php
namespace CurrencyCloud\Model;

use DateTime;

class WithdrawalAccount implements EntityInterface {

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
    private $accountName;
    /**
     * @var string
     */
    private $accountHolderName;
    /**
     * @var DateTime
     */
    private $accountHolderDob;
    /**
     * @var string
     */
    private $routingCode;
    /**
     * @var string
     */
    private $accountNumber;
    /**
     * @var string
     */
    private $currency;

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
    public function getAccountName()
    {
        return $this->accountName;
    }

    /**
     * @param string $accountName
     * @return $this
     */
    public function setAccountName($accountName)
    {
        $this->accountName = $accountName;
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
     * @return DateTime
     */
    public function getAccountHolderDob()
    {
        return $this->accountHolderDob;
    }

    /**
     * @param DateTime $accountHolderDob
     * @return $this
     */
    public function setAccountHolderDob(DateTime $accountHolderDob = null)
    {
        $this->accountHolderDob = $accountHolderDob;
        return $this;
    }

    /**
     * @return string
     */
    public function getRoutingCode()
    {
        return $this->routingCode;
    }

    /**
     * @param string $routingCode
     * @return $this
     */
    public function setRoutingCode($routingCode)
    {
        $this->routingCode = $routingCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * @param string $accountNumber
     * @return $this
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
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

}