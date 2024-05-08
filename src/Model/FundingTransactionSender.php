<?php
namespace CurrencyCloud\Model;

class  FundingTransactionSender implements EntityInterface {

    /**
     * @var string
     */
    private $senderId;

    /**
     * @var string
     */
    private $senderAddress;

    /**
     * @var string
     */
    private $senderCountry;

        /**
     * @var string
     */
    private $senderName;

    /**
     * @var string
     */
    private $senderBic;

    /**
     * @var string
     */
    private $senderIban;

    /**
     * @var string
     */
    private $senderAccountNumber;

    /**
     * @var string
     */
    private $senderRoutingCode;

   /**
     * FundingTransactionSender constructor.
     * @param string $senderId
     * @param string $senderAddress
     * @param string $senderCountry
     * @param string $senderName
     * @param string $senderBic
     * @param string $senderIban
     * @param string $senderAccountNumber
     * @param string $senderRoutingCode
     */
    public function __construct($senderId, $senderAddress, $senderCountry, $senderName, $senderBic, $senderIban, $senderAccountNumber, $senderRoutingCode)
    {
        $this->senderId = $senderId;
        $this->senderAddress = $senderAddress;
        $this->senderCountry = $senderCountry;
        $this->senderName = $senderName;
        $this->senderBic = $senderBic;
        $this->senderIban = $senderIban;
        $this->senderAccountNumber = $senderAccountNumber;
        $this->senderRoutingCode = $senderRoutingCode;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->senderId;
    }

    /**
     * @return string
     */
    public function getSenderId()
    {
        return $this->senderId;
    }

    /**
     * @return string
     */
    public function getSenderAddress()
    {
        return $this->senderAddress;
    }

    /**
     * @return string
     */
    public function getSenderCountry()
    {
        return $this->senderCountry;
    }

    /**
     * @return string
     */
    public function getSenderName()
    {
        return $this->senderName;
    }

    /**
     * @return string
     */
    public function getSenderBic()
    {
        return $this->senderBic;
    }

    /**
     * @return string
     */
    public function getSenderIn()
    {
        return $this->senderIban;
    }

    /**
     * @return string
     */
    public function getSenderAccountNumber()
    {
        return $this->senderAccountNumber;
    }

    /**
     * @return string
     */
    public function getSenderRoutingCode()
    {
        return $this->senderRoutingCode;
    }
}