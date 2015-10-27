<?php

namespace CurrencyCloud\Tests\VCR\Update;

use CurrencyCloud\Tests\BaseCurrencyCloudTestCase;

class Test extends BaseCurrencyCloudTestCase
{
    /**
     * @vcr Update/does_nothing_if_nothing_has_changed.yaml
     * @test
     */
    public function doesNothingIfNothingHasChanged()
    {
        $client = $this->getAuthenticatedClient();

        $beneficiary =
            $client->beneficiaries()->retrieve('081596c9-02de-483e-9f2a-4cf55dcdf98c');

        $dummy = json_decode(
            '{"id":"081596c9-02de-483e-9f2a-4cf55dcdf98c","bank_account_holder_name":"Test User","name":"Test User","email":null,"payment_types":["regular"],"beneficiary_address":[],"beneficiary_country":null,"beneficiary_entity_type":null,"beneficiary_company_name":null,"beneficiary_first_name":null,"beneficiary_last_name":null,"beneficiary_city":null,"beneficiary_postcode":null,"beneficiary_state_or_province":null,"beneficiary_date_of_birth":null,"beneficiary_identification_type":null,"beneficiary_identification_value":null,"bank_country":"GB","bank_name":"HSBC BANK PLC","bank_account_type":null,"currency":"GBP","account_number":"41854372","routing_code_type_1":"sort_code","routing_code_value_1":"400730","routing_code_type_2":null,"routing_code_value_2":null,"bic_swift":null,"iban":null,"default_beneficiary":"false","creator_contact_id":"c4d838e8-1625-44c6-a9fb-39bcb1fe353d","bank_address":null,"created_at":"2015-04-25T09:21:00+00:00","updated_at":"2015-04-25T09:21:00+00:00"}',
            true
        );

        $this->validateObjectStrictName($beneficiary, $dummy);

        $beneficiary = $client->beneficiaries()->update($beneficiary);

        $this->validateObjectStrictName($beneficiary, $dummy);
    }

    /**
     * @vcr Update/only_updates_changed_records.yaml
     * @test
     */
    public function onlyUpdatesChangedRecords()
    {
        $client = $this->getAuthenticatedClient();

        $beneficiary =
            $client->beneficiaries()->retrieve('081596c9-02de-483e-9f2a-4cf55dcdf98c');

        $dummy = json_decode(
            '{"id":"081596c9-02de-483e-9f2a-4cf55dcdf98c","bank_account_holder_name":"Test User","name":"Test User","email":null,"payment_types":["regular"],"beneficiary_address":[],"beneficiary_country":null,"beneficiary_entity_type":null,"beneficiary_company_name":null,"beneficiary_first_name":null,"beneficiary_last_name":null,"beneficiary_city":null,"beneficiary_postcode":null,"beneficiary_state_or_province":null,"beneficiary_date_of_birth":null,"beneficiary_identification_type":null,"beneficiary_identification_value":null,"bank_country":"GB","bank_name":"HSBC BANK PLC","bank_account_type":null,"currency":"GBP","account_number":"41854372","routing_code_type_1":"sort_code","routing_code_value_1":"400730","routing_code_type_2":null,"routing_code_value_2":null,"bic_swift":null,"iban":null,"default_beneficiary":"false","creator_contact_id":"c4d838e8-1625-44c6-a9fb-39bcb1fe353d","bank_address":null,"created_at":"2015-04-25T09:21:00+00:00","updated_at":"2015-04-25T09:21:00+00:00"}',
            true
        );

        $this->validateObjectStrictName($beneficiary, $dummy);

        $beneficiary->setBankAccountHolderName('Test User 2')
            ->setEmail('rjnienaber@gmail.com');

        $beneficiary = $client->beneficiaries()->update($beneficiary);

        $dummy = json_decode(
            '{"id":"081596c9-02de-483e-9f2a-4cf55dcdf98c","bank_account_holder_name":"Test User 2","name":"Test+User","email":"rjnienaber@gmail.com","payment_types":["regular"],"beneficiary_address":[],"beneficiary_country":null,"beneficiary_entity_type":null,"beneficiary_company_name":null,"beneficiary_first_name":null,"beneficiary_last_name":null,"beneficiary_city":null,"beneficiary_postcode":null,"beneficiary_state_or_province":null,"beneficiary_date_of_birth":null,"beneficiary_identification_type":null,"beneficiary_identification_value":null,"bank_country":"GB","bank_name":"HSBC BANK PLC","bank_account_type":null,"currency":"GBP","account_number":"41854372","routing_code_type_1":"sort_code","routing_code_value_1":"400730","routing_code_type_2":null,"routing_code_value_2":null,"bic_swift":null,"iban":null,"default_beneficiary":"false","creator_contact_id":"c4d838e8-1625-44c6-a9fb-39bcb1fe353d","bank_address":null,"created_at":"2015-04-25T09:21:00+00:00","updated_at":"2015-04-25T11:01:36+00:00"}',
            true
        );

        $this->validateObjectStrictName($beneficiary, $dummy);
    }
}
