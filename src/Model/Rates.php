<?php

namespace CurrencyCloud\Model;

use OutOfBoundsException;

class Rates
{

    /**
     * @var Rate[]
     */
    private $rates;
    /**
     * @var array
     */
    private $unavailable;

    /**
     * @param Rate[] $rates
     * @param array $unavailable
     */
    public function __construct(array $rates, $unavailable = [])
    {
        $this->rates = $rates;
        //For faster search
        $this->unavailable = array_combine($unavailable, $unavailable);
    }

    /**
     * @return Rate[]
     */
    public function getRates()
    {
        return $this->rates;
    }

    /**
     * @return array
     */
    public function getUnavailable()
    {
        return $this->unavailable;
    }

    /**
     * @param string $pair
     *
     * @return bool
     */
    public function isRateUnavailable($pair)
    {
        return isset($this->unavailable[$pair]);
    }

    /**
     * @param string $pair
     *
     * @return Rate
     * @throws OutOfBoundsException
     */
    public function getRate($pair)
    {
        if (!$this->isAvailable($pair)) {
            throw new OutOfBoundsException(sprintf('Pair "%s" not found', $pair));
        }
        return $this->rates[$pair];
    }

    /**
     * @param string $pair
     *
     * @return bool
     */
    public function isAvailable($pair)
    {
        return isset($this->rates[$pair]);
    }
}
