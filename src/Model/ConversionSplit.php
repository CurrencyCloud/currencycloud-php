<?php

namespace CurrencyCloud\Model;

use DateTime;
use CurrencyCloud\Model\Conversion;

class ConversionSplit
{

    /**
     * @var Conversion
     */
    private $parent_conversion;

    /**
     * @var Conversion
     */
    private $child_conversion;


    /**
     * @return \CurrencyCloud\Model\Conversion
     */
    public function getParentConversion()
    {
        return $this->parent_conversion;
    }

    /**
     * @param \CurrencyCloud\Model\Conversion $parent_conversion
     * @return ConversionSplit
     */
    public function setParentConversion($parent_conversion)
    {
        $this->parent_conversion = $parent_conversion;
        return $this;
    }

    /**
     * @return \CurrencyCloud\Model\Conversion
     */
    public function getChildConversion()
    {
        return $this->child_conversion;
    }

    /**
     * @param \CurrencyCloud\Model\Conversion $child_conversion
     * @return ConversionSplit
     */
    public function setChildConversion($child_conversion)
    {
        $this->child_conversion = $child_conversion;
        return $this;
    }

}
