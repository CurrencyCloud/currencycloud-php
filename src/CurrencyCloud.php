<?php

namespace CurrencyCloud;

use CurrencyCloud\EntryPoint\ReferenceEntryPoint;

class CurrencyCloud
{
    /**
     * @var ReferenceEntryPoint
     */
    private $referenceEntryPoint;

    /**
     * @param ReferenceEntryPoint $referenceEntryPoint
     */
    public function __construct(
        ReferenceEntryPoint $referenceEntryPoint
    ) {
        $this->referenceEntryPoint = $referenceEntryPoint;
    }

    /**
     * @return ReferenceEntryPoint
     */
    public function reference()
    {
        return $this->referenceEntryPoint;
    }
}
