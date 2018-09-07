<?php

namespace CurrencyCloud\Model;

class PurposeCode
{
    /**
     * @var string
     */
    private $currency;
    /**
     * @var int
     */
    private $entityType;
    /**
     * @var string
     */
    private $purposeCode;
    /**
     * @var string
     */
    private $purposeDescription;

    /**
     * @param string $code
     * @param int $decimalPlaces
     * @param string $name
     */
    public function __construct($currency, $entityType, $purposeCode, $purposeDescription)
    {
        $this->currency = $currency;
        $this->entityType = $entityType;
        $this->purposeCode = $purposeCode;
        $this->purposeDescription = $purposeDescription;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return int
     */
    public function getEntityType()
    {
        return $this->entityType;
    }

    /**
     * @return string
     */
    public function getPurposeCode()
    {
        return $this->purposeCode;
    }

    /**
     * @return string
     */
    public function getPurposeDescription()
    {
        return $this->purposeDescription;
    }
}
