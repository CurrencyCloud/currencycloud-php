<?php

namespace CurrencyCloud\Model;

use DateTime;

class FundingTransaction implements EntityInterface
{
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
    private $receivingAccountIban;
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
     * @var SenderInformation
     */
    private $sender;

    /**
     * @param string $id
     * @param string $amount
     * @param string $currency
     * @param string $rail
     * @param string $additionalInformation
     * @param string $receivingAccountRoutingCode
     * @param DateTime $valueDate
     * @param string $receivingAccountNumber
     * @param string $receivingAccountIban
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     * @param DateTime $completedAt
     * @param SenderInformation $sender
     */
    public function __construct(
        $id,
        $amount,
        $currency,
        $rail,
        $additionalInformation,
        $receivingAccountRoutingCode,
        DateTime $valueDate,
        $receivingAccountNumber,
        $receivingAccountIban,
        DateTime $createdAt,
        DateTime $updatedAt,
        DateTime $completedAt,
        SenderInformation $sender
    ) {
        $this->id = $id;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->rail = $rail;
        $this->additionalInformation = $additionalInformation;
        $this->receivingAccountRoutingCode = $receivingAccountRoutingCode;
        $this->valueDate = $valueDate;
        $this->receivingAccountNumber = $receivingAccountNumber;
        $this->receivingAccountIban = $receivingAccountIban;
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
    public function getReceivingAccountIban()
    {
        return $this->receivingAccountIban;
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
     * @return SenderInformation
     */
    public function getSender()
    {
        return $this->sender;
    }
}
