<?php
namespace CurrencyCloud\Model;

use DateTime;

class ConversionPreview {

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $shortReference;

    /**
     * @var string
     */
    private $sellAmount;

    /**
     * @var string
     */
    private $sellCurrency;

    /**
     * @var string
     */
    private $buyAmount;

    /**
     * @var string
     */
    private $buyCurrency;

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
     * ConversionPreview constructor.
     * @param string $id
     * @param string $shortReference
     * @param string $sellAmount
     * @param string $sellCurrency
     * @param string $buyAmount
     * @param string $buyCurrency
     * @param DateTime $settlementDate
     * @param DateTime $conversionDate
     * @param string $status
     */
    public function __construct($id, $shortReference, $sellAmount, $sellCurrency, $buyAmount, $buyCurrency, DateTime $settlementDate, DateTime $conversionDate, $status)
    {
        $this->id = $id;
        $this->shortReference = $shortReference;
        $this->sellAmount = $sellAmount;
        $this->sellCurrency = $sellCurrency;
        $this->buyAmount = $buyAmount;
        $this->buyCurrency = $buyCurrency;
        $this->settlementDate = $settlementDate;
        $this->conversionDate = $conversionDate;
        $this->status = $status;
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
    public function getShortReference()
    {
        return $this->shortReference;
    }

    /**
     * @return string
     */
    public function getSellAmount()
    {
        return $this->sellAmount;
    }

    /**
     * @return string
     */
    public function getSellCurrency()
    {
        return $this->sellCurrency;
    }

    /**
     * @return string
     */
    public function getBuyAmount()
    {
        return $this->buyAmount;
    }

    /**
     * @return string
     */
    public function getBuyCurrency()
    {
        return $this->buyCurrency;
    }

    /**
     * @return DateTime
     */
    public function getSettlementDate()
    {
        return $this->settlementDate;
    }

    /**
     * @return DateTime
     */
    public function getConversionDate()
    {
        return $this->conversionDate;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

}