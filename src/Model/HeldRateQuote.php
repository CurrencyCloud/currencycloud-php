<?php

namespace CurrencyCloud\Model;

use DateTime;

class HeldRateQuote
{

    /**
     * @var string
     */
    private $buyCurrency;
    /**
     * @var string
     */
    private $clientBuyAmount;
    /**
     * @var string
     */
    private $clientRate;
    /**
     * @var string
     */
    private $clientSellAmount;
    /**
     * @var string
     */
    private $coreRate;
    /**
     * @var DateTime
     */
    private $createdAt;
    /**
     * @var string
     */
    private $currencyPair;
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
    private $depositRequired;
    /**
     * @var DateTime
     */
    private $expiresAt;
    /**
     * @var string
     */
    private $fixedSide;
    /**
     * @var string
     */
    private $midMarketRate;
    /**
     * @var string
     */
    private $partnerBuyAmount;
    /**
     * @var string
     */
    private $partnerRate;
    /**
     * @var string
     */
    private $partnerSellAmount;
    /**
     * @var string
     */
    private $quoteId;
    /**
     * @var string
     */
    private $sellCurrency;
    /**
     * @var DateTime
     */
    private $settlementCutOffTime;

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
     * @return DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @param DateTime $expiresAt
     *
     * @return $this
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;
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
    public function getQuoteId()
    {
        return $this->quoteId;
    }

    /**
     * @param string $quoteId
     *
     * @return $this
     */
    public function setQuoteId($quoteId)
    {
        $this->quoteId = $quoteId;
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
     * @return DateTime
     */
    public function getSettlementCutOffTime()
    {
        return $this->settlementCutOffTime;
    }

    /**
     * @param DateTime $settlementCutOffTime
     *
     * @return $this
     */
    public function setSettlementCutOffTime($settlementCutOffTime)
    {
        $this->settlementCutOffTime = $settlementCutOffTime;
        return $this;
    }
}
