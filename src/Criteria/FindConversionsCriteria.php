<?php

namespace CurrencyCloud\Criteria;

use DateTime;

class FindConversionsCriteria
{

    /**
     * @var string|null
     */
    private $shortReference;
    /**
     * @var string|null
     */
    private $status;
    /**
     * @var string|null
     */
    private $parentStatus;
    /**
     * @var string|null
     */
    private $buyCurrency;
    /**
     * @var string|null
     */
    private $sellCurrency;
    /**
     * @var array|null
     */
    private $conversionIds;
    /**
     * @var DateTime|null
     */
    private $createdAtFrom;
    /**
     * @var DateTime|null
     */
    private $createdAtTo;
    /**
     * @var DateTime|null
     */
    private $updatedAtFrom;
    /**
     * @var DateTime|null
     */
    private $updatedAtTo;
    /**
     * @var string|null
     */
    private $currencyPair;
    /**
     * @var string|null
     */
    private $partnerBuyAmountFrom;
    /**
     * @var string|null
     */
    private $partnerBuyAmountTo;
    /**
     * @var string|null
     */
    private $partnerSellAmountFrom;
    /**
     * @var string|null
     */
    private $partnerSellAmountTo;
    /**
     * @var string|null
     */
    private $buyAmountFrom;
    /**
     * @var string|null
     */
    private $buyAmountTo;
    /**
     * @var string|null
     */
    private $sellAmountFrom;
    /**
     * @var string|null
     */
    private $sellAmountTo;
    /**
     * @var string|null
     */
    private $uniqueRequestId;

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
     * @param string $parentStatus
     *
     * @return $this
     */
    public function setParentStatus($parentStatus)
    {
        $this->parentStatus = $parentStatus;
        return $this;
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
     * @param array $conversionIds
     *
     * @return $this
     */
    public function setConversionIds(array $conversionIds)
    {
        $this->conversionIds = $conversionIds;
        return $this;
    }

    /**
     * @param DateTime $createdAtFrom
     *
     * @return $this
     */
    public function setCreatedAtFrom(DateTime $createdAtFrom)
    {
        $this->createdAtFrom = $createdAtFrom;
        return $this;
    }

    /**
     * @param DateTime $createdAtTo
     *
     * @return $this
     */
    public function setCreatedAtTo(DateTime $createdAtTo)
    {
        $this->createdAtTo = $createdAtTo;
        return $this;
    }

    /**
     * @param DateTime $updatedAtFrom
     *
     * @return $this
     */
    public function setUpdatedAtFrom(DateTime $updatedAtFrom)
    {
        $this->updatedAtFrom = $updatedAtFrom;
        return $this;
    }

    /**
     * @param DateTime $updatedAtTo
     *
     * @return $this
     */
    public function setUpdatedAtTo(DateTime $updatedAtTo)
    {
        $this->updatedAtTo = $updatedAtTo;
        return $this;
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
     * @param string $partnerBuyAmountFrom
     *
     * @return $this
     */
    public function setPartnerBuyAmountFrom($partnerBuyAmountFrom)
    {
        $this->partnerBuyAmountFrom = $partnerBuyAmountFrom;
        return $this;
    }

    /**
     * @param string $partnerBuyAmountTo
     *
     * @return $this
     */
    public function setPartnerBuyAmountTo($partnerBuyAmountTo)
    {
        $this->partnerBuyAmountTo = $partnerBuyAmountTo;
        return $this;
    }

    /**
     * @param string $partnerSellAmountFrom
     *
     * @return $this
     */
    public function setPartnerSellAmountFrom($partnerSellAmountFrom)
    {
        $this->partnerSellAmountFrom = $partnerSellAmountFrom;
        return $this;
    }

    /**
     * @param string $partnerSellAmountTo
     *
     * @return $this
     */
    public function setPartnerSellAmountTo($partnerSellAmountTo)
    {
        $this->partnerSellAmountTo = $partnerSellAmountTo;
        return $this;
    }

    /**
     * @param string $buyAmountFrom
     *
     * @return $this
     */
    public function setBuyAmountFrom($buyAmountFrom)
    {
        $this->buyAmountFrom = $buyAmountFrom;
        return $this;
    }

    /**
     * @param string $buyAmountTo
     *
     * @return $this
     */
    public function setBuyAmountTo($buyAmountTo)
    {
        $this->buyAmountTo = $buyAmountTo;
        return $this;
    }

    /**
     * @param string $sellAmountFrom
     *
     * @return $this
     */
    public function setSellAmountFrom($sellAmountFrom)
    {
        $this->sellAmountFrom = $sellAmountFrom;
        return $this;
    }

    /**
     * @param string $sellAmountTo
     *
     * @return $this
     */
    public function setSellAmountTo($sellAmountTo)
    {
        $this->sellAmountTo = $sellAmountTo;
        return $this;
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

    /**
     * @return null|string
     */
    public function getShortReference()
    {
        return $this->shortReference;
    }

    /**
     * @return null|string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return null|string
     */
    public function getParentStatus()
    {
        return $this->parentStatus;
    }

    /**
     * @return null|string
     */
    public function getBuyCurrency()
    {
        return $this->buyCurrency;
    }

    /**
     * @return null|string
     */
    public function getSellCurrency()
    {
        return $this->sellCurrency;
    }

    /**
     * @return array|null
     */
    public function getConversionIds()
    {
        return $this->conversionIds;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAtFrom()
    {
        return $this->createdAtFrom;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAtTo()
    {
        return $this->createdAtTo;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAtFrom()
    {
        return $this->updatedAtFrom;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAtTo()
    {
        return $this->updatedAtTo;
    }

    /**
     * @return null|string
     */
    public function getCurrencyPair()
    {
        return $this->currencyPair;
    }

    /**
     * @return null|string
     */
    public function getPartnerBuyAmountFrom()
    {
        return $this->partnerBuyAmountFrom;
    }

    /**
     * @return null|string
     */
    public function getPartnerBuyAmountTo()
    {
        return $this->partnerBuyAmountTo;
    }

    /**
     * @return null|string
     */
    public function getPartnerSellAmountFrom()
    {
        return $this->partnerSellAmountFrom;
    }

    /**
     * @return null|string
     */
    public function getPartnerSellAmountTo()
    {
        return $this->partnerSellAmountTo;
    }

    /**
     * @return null|string
     */
    public function getBuyAmountFrom()
    {
        return $this->buyAmountFrom;
    }

    /**
     * @return null|string
     */
    public function getBuyAmountTo()
    {
        return $this->buyAmountTo;
    }

    /**
     * @return null|string
     */
    public function getSellAmountFrom()
    {
        return $this->sellAmountFrom;
    }

    /**
     * @return null|string
     */
    public function getSellAmountTo()
    {
        return $this->sellAmountTo;
    }

    /**
     * @return null|string
     */
    public function getUniqueRequestId()
    {
        return $this->uniqueRequestId;
    }
}
