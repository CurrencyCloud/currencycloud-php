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
     * @param string $bidRate
     * @param string $offerRate
     */
    public function __construct($bidRate, $offerRate)
    {
        $this->bidRate = (string) $bidRate;
        $this->offerRate = (string) $offerRate;
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
