<?php

namespace CurrencyCloud\Tests\VCR\Actions;

use CurrencyCloud\Model\Beneficiary;
use CurrencyCloud\Model\Pagination;
use CurrencyCloud\Tests\BaseCurrencyCloudVCRTestCase;

class Test extends BaseCurrencyCloudVCRTestCase
{

    /**
     * @vcr Actions/can_first.yaml
     * @test
     */
    public function canFirst()
    {
        $beneficiaries =
            $this->getAuthenticatedClient()
                ->beneficiaries()
                ->find(
                    (new Beneficiary())->setBankAccountHolderName('Test User'),
                    (new Pagination())->setPerPage(1)
                );

        $dummy = json_decode(
            '{"beneficiaries":[{"id":"081596c9-02de-483e-9f2a-4cf55dcdf98c","bank_account_holder_name":"Test User","name":"Test+User","email":null,"payment_types":["regular"],"beneficiary_address":[],"beneficiary_country":null,"beneficiary_entity_type":null,"beneficiary_company_name":null,"beneficiary_first_name":null,"beneficiary_last_name":null,"beneficiary_city":null,"beneficiary_postcode":null,"beneficiary_state_or_province":null,"beneficiary_date_of_birth":null,"beneficiary_identification_type":null,"beneficiary_identification_value":null,"bank_country":"GB","bank_name":"HSBC BANK PLC","bank_account_type":null,"currency":"GBP","account_number":"41854372","routing_code_type_1":"sort_code","routing_code_value_1":"400730","routing_code_type_2":null,"routing_code_value_2":null,"bic_swift":null,"iban":null,"default_beneficiary":"false","creator_contact_id":"c4d838e8-1625-44c6-a9fb-39bcb1fe353d","bank_address":["5 Wimbledon Hill Rd","Wimbledon","London"],"beneficiary_external_reference":null,"created_at":"2015-04-25T09:21:00+00:00","updated_at":"2015-04-25T10:58:21+00:00"}],"pagination":{"total_entries":1,"total_pages":1,"current_page":1,"per_page":1,"previous_page":-1,"next_page":-1,"order":"created_at","order_asc_desc":"asc"}}',
            true
        );

        foreach ($beneficiaries->getBeneficiaries() as $k => $beneficiary) {
            $this->validateObjectStrictName($beneficiary, $dummy['beneficiaries'][$k]);
        }
        $this->validateObjectStrictName($beneficiaries->getPagination(), $dummy['pagination']);
    }

    /**
     * @vcr Actions/can_find.yaml
     * @test
     */
    public function canFind()
    {
        $beneficiaries = $this->getAuthenticatedClient()
            ->beneficiaries()
            ->find();

        $dummy =
            json_decode(
                '{"beneficiaries":[{"id":"081596c9-02de-483e-9f2a-4cf55dcdf98c","bank_account_holder_name":"Test+User","name":"Test+User","email":null,"payment_types":["regular"],"beneficiary_address":[],"beneficiary_country":null,"beneficiary_entity_type":null,"beneficiary_company_name":null,"beneficiary_first_name":null,"beneficiary_last_name":null,"beneficiary_city":null,"beneficiary_postcode":null,"beneficiary_state_or_province":null,"beneficiary_date_of_birth":null,"beneficiary_identification_type":null,"beneficiary_identification_value":null,"bank_country":"GB","bank_name":"HSBC BANK PLC","bank_account_type":null,"currency":"GBP","account_number":"12345678","routing_code_type_1":"sort_code","routing_code_value_1":"123456","routing_code_type_2":null,"routing_code_value_2":null,"bic_swift":null,"iban":null,"default_beneficiary":"false","creator_contact_id":"c4d838e8-1625-44c6-a9fb-39bcb1fe353d","bank_address":["5 Wimbledon Hill Rd","Wimbledon","London"],"beneficiary_external_reference":null,"created_at":"2015-04-25T09:21:00+00:00","updated_at":"2015-04-25T09:21:00+00:00"}],"pagination":{"total_entries":1,"total_pages":1,"current_page":1,"per_page":25,"previous_page":-1,"next_page":-1,"order":"created_at","order_asc_desc":"asc"}}', true
            );

        foreach ($beneficiaries->getBeneficiaries() as $k => $beneficiary) {
            $this->validateObjectStrictName($beneficiary, $dummy['beneficiaries'][$k]);
        }
        $this->validateObjectStrictName($beneficiaries->getPagination(), $dummy['pagination']);
    }

    /**
     * @vcr Actions/can_retrieve.yaml
     * @test
     */
    public function canRetrieve()
    {
        $beneficiary = $this->getAuthenticatedClient()
            ->beneficiaries()
            ->retrieve('081596c9-02de-483e-9f2a-4cf55dcdf98c');

        $dummy =
            json_decode(
                '{"id":"081596c9-02de-483e-9f2a-4cf55dcdf98c","bank_account_holder_name":"Test User","name":"Test User","email":null,"payment_types":["regular"],"beneficiary_address":[],"beneficiary_country":null,"beneficiary_entity_type":null,"beneficiary_company_name":null,"beneficiary_first_name":null,"beneficiary_last_name":null,"beneficiary_city":null,"beneficiary_postcode":null,"beneficiary_state_or_province":null,"beneficiary_date_of_birth":null,"beneficiary_identification_type":null,"beneficiary_identification_value":null,"bank_country":"GB","bank_name":"HSBC BANK PLC","bank_account_type":null,"currency":"GBP","account_number":"41854372","routing_code_type_1":"sort_code","routing_code_value_1":"400730","routing_code_type_2":null,"routing_code_value_2":null,"bic_swift":null,"iban":null,"default_beneficiary":"false","creator_contact_id":"c4d838e8-1625-44c6-a9fb-39bcb1fe353d","bank_address":["5 Wimbledon Hill Rd","Wimbledon","London"],"beneficiary_external_reference":null,"created_at":"2015-04-25T09:21:00+00:00","updated_at":"2015-04-25T09:21:00+00:00"}', true
            );

        $this->validateObjectStrictName($beneficiary, $dummy);
    }

    /**
     * @vcr Actions/can_delete.yaml
     * @test
     */
    public function canDelete()
    {
        $beneficiary = $this->getAuthenticatedClient()
            ->beneficiaries()
            ->retrieve('081596c9-02de-483e-9f2a-4cf55dcdf98c');

        $dummy =
            json_decode(
                '{"id":"081596c9-02de-483e-9f2a-4cf55dcdf98c","bank_account_holder_name":"Test User 2","name":"Test+User","email":null,"payment_types":["regular"],"beneficiary_address":[],"beneficiary_country":null,"beneficiary_entity_type":null,"beneficiary_company_name":null,"beneficiary_first_name":null,"beneficiary_last_name":null,"beneficiary_city":null,"beneficiary_postcode":null,"beneficiary_state_or_province":null,"beneficiary_date_of_birth":null,"beneficiary_identification_type":null,"beneficiary_identification_value":null,"bank_country":"GB","bank_name":"HSBC BANK PLC","bank_account_type":null,"currency":"GBP","account_number":"41854372","routing_code_type_1":"sort_code","routing_code_value_1":"400730","routing_code_type_2":null,"routing_code_value_2":null,"bic_swift":null,"iban":null,"default_beneficiary":"false","creator_contact_id":"c4d838e8-1625-44c6-a9fb-39bcb1fe353d","bank_address":["5 Wimbledon Hill Rd","Wimbledon","London"],"beneficiary_external_reference":null,"created_at":"2015-04-25T09:21:00+00:00","updated_at":"2015-04-25T11:06:27+00:00"}', true
            );

        $this->validateObjectStrictName($beneficiary, $dummy);

        $this->getAuthenticatedClient()
            ->beneficiaries()->delete($beneficiary);

        $this->validateObjectStrictName($beneficiary, $dummy);

    }

    /**
     * @vcr Actions/can_create.yaml
     * @test
     */
    public function canCreate()
    {
        $beneficiary =
            Beneficiary::create('Test User', 'GB', 'GBP', 'Test User')
                ->setAccountNumber('12345678')
                ->setRoutingCodeType1('sort_code')
                ->setRoutingCodeValue1('123456')
                ->setPaymentTypes(['regular']);

        $beneficiary = $this->getAuthenticatedClient()
            ->beneficiaries()
            ->create($beneficiary);

        $dummy =
            json_decode(
                '{"id":"081596c9-02de-483e-9f2a-4cf55dcdf98c","bank_account_holder_name":"Test User","name":"Test User","email":null,"payment_types":["regular"],"beneficiary_address":[],"beneficiary_country":null,"beneficiary_entity_type":null,"beneficiary_company_name":null,"beneficiary_first_name":null,"beneficiary_last_name":null,"beneficiary_city":null,"beneficiary_postcode":null,"beneficiary_state_or_province":null,"beneficiary_date_of_birth":null,"beneficiary_identification_type":null,"beneficiary_identification_value":null,"bank_country":"GB","bank_name":"HSBC BANK PLC","bank_account_type":null,"currency":"GBP","account_number":"12345678","routing_code_type_1":"sort_code","routing_code_value_1":"123456","routing_code_type_2":null,"routing_code_value_2":null,"bic_swift":null,"iban":null,"default_beneficiary":"false","creator_contact_id":"c4d838e8-1625-44c6-a9fb-39bcb1fe353d","bank_address":["5 Wimbledon Hill Rd","Wimbledon","London"],"beneficiary_external_reference":null,"created_at":"2015-04-25T09:21:00+00:00","updated_at":"2015-04-25T09:21:00+00:00"}', true
            );

        $this->validateObjectStrictName($beneficiary, $dummy);
    }

    /**
     * @vcr Actions/can_validate_beneficiaries.yaml
     * @test
     */
    public function canValidateBeneficiaries()
    {
        $beneficiary =
            Beneficiary::createForValidate('GB', 'GBP', 'GB')
                ->setAccountNumber('12345678')
                ->setRoutingCodeType1('sort_code')
                ->setRoutingCodeValue1('123456')
                ->setPaymentTypes(['regular']);

        $beneficiary = $this->getAuthenticatedClient()
            ->beneficiaries()
            ->validate($beneficiary);

        $dummy =
            json_decode(
                '{"payment_types":["regular"],"bank_country":"GB","bank_name":"HSBC BANK PLC","bank_account_type":null,"currency":"GBP","account_number":"12345678","routing_code_type_1":"sort_code","beneficiary_address":[],"beneficiary_country":"GB","beneficiary_entity_type":null,"beneficiary_company_name":null,"beneficiary_first_name":null,"beneficiary_last_name":null,"beneficiary_city":null,"beneficiary_postcode":null,"beneficiary_state_or_province":null,"beneficiary_date_of_birth":null,"beneficiary_identification_type":null,"beneficiary_identification_value":null,"routing_code_value_1":"123456","routing_code_type_2":null,"routing_code_value_2":null,"bic_swift":null,"iban":null,"bank_address":["5 Wimbledon Hill Rd","Wimbledon","London"]}', true
            );

        $this->validateObjectStrictName($beneficiary, $dummy);
    }

    /**
     * @vcr Actions/can_update.yaml
     * @test
     */
    public function canUpdate()
    {
        $client = $this->getAuthenticatedClient();

        $beneficiary =
            $client
                ->beneficiaries()
                ->retrieve('081596c9-02de-483e-9f2a-4cf55dcdf98c');

        $dummy = json_decode(
            '{"id":"081596c9-02de-483e-9f2a-4cf55dcdf98c","bank_account_holder_name":"Test User","name":"Test+User","email":null,"payment_types":["regular"],"beneficiary_address":[],"beneficiary_country":null,"beneficiary_entity_type":null,"beneficiary_company_name":null,"beneficiary_first_name":null,"beneficiary_last_name":null,"beneficiary_city":null,"beneficiary_postcode":null,"beneficiary_state_or_province":null,"beneficiary_date_of_birth":null,"beneficiary_identification_type":null,"beneficiary_identification_value":null,"bank_country":"GB","bank_name":"HSBC BANK PLC","bank_account_type":null,"currency":"GBP","account_number":"41854372","routing_code_type_1":"sort_code","routing_code_value_1":"400730","routing_code_type_2":null,"routing_code_value_2":null,"bic_swift":null,"iban":null,"default_beneficiary":"false","creator_contact_id":"c4d838e8-1625-44c6-a9fb-39bcb1fe353d","bank_address":["5 Wimbledon Hill Rd","Wimbledon","London"],"beneficiary_external_reference":null,"created_at":"2015-04-25T09:21:00+00:00","updated_at":"2015-04-25T11:01:36+00:00"}',
            true
        );

        $this->validateObjectStrictName($beneficiary, $dummy);

        $beneficiary->setBankAccountHolderName('Test User 2');

        $beneficiary = $client->beneficiaries()->update($beneficiary);


        $dummy = json_decode(
            '{"id":"081596c9-02de-483e-9f2a-4cf55dcdf98c","bank_account_holder_name":"Test User 2","name":"Test+User","email":null,"payment_types":["regular"],"beneficiary_address":[],"beneficiary_country":null,"beneficiary_entity_type":null,"beneficiary_company_name":null,"beneficiary_first_name":null,"beneficiary_last_name":null,"beneficiary_city":null,"beneficiary_postcode":null,"beneficiary_state_or_province":null,"beneficiary_date_of_birth":null,"beneficiary_identification_type":null,"beneficiary_identification_value":null,"bank_country":"GB","bank_name":"HSBC BANK PLC","bank_account_type":null,"currency":"GBP","account_number":"41854372","routing_code_type_1":"sort_code","routing_code_value_1":"400730","routing_code_type_2":null,"routing_code_value_2":null,"bic_swift":null,"iban":null,"default_beneficiary":"false","creator_contact_id":"c4d838e8-1625-44c6-a9fb-39bcb1fe353d","bank_address":["5 Wimbledon Hill Rd","Wimbledon","London"],"beneficiary_external_reference":null,"created_at":"2015-04-25T09:21:00+00:00","updated_at":"2015-04-25T11:01:36+00:00"}',
            true
        );

        $this->validateObjectStrictName($beneficiary, $dummy);
    }

    /**
     * @vcr Actions/can_current.yaml
     * @test
     */
    public function canCurrent()
    {
        $account = $this->getAuthenticatedClient()
            ->accounts()->current();

        $dummy =
            json_decode(
                '{"id":"8ec3a69b-02d1-4f09-9a6b-6bd54a61b3a8","account_name":"Currency Cloud","brand":"currencycloud","your_reference":null,"status":"enabled","street":null,"city":null,"state_or_province":null,"country":null,"postal_code":null,"spread_table":"fxcg_rfx_default","legal_entity_type":null,"created_at":"2015-04-24T15:57:55+00:00","updated_at":"2015-04-24T15:57:55+00:00","identification_type":null,"identification_value":null,"short_reference":"150424-00002"}', true
            );

        $this->validateObjectStrictName($account, $dummy);
    }

    /**
     * @vcr Actions/can_use_currency_to_retrieve_balance.yaml
     * @test
     */
    public function canUseCurrencyToRetrieveBalance()
    {
        $balance = $this->getAuthenticatedClient()
            ->balances()->retrieve('GBP');

        $dummy =
            json_decode(
                '{"id":"5a998e06-3eb7-46d6-ba58-f749864159ce","account_id":"e7483671-5dc6-0132-e126-002219414986","currency":"GBP","amount":"999866.78","created_at":"2014-12-04T09:50:35+00:00","updated_at":"2015-03-23T14:33:37+00:00"}', true
            );

        $this->validateObjectStrictName($balance, $dummy);
    }
}
