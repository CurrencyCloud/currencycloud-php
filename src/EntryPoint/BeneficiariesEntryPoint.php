<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\Beneficiary;
use DateTime;
use stdClass;

class BeneficiariesEntryPoint extends AbstractEntryPoint
{

    /**
     * @param Beneficiary $beneficiary
     * @param null|string $onBehalfOf
     * @return Beneficiary
     */
    public function persist(Beneficiary $beneficiary, $onBehalfOf = null)
    {
        if (null === $beneficiary->getId()) {
            return $this->create($beneficiary, $onBehalfOf);
        }
        return $this->update($beneficiary, $onBehalfOf);
    }

    /**
     * @param Beneficiary $beneficiary
     * @param null|string $onBehalfOf
     * @return Beneficiary
     */
    public function validate(Beneficiary $beneficiary, $onBehalfOf = null)
    {
        $response = $this->request('POST', 'beneficiaries/validate', [], $this->convertBeneficiaryToRequest(
            $beneficiary,
            $onBehalfOf
        ));
        return $this->createBeneficiaryValidateFromResponse($response);
    }

    /**
     * @param Beneficiary $beneficiary
     * @param null|string $onBehalfOf
     * @return Beneficiary
     */
    public function create(Beneficiary $beneficiary, $onBehalfOf = null)
    {
        $response = $this->request('POST', 'beneficiaries/create', [], $this->convertBeneficiaryToRequest(
            $beneficiary,
            $onBehalfOf
        ));
        return $this->createBeneficiaryValidateFromResponse($response);
    }

    /**
     * @param string $id
     * @param null $onBehalfOf
     * @return Beneficiary
     */
    public function retrieve($id, $onBehalfOf = null)
    {
        $response = $this->request('POST', sprintf('beneficiaries/%s', $id), [], [
            'on_behalf_of' => $onBehalfOf
        ]);
        return $this->createBeneficiaryValidateFromResponse($response);
    }

    /**
     * @param Beneficiary $beneficiary
     * @param null $onBehalfOf
     * @return Beneficiary
     */
    public function update(Beneficiary $beneficiary, $onBehalfOf = null)
    {
        $response = $this->request('POST', sprintf(
            'beneficiaries/%s',
            $beneficiary->getId()
        ), [], $this->convertBeneficiaryToRequest($beneficiary, $onBehalfOf));
        return $this->createBeneficiaryValidateFromResponse($response);
    }

    /**
     * @param Beneficiary $beneficiary
     * @param string $onBehalfOf
     * @param bool $convertForValidate
     * @return array
     */
    protected function convertBeneficiaryToRequest(Beneficiary $beneficiary, $onBehalfOf, $convertForValidate = false)
    {
        $common = [
            'bank_country' => $beneficiary->getBankCountry(),
            'currency' => $beneficiary->getCurrency(),
            'beneficiary_country' => $beneficiary->getBeneficiaryCountry(),
            'account_number' => $beneficiary->getAccountNumber(),
            'routing_code_type_1' => $beneficiary->getRoutingCodeType1(),
            'routing_code_value_1' => $beneficiary->getRoutingCodeValue1(),
            'routing_code_type_2' => $beneficiary->getRoutingCodeType2(),
            'routing_code_value_2' => $beneficiary->getRoutingCodeValue2(),
            'bic_swift' => $beneficiary->getBicSwift(),
            'iban' => $beneficiary->getIban(),
            'bank_address' => $beneficiary->getBankAddress(),
            'bank_name' => $beneficiary->getBankName(),
            'bank_account_type' => $beneficiary->getBankAccountType(),
            'beneficiary_entity_type' => $beneficiary->getBeneficiaryEntityType(),
            'beneficiary_company_name' => $beneficiary->getBeneficiaryCompanyName(),
            'beneficiary_first_name' => $beneficiary->getBeneficiaryFirstName(),
            'beneficiary_last_name' => $beneficiary->getBeneficiaryLastName(),
            'beneficiary_city' => $beneficiary->getBeneficiaryCity(),
            'beneficiary_postcode' => $beneficiary->getBeneficiaryPostCode(),
            'beneficiary_state_or_province' => $beneficiary->getBeneficiaryStateOrProvince(),
            'beneficiary_date_of_birth' => (null === $beneficiary->getBeneficiaryDateOfBirth()) ?
                null : $beneficiary->getBeneficiaryDateOfBirth()->format(DateTime::ISO8601),
            'beneficiary_identification_type' => $beneficiary->getBeneficiaryIdentificationType(),
            'beneficiary_identification_value' => $beneficiary->getBeneficiaryIdentificationValue(),
            'payment_types' => $beneficiary->getPaymentTypes(),
            'on_behalf_of' => $onBehalfOf
        ];

        if ($convertForValidate) {
            return $common;
        }

        return $common + [
            'bank_account_holder_name' => $beneficiary->getBankAccountHolderName(),
            'name' => $beneficiary->getName(),
            'email' => $beneficiary->getEmail()
        ];
    }

    /**
     * @param stdClass $response
     * @return Beneficiary
     */
    private function createBeneficiaryValidateFromResponse(stdClass $response)
    {
        return new Beneficiary(
            $response->bank_country,
            $response->currency,
            $response->beneficiary_country,
            $response->payment_types,
            $response->bank_name,
            $response->bank_address,
            $response->account_number,
            $response->iban,
            $response->bicSwift,
            $response->bank_account_type,
            $response->beneficiary_address,
            $response->beneficiary_entity_type,
            $response->beneficiary_company_name,
            $response->beneficiary_first_name,
            $response->beneficiary_last_name,
            $response->beneficiary_city,
            $response->beneficiary_postcode,
            $response->beneficiary_state_or_province,
            $response->beneficiary_date_of_birth,
            $response->beneficiary_identification_type,
            $response->beneficiary_identification_value,
            $response->routing_code_value_1,
            $response->routing_code_value_1,
            $response->routing_code_type_2,
            $response->routing_code_value_2
        );
    }
}
