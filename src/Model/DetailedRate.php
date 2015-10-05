<?php

namespace CurrencyCloud\Model;

use DateTime;

class DetailedRate
{

    /**
     * @var DateTime
     */
    private $settlementCutOffTime;
    /**
     * @var string
     */
    private $currencyPair;
    /**
     * @var string
     */
    private $clientBuyCurrency;
    /**
     * @var string
     */
    private $clientSellCurrency;
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
    private $fixedSide;
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
     * @param DateTime $settlementCutOffTime
     * @param string $currencyPair
     * @param string $clientBuyCurrency
     * @param string $clientSellCurrency
     * @param string $clientBuyAmount
     * @param string $clientSellAmount
     * @param string $fixedSide
     * @param string $midMarketRate
     * @param string $coreRate
     * @param string $partnerRate
     * @param string $clientRate
     * @param string $depositRequired
     * @param string $depositAmount
     * @param string $depositCurrency
     */
    public function __construct(
        DateTime $settlementCutOffTime,
        $currencyPair,
        $clientBuyCurrency,
        $clientSellCurrency,
        $clientBuyAmount,
        $clientSellAmount,
        $fixedSide,
        $midMarketRate,
        $coreRate,
        $partnerRate,
        $clientRate,
        $depositRequired,
        $depositAmount,
        $depositCurrency
    ) {
        $this->settlementCutOffTime = $settlementCutOffTime;
        $this->currencyPair = (string) $currencyPair;
        $this->clientBuyCurrency = (string) $clientBuyCurrency;
        $this->clientSellCurrency = (string) $clientSellCurrency;
        $this->clientBuyAmount = (string) $clientBuyAmount;
        $this->clientSellAmount = (string) $clientSellAmount;
        $this->fixedSide = (string) $fixedSide;
        $this->midMarketRate = (string) $midMarketRate;
        $this->coreRate = (string) $coreRate;
        $this->partnerRate = (string) $partnerRate;
        $this->clientRate = (string) $clientRate;
        $this->depositRequired = (string) $depositRequired;
        $this->depositAmount = (string) $depositAmount;
        $this->depositCurrency = (string) $depositCurrency;
    }

    /**
     * @return DateTime
     */
    public function getSettlementCutOffTime()
    {
        return $this->settlementCutOffTime;
    }

    /**
     * @return string
     */
    public function getCurrencyPair()
    {
        return $this->currencyPair;
    }

    /**
     * @return string
     */
    public function getClientBuyCurrency()
    {
        return $this->clientBuyCurrency;
    }

    /**
     * @return string
     */
    public function getClientSellCurrency()
    {
        return $this->clientSellCurrency;
    }

    /**
     * @return string
     */
    public function getClientBuyAmount()
    {
        return $this->clientBuyAmount;
    }

    /**
     * @return string
     */
    public function getClientSellAmount()
    {
        return $this->clientSellAmount;
    }

    /**
     * @return string
     */
    public function getFixedSide()
    {
        return $this->fixedSide;
    }

    /**
     * @return string
     */
    public function getMidMarketRate()
    {
        return $this->midMarketRate;
    }

    /**
     * @return string
     */
    public function getCoreRate()
    {
        return $this->coreRate;
    }

    /**
     * @return string
     */
    public function getPartnerRate()
    {
        return $this->partnerRate;
    }

    /**
     * @return string
     */
    public function getClientRate()
    {
        return $this->clientRate;
    }

    /**
     * @return string
     */
    public function getDepositRequired()
    {
        return $this->depositRequired;
    }

    /**
     * @return string
     */
    public function getDepositAmount()
    {
        return $this->depositAmount;
    }

    /**
     * @return string
     */
    public function getDepositCurrency()
    {
        return $this->depositCurrency;
    }
}
