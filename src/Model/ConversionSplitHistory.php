<?php
namespace CurrencyCloud\Model;

class ConversionSplitHistory {

    /**
     * @var Conversion
     */
    private $parentConversion;
    /**
     * @var Conversion
     */
    private $originConversion;
    /**
     * @var Conversion[]
     */
    private $childConversions;

    /**
     * ConversionSplitHistory constructor.
     * @param Conversion $parentConversion
     * @param Conversion $originConversion
     * @param Conversion[] $childConversions
     */
    public function __construct($parentConversion, $originConversion, $childConversions)
    {
        $this->parentConversion = $parentConversion;
        $this->originConversion = $originConversion;
        $this->childConversions = $childConversions;
    }

    /**
     * @return Conversion
     */
    public function getParentConversion()
    {
        return $this->parentConversion;
    }

    /**
     * @return Conversion
     */
    public function getOriginConversion()
    {
        return $this->originConversion;
    }

    /**
     * @return Conversion
     */
    public function getChildConversions()
    {
        return $this->childConversions;
    }

}