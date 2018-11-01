<?php
namespace CurrencyCloud\Model;

class ConversionSplitPreview {

    /**
     * @var ConversionPreview
     */
    private $parentConversion;
    /**
     * @var ConversionPreview
     */
    private $childConversion;

    /**
     * ConversionSplitPreview constructor.
     * @param ConversionPreview $parentConversion
     * @param ConversionPreview $childConversion
     */
    public function __construct(ConversionPreview $parentConversion, ConversionPreview $childConversion)
    {
        $this->parentConversion = $parentConversion;
        $this->childConversion = $childConversion;
    }

    /**
     * @return ConversionPreview
     */
    public function getParentConversion()
    {
        return $this->parentConversion;
    }

    /**
     * @return ConversionPreview
     */
    public function getChildConversion()
    {
        return $this->childConversion;
    }

}