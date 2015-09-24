<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\BeneficiaryValidate;

class BeneficiariesEntryPoint extends AbstractEntryPoint
{

    /**
     * @param BeneficiaryValidate $beneficiaryValidate
     * @param null|string $onBehalfOf
     * @return BeneficiaryValidate
     */
    public function validate(
        BeneficiaryValidate $beneficiaryValidate,
        $onBehalfOf = null
    ) {
        $response = $this->request('POST', 'beneficiaries/validate', [], BeneficiaryValidate::toRequestArray(
            $beneficiaryValidate
        ) + ['onBehalfOf' => $onBehalfOf]);
        return BeneficiaryValidate::createFromResponse($response);
    }
}
