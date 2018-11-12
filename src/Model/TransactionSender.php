<?php
namespace CurrencyCloud\Model;

use DateTime;

class  TransactionSender implements EntityInterface {

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $additionalInformation;

    /**
     * @var DateTime
     */
    private $valueDate;

    /**
     * @var string
     */
    private $sender;

    /**
     * @var string
     */
    private $receivingAcountNumber;

    /**
     * @var string
     */
    private $receivingAcountIban;

    /**
     * @var DateTime
     */
    private $createdAt;

    /**
     * @var DateTime
     */
    private $updatedAt;

    /**
     * TransactionSender constructor.
     * @param string $id
     * @param string $amount
     * @param string $currency
     * @param string $additionalInformation
     * @param DateTime $valueDate
     * @param string $sender
     * @param string $receivingAcountNumber
     * @param string $receivingAcountIban
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     */
    public function __construct($id, $amount, $currency, $additionalInformation, DateTime $valueDate, $sender, $receivingAcountNumber, $receivingAcountIban, DateTime $createdAt, DateTime $updatedAt)
    {
        $this->id = $id;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->additionalInformation = $additionalInformation;
        $this->valueDate = $valueDate;
        $this->sender = $sender;
        $this->receivingAcountNumber = $receivingAcountNumber;
        $this->receivingAcountIban = $receivingAcountIban;
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
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getAdditionalInformation()
    {
        return $this->additionalInformation;
    }

    /**
     * @return DateTime
     */
    public function getValueDate()
    {
        return $this->valueDate;
    }

    /**
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @return string
     */
    public function getReceivingAcountNumber()
    {
        return $this->receivingAcountNumber;
    }

    /**
     * @return string
     */
    public function getReceivingAcountIban()
    {
        return $this->receivingAcountIban;
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