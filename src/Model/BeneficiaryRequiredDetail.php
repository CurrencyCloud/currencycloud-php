<?php

namespace CurrencyCloud\Model;

use ArrayObject;

class BeneficiaryRequiredDetail extends ArrayObject
{

    /**
     * @param array $response
     * @return BeneficiaryRequiredDetail
     */
    public static function createFromResponse($response)
    {
        return new BeneficiaryRequiredDetail((array) $response);
    }
}
