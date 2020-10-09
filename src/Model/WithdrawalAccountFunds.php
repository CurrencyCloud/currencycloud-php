<?php
namespace CurrencyCloud\Model;

use DateTime;

class WithdrawalAccountFunds implements EntityInterface {

    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $withdrawalAccountId;
    /**
     * @var string
     */
    private $reference;
    /**
     * @var string
     */
    private $amount;
    /**
     * @var DateTime
     */
    private $createAt;


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
    public function getWithdrawalAccountId()
    {
        return $this->withdrawalAccountId;
    }

    /**
     * @param string $withdrawalAccountId
     * @return $this
     */
    public function setWithdrawalAccountId($withdrawalAccountId)
    {
        $this->withdrawalAccountId = $withdrawalAccountId;
        return $this;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     * @return $this
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param string $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createAt;
    }

    /**
     * @param DateTime $createAt
     * @return $this
     */
    public function setCreatedAt(DateTime $createAt = null)
    {
        $this->createAt = $createAt;
        return $this;
    }

}