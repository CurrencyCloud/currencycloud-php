<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\Beneficiary;
use CurrencyCloud\Model\BeneficiaryValidate;
use DateTime;
use stdClass;

class BeneficiariesEntryPoint extends AbstractEntryPoint
{

    /**
     * @param string $bankCountry
     * @param string $currency
     * @param string $beneficiaryCountry
     * @param string|null $accountNumber
     * @param string|null $routingCodeType1
     * @param string|null $routingCodeValue1
     * @param string|null $routingCodeType2
     * @param string|null $routingCodeValue2
     * @param string|null $bicSwift
     * @param string|null $iban
     * @param string|null $bankAddress
     * @param string|null $bankName
     * @param string|null $bankAccountType
     * @param string|null $beneficiaryEntityType
     * @param string|null $beneficiaryCompanyName
     * @param string|null $beneficiaryFirstName
     * @param string|null $beneficiaryLastName
     * @param string|null $beneficiaryCity
     * @param string|null $beneficiaryPostCode
     * @param string|null $beneficiaryStateOrProvince
     * @param DateTime|null $beneficiaryDateOfBirth
     * @param string|null $beneficiaryIdentificationType
     * @param string|null $beneficiaryIdentificationValue
     * @param array|null $paymentTypes
     * @param string|null $onBehalfOf
     * @return BeneficiaryValidate
     */
    public function validate(
        $bankCountry,
        $currency,
        $beneficiaryCountry,
        $accountNumber = null,
        $routingCodeType1 = null,
        $routingCodeValue1 = null,
        $routingCodeType2 = null,
        $routingCodeValue2 = null,
        $bicSwift = null,
        $iban = null,
        $bankAddress = null,
        $bankName = null,
        $bankAccountType = null,
        $beneficiaryEntityType = null,
        $beneficiaryCompanyName = null,
        $beneficiaryFirstName = null,
        $beneficiaryLastName = null,
        $beneficiaryCity = null,
        $beneficiaryPostCode = null,
        $beneficiaryStateOrProvince = null,
        DateTime $beneficiaryDateOfBirth = null,
        $beneficiaryIdentificationType = null,
        $beneficiaryIdentificationValue = null,
        array $paymentTypes = null,
        $onBehalfOf = null
    ) {
        $response = $this->request('POST', 'beneficiaries/validate', [], [
            'bank_country' => $bankCountry,
            'currency' => $currency,
            'beneficiary_country' => $beneficiaryCountry,
            'account_number' => $accountNumber,
            'routing_code_type_1' => $routingCodeType1,
            'routing_code_value_1' => $routingCodeValue1,
            'routing_code_type_2' => $routingCodeType2,
            'routing_code_value_2' => $routingCodeValue2,
            'bic_swift' => $bicSwift,
            'iban' => $iban,
            'bank_address' => $bankAddress,
            'bank_name' => $bankName,
            'bank_account_type' => $bankAccountType,
            'beneficiary_entity_type' => $beneficiaryEntityType,
            'beneficiary_company_name' => $beneficiaryCompanyName,
            'beneficiary_first_name' => $beneficiaryFirstName,
            'beneficiary_last_name' => $beneficiaryLastName,
            'beneficiary_city' => $beneficiaryCity,
            'beneficiary_postcode' => $beneficiaryPostCode,
            'beneficiary_state_or_province' => $beneficiaryStateOrProvince,
            'beneficiary_date_of_birth' => (null === $beneficiaryDateOfBirth) ? null : $beneficiaryDateOfBirth->format(
                DateTime::ISO8601
            ),
            'beneficiary_identification_type' => $beneficiaryIdentificationType,
            'beneficiary_identification_value' => $beneficiaryIdentificationValue,
            'payment_types' => $paymentTypes,
            'on_behalf_of' => $onBehalfOf
        ]);
        return $this->createBeneficiaryValidateFromResponse($response);
    }



    /**
     * @param stdClass $data
     * @return Beneficiary
     */
    protected function createBeneficiaryValidateFromResponse(stdClass $data)
    {
        return new BeneficiaryValidate(
            $data->payment_types,
            $data->bank_name,
            $data->bank_address,
            $data->beneficiary_country,
            $data->currency,
            $data->account_number,
            $data->iban,
            $data->bicSwift,
            $data->bank_account_type,
            $data->beneficiary_address,
            $data->beneficiary_country,
            $data->beneficiary_entity_type,
            $data->beneficiary_company_name,
            $data->beneficiary_first_name,
            $data->beneficiary_last_name,
            $data->beneficiary_city,
            $data->beneficiary_postcode,
            $data->beneficiary_state_or_province,
            $data->beneficiary_date_of_birth,
            $data->beneficiary_identification_type,
            $data->beneficiary_identification_value,
            $data->routing_code_value_1,
            $data->routing_code_value_1,
            $data->routing_code_type_2,
            $data->routing_code_value_2
        );
    }
}
