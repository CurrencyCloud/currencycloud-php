<?php
namespace CurrencyCloud\Model;

use DateTime;

class  FundingTransaction implements EntityInterface {

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
    private $rail;

    /**
     * @var string
     */
    private $additionalInformation;

    /**
     * @var string
     */
    private $receivingAccountRoutingCode;

    /**
     * @var DateTime
     */
    private $valueDate;

    /**
     * @var string
     */
    private $receivingAccountNumber;

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
     * @var DateTime
     */
    private $completedAt;

    /**
     * @var FundingTransactionSender
     */
    private $sender;

    /**
     * FundingTransaction constructor.
     * @param string $id
     * @param string $amount
     * @param string $currency
     * @param string $rail
     * @param string $additionalInformation
     * @param string $receivingAccountRoutingCode
     * @param DateTime $valueDate
     * @param string $receivingAcountNumber
     * @param string $receivingAcountIban
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     * @param DateTime $completedAt
     * @param FundingTransactionSender $sender
     */
    public function __construct($id, $amount, $currency, $rail, $additionalInformation, $receivingAccountRoutingCode, DateTime $valueDate, $receivingAcountNumber, $receivingAcountIban, DateTime $createdAt, DateTime $updatedAt, DateTime $completedAt, FundingTransactionSender $sender)
    {
        $this->id = $id;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->rail = $rail;
        $this->additionalInformation = $additionalInformation;
        $this->receivingAccountRoutingCode = $receivingAccountRoutingCode;
        $this->valueDate = $valueDate;
        $this->receivingAcountNumber = $receivingAcountNumber;
        $this->receivingAcountIban = $receivingAcountIban;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->completedAt = $completedAt;
        $this->sender = $sender;
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
    public function getRail()
    {
        return $this->rail;
    }

    /**
     * @return string
     */
    public function getAdditionalInformation()
    {
        return $this->additionalInformation;
    }

    /**
     * @return string
     */
    public function getReceivingAccountRoutingCode()
    {
        return $this->receivingAccountRoutingCode;
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
    public function getReceivingAccountNumber()
    {
        return $this->receivingAccountNumber;
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

    /**
     * @return DateTime
     */
    public function getCompletedAt()
    {
        return $this->completedAt;
    }

    /**
     * @return FundingTransactionSender
     */
    public function getSender()
    {
        return $this->sender;
    }

}