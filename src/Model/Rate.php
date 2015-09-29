<?php

namespace CurrencyCloud\Model;

class Rate
{
    /**
     * @var string
     */
    private $bidRate;
    /**
     * @var string
     */
    private $offerRate;

    /**
     * @param double $bidRate
     * @param double $offerRate
     */
    public function __construct($bidRate, $offerRate)
    {
        $this->bidRate = (double) $bidRate;
        $this->offerRate = (double) $offerRate;
    }

    /**
     * @return string
     */
    public function getBidRate()
    {
        return $this->bidRate;
    }

    /**
     * @return string
     */
    public function getOfferRate()
    {
        return $this->offerRate;
    }
}
