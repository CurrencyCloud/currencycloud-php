<?php

namespace CurrencyCloud\Model;

use DateTime;

class Conversion
{

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
    private $creatorContactId;
    /**
     * @var string
     */
    private $shortReference;
    /**
     * @var DateTime
     */
    private $settlementDate;

    /**
     * @var DateTime
     */
    private $conversionDate;

    /**
     * @var string
     */
    private $status;
    /**
     * @var string
     */
    private $partnerStatus;
    /**
     * @var string
     */
    private $currencyPair;
    /**
     * @var string
     */
    private $buyCurrency;
    /**
     * @var string
     */
    private $sellCurrency;
    /**
     * @var string
     */
    private $fixedSide;
    /**
     * @var string
     */
    private $partnerBuyAmount;
    /**
     * @var string
     */
    private $partnerSellAmount;
    /**
     * @var string
     */
    private $clientBuyAmount;
    /**
     * @var string
     */
    private $clientSellAmount;
    /**
     * @var string
     */
    private $midMarketRate;
    /**
     * @var string
     */
    private $coreRate;
    /**
     * @var string
     */
    private $partnerRate;
    /**
     * @var string
     */
    private $clientRate;
    /**
     * @var string
     */
    private $depositRequired;
    /**
     * @var string
     */
    private $depositAmount;
    /**
     * @var string
     */
    private $depositCurrency;
    /**
     * @var string
     */
    private $depositStatus;
    /**
     * @var DateTime
     */
    private $depositRequiredAt;
    /**
     * @var array
     */
    private $paymentIds;
    /**
     * @var DateTime
     */
    private $createdAt;
    /**
     * @var DateTime
     */
    private $updatedAt;
    /**
     * @var String
     */
    private $uniqueRequestId;

    /**
     * @param string $buyCurrency
     * @param string $sellCurrency
     * @param string $fixedSide
     *
     * @return Conversion
     */
    public static function create($buyCurrency, $sellCurrency, $fixedSide)
    {
        return (new Conversion())
            ->setBuyCurrency($buyCurrency)
            ->setSellCurrency($sellCurrency)
            ->setFixedSide($fixedSide);
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
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     *
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
    public function getCreatorContactId()
    {
        return $this->creatorContactId;
    }

    /**
     * @param string $creatorContactId
     *
     * @return $this
     */
    public function setCreatorContactId($creatorContactId)
    {
        $this->creatorContactId = $creatorContactId;
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
        $this->shortReference = $shortReference;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getSettlementDate()
    {
        return $this->settlementDate;
    }

    /**
     * @param DateTime $settlementDate
     *
     * @return $this
     */
    public function setSettlementDate($settlementDate)
    {
        $this->settlementDate = $settlementDate;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getConversionDate()
    {
        return $this->conversionDate;
    }

    /**
     * @param DateTime $conversionDate
     *
     * @return $this
     */
    public function setConversionDate($conversionDate)
    {
        $this->conversionDate = $conversionDate;
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
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getPartnerStatus()
    {
        return $this->partnerStatus;
    }

    /**
     * @param string $partnerStatus
     *
     * @return $this
     */
    public function setPartnerStatus($partnerStatus)
    {
        $this->partnerStatus = $partnerStatus;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrencyPair()
    {
        return $this->currencyPair;
    }

    /**
     * @param string $currencyPair
     *
     * @return $this
     */
    public function setCurrencyPair($currencyPair)
    {
        $this->currencyPair = $currencyPair;
        return $this;
    }

    /**
     * @return string
     */
    public function getBuyCurrency()
    {
        return $this->buyCurrency;
    }

    /**
     * @param string $buyCurrency
     *
     * @return $this
     */
    public function setBuyCurrency($buyCurrency)
    {
        $this->buyCurrency = $buyCurrency;
        return $this;
    }

    /**
     * @return string
     */
    public function getSellCurrency()
    {
        return $this->sellCurrency;
    }

    /**
     * @param string $sellCurrency
     *
     * @return $this
     */
    public function setSellCurrency($sellCurrency)
    {
        $this->sellCurrency = $sellCurrency;
        return $this;
    }

    /**
     * @return string
     */
    public function getFixedSide()
    {
        return $this->fixedSide;
    }

    /**
     * @param string $fixedSide
     *
     * @return $this
     */
    public function setFixedSide($fixedSide)
    {
        $this->fixedSide = $fixedSide;
        return $this;
    }

    /**
     * @return string
     */
    public function getPartnerBuyAmount()
    {
        return $this->partnerBuyAmount;
    }

    /**
     * @param string $partnerBuyAmount
     *
     * @return $this
     */
    public function setPartnerBuyAmount($partnerBuyAmount)
    {
        $this->partnerBuyAmount = $partnerBuyAmount;
        return $this;
    }

    /**
     * @return string
     */
    public function getPartnerSellAmount()
    {
        return $this->partnerSellAmount;
    }

    /**
     * @param string $partnerSellAmount
     *
     * @return $this
     */
    public function setPartnerSellAmount($partnerSellAmount)
    {
        $this->partnerSellAmount = $partnerSellAmount;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientBuyAmount()
    {
        return $this->clientBuyAmount;
    }

    /**
     * @param string $clientBuyAmount
     *
     * @return $this
     */
    public function setClientBuyAmount($clientBuyAmount)
    {
        $this->clientBuyAmount = $clientBuyAmount;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientSellAmount()
    {
        return $this->clientSellAmount;
    }

    /**
     * @param string $clientSellAmount
     *
     * @return $this
     */
    public function setClientSellAmount($clientSellAmount)
    {
        $this->clientSellAmount = $clientSellAmount;
        return $this;
    }

    /**
     * @return string
     */
    public function getMidMarketRate()
    {
        return $this->midMarketRate;
    }

    /**
     * @param string $midMarketRate
     *
     * @return $this
     */
    public function setMidMarketRate($midMarketRate)
    {
        $this->midMarketRate = $midMarketRate;
        return $this;
    }

    /**
     * @return string
     */
    public function getPartnerRate()
    {
        return $this->partnerRate;
    }

    /**
     * @param string $partnerRate
     *
     * @return $this
     */
    public function setPartnerRate($partnerRate)
    {
        $this->partnerRate = $partnerRate;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientRate()
    {
        return $this->clientRate;
    }

    /**
     * @param string $clientRate
     *
     * @return $this
     */
    public function setClientRate($clientRate)
    {
        $this->clientRate = $clientRate;
        return $this;
    }

    /**
     * @return string
     */
    public function getDepositRequired()
    {
        return $this->depositRequired;
    }

    /**
     * @param string $depositRequired
     *
     * @return $this
     */
    public function setDepositRequired($depositRequired)
    {
        $this->depositRequired = $depositRequired;
        return $this;
    }

    /**
     * @return string
     */
    public function getDepositAmount()
    {
        return $this->depositAmount;
    }

    /**
     * @param string $depositAmount
     *
     * @return $this
     */
    public function setDepositAmount($depositAmount)
    {
        $this->depositAmount = $depositAmount;
        return $this;
    }

    /**
     * @return string
     */
    public function getDepositCurrency()
    {
        return $this->depositCurrency;
    }

    /**
     * @param string $depositCurrency
     *
     * @return $this
     */
    public function setDepositCurrency($depositCurrency)
    {
        $this->depositCurrency = $depositCurrency;
        return $this;
    }

    /**
     * @return string
     */
    public function getDepositStatus()
    {
        return $this->depositStatus;
    }

    /**
     * @param string $depositStatus
     *
     * @return $this
     */
    public function setDepositStatus($depositStatus)
    {
        $this->depositStatus = $depositStatus;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDepositRequiredAt()
    {
        return $this->depositRequiredAt;
    }

    /**
     * @param DateTime $depositRequiredAt
     *
     * @return $this
     */
    public function setDepositRequiredAt($depositRequiredAt)
    {
        $this->depositRequiredAt = $depositRequiredAt;
        return $this;
    }

    /**
     * @return array
     */
    public function getPaymentIds()
    {
        return $this->paymentIds;
    }

    /**
     * @param array $paymentIds
     *
     * @return $this
     */
    public function setPaymentIds($paymentIds)
    {
        $this->paymentIds = $paymentIds;
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
     *
     * @return $this
     */
    public function setCreatedAt($createdAt)
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
     *
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getCoreRate()
    {
        return $this->coreRate;
    }

    /**
     * @param string $coreRate
     *
     * @return $this
     */
    public function setCoreRate($coreRate)
    {
        $this->coreRate = $coreRate;
        return $this;
    }

    /**
     * @return string
     */
    public function getUniqueRequestId()
    {
        return $this->uniqueRequestId;
    }

    /**
     * @param string $uniqueRequestId
     *
     * @return $this
     */
    public function setUniqueRequestId($uniqueRequestId)
    {
        $this->uniqueRequestId = $uniqueRequestId;
        return $this;
    }
}
