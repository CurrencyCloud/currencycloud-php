<?php

namespace CurrencyCloud\Tests\EntryPoint;


use CurrencyCloud\EntryPoint\BeneficiariesEntryPoint;

use CurrencyCloud\Model\Beneficiaries;
use CurrencyCloud\Model\Beneficiary;

use CurrencyCloud\SimpleEntityManager;
use CurrencyCloud\Tests\BaseCurrencyCloudTestCase;
use DateTime;

class BeneficiariesEntryPointTest extends BaseCurrencyCloudTestCase
{

    /**
     * @test
     */
    public function canCreateWithDefaultValues()
    {
        $data = '{"id": "f79ef1cd-de72-445c-9fc5-027810082bac","bank_account_holder_name": "My Test Account Holder","name": "My Test Beneficiary 610a7a00b693d","email": null,"payment_types": [    "regular"],"beneficiary_address": [],"beneficiary_country": null,"beneficiary_entity_type": null,"beneficiary_company_name": null,"beneficiary_first_name": null,"beneficiary_last_name": null,"beneficiary_city": null,"beneficiary_postcode": null,"beneficiary_state_or_province": null,"beneficiary_date_of_birth": null,"beneficiary_identification_type": null,"beneficiary_identification_value": null,"bank_country": "GB","bank_name": "TEST BANK NAME","bank_account_type": null,"currency": "GBP","account_number": "32847346","routing_code_type_1": "sort_code","routing_code_value_1": "101193","routing_code_type_2": null,"routing_code_value_2": null,"bic_swift": null,"iban": null,"default_beneficiary": "false","creator_contact_id": "a66ca63f-e668-47af-8bb9-74363240d781","bank_address": [    "TEST BANK ADDRESS",    " NOT USING EXTERNAL SERVICE",    " DEVELOPMENT ENVIRONMENT."],"created_at": "2021-08-04T11:29:20+00:00","updated_at": "2021-08-04T11:29:20+00:00","beneficiary_external_reference": null}';

        $beneficiary = Beneficiary::create('My Test Account Holder', 'GB', 'GBP', 'My Test Beneficiary 610a7a00b693d');

        $entryPoint = new BeneficiariesEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'POST',
            'beneficiaries/create',
            [],
            [
                'bank_country' => "GB",
                'currency' => 'GBP',
                'bank_account_holder_name' => 'My Test Account Holder',
                'name' => 'My Test Beneficiary 610a7a00b693d',
                'beneficiary_country' => null,
                'account_number' => null,
                'routing_code_type_1' => null,
                'routing_code_value_1' => null,
                'routing_code_type_2' => null,
                'routing_code_value_2' => null,
                'bic_swift' => null,
                'iban' => null,
                'bank_address' => null,
                'bank_name' => null,
                'default_beneficiary' => null,
                'bank_account_type' => null,
                'beneficiary_entity_type' => null,
                'beneficiary_company_name' => null,
                'beneficiary_address' => null,
                'beneficiary_first_name' => null,
                'beneficiary_last_name' => null,
                'beneficiary_city' => null,
                'beneficiary_postcode' => null,
                'beneficiary_state_or_province' => null,
                'beneficiary_date_of_birth' => null,
                'beneficiary_identification_type' => null,
                'beneficiary_identification_value' => null,
                'payment_types' => null,
                'email' => null,
                'beneficiary_external_reference' => null,
                'creator_contact_id' => null,
                'on_behalf_of' => null
            ]
        ));

        $item = $entryPoint->create($beneficiary);

        $this->validateObjectStrictName($item, json_decode($data, true));
    }

    /**
     * @test
     */
    public function canCreateWithOnBehalfOf()
    {
        $data = '{"id": "f79ef1cd-de72-445c-9fc5-027810082bac","bank_account_holder_name": "My Test Account Holder","name": "My Test Beneficiary 610a7a00b693d","email": null,"payment_types": [    "regular"],"beneficiary_address": [],"beneficiary_country": null,"beneficiary_entity_type": null,"beneficiary_company_name": null,"beneficiary_first_name": null,"beneficiary_last_name": null,"beneficiary_city": null,"beneficiary_postcode": null,"beneficiary_state_or_province": null,"beneficiary_date_of_birth": null,"beneficiary_identification_type": null,"beneficiary_identification_value": null,"bank_country": "GB","bank_name": "TEST BANK NAME","bank_account_type": null,"currency": "GBP","account_number": "32847346","routing_code_type_1": "sort_code","routing_code_value_1": "101193","routing_code_type_2": null,"routing_code_value_2": null,"bic_swift": null,"iban": null,"default_beneficiary": "false","creator_contact_id": "a66ca63f-e668-47af-8bb9-74363240d781","bank_address": [    "TEST BANK ADDRESS",    " NOT USING EXTERNAL SERVICE",    " DEVELOPMENT ENVIRONMENT."],"created_at": "2021-08-04T11:29:20+00:00","updated_at": "2021-08-04T11:29:20+00:00","beneficiary_external_reference": null}';

        $beneficiary = Beneficiary::create('My Test Account Holder', 'GB', 'GBP', 'My Test Beneficiary 610a7a00b693d');

        $entryPoint = new BeneficiariesEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'POST',
            'beneficiaries/create',
            [],
            [
                'bank_country' => "GB",
                'currency' => 'GBP',
                'bank_account_holder_name' => 'My Test Account Holder',
                'name' => 'My Test Beneficiary 610a7a00b693d',
                'beneficiary_country' => null,
                'account_number' => null,
                'routing_code_type_1' => null,
                'routing_code_value_1' => null,
                'routing_code_type_2' => null,
                'routing_code_value_2' => null,
                'bic_swift' => null,
                'iban' => null,
                'bank_address' => null,
                'bank_name' => null,
                'default_beneficiary' => null,
                'bank_account_type' => null,
                'beneficiary_entity_type' => null,
                'beneficiary_company_name' => null,
                'beneficiary_address' => null,
                'beneficiary_first_name' => null,
                'beneficiary_last_name' => null,
                'beneficiary_city' => null,
                'beneficiary_postcode' => null,
                'beneficiary_state_or_province' => null,
                'beneficiary_date_of_birth' => null,
                'beneficiary_identification_type' => null,
                'beneficiary_identification_value' => null,
                'payment_types' => null,
                'email' => null,
                'beneficiary_external_reference' => null,
                'creator_contact_id' => null,
                'on_behalf_of' => "yes"
            ]
        ));

        $item = $entryPoint->create($beneficiary, "yes");

        $this->validateObjectStrictName($item, json_decode($data, true));
    }

    /**
     * @test
     */
    public function createWithAllValues()
    {
        $data = '{"id": "f79ef1cd-de72-445c-9fc5-027810082bac","bank_account_holder_name": "My Test Account Holder","name": "My Test Beneficiary 610a7a00b693d","email": null,"payment_types": [    "regular"],"beneficiary_address": [],"beneficiary_country": null,"beneficiary_entity_type": null,"beneficiary_company_name": null,"beneficiary_first_name": null,"beneficiary_last_name": null,"beneficiary_city": null,"beneficiary_postcode": null,"beneficiary_state_or_province": null,"beneficiary_date_of_birth": null,"beneficiary_identification_type": null,"beneficiary_identification_value": null,"bank_country": "GB","bank_name": "TEST BANK NAME","bank_account_type": null,"currency": "GBP","account_number": "32847346","routing_code_type_1": "sort_code","routing_code_value_1": "101193","routing_code_type_2": null,"routing_code_value_2": null,"bic_swift": null,"iban": null,"default_beneficiary": "false","creator_contact_id": "a66ca63f-e668-47af-8bb9-74363240d781","bank_address": [    "TEST BANK ADDRESS",    " NOT USING EXTERNAL SERVICE",    " DEVELOPMENT ENVIRONMENT."],"created_at": "2021-08-04T11:29:20+00:00","updated_at": "2021-08-04T11:29:20+00:00","beneficiary_external_reference": null}';


        $dateOfBirth = new DateTime();

        $beneficiary = Beneficiary::create('A', 'B', 'C', 'D', 'E')
            ->setEmail("F")
            ->setBeneficiaryAddress("G")
            ->setBeneficiaryCountry("H")
            ->setAccountNumber("I")
            ->setRoutingCodeType1("J")
            ->setRoutingCodeValue1("K")
            ->setRoutingCodeType2("L")
            ->setRoutingCodeValue2("M")
            ->setBicSwift("N")
            ->setIban("O")
            ->setIsDefaultBeneficiary(true)
            ->setBankAddress(["P", "P1", "P2"])
            ->setBankName("Q")
            ->setBankAccountType("R")
            ->setBeneficiaryEntityType("S")
            ->setBeneficiaryCompanyName("T")
            ->setBeneficiaryFirstName("U")
            ->setBeneficiaryLastName("V")
            ->setBeneficiaryCity("W")
            ->setBeneficiaryPostcode("X")
            ->setBeneficiaryStateOrProvince("Y")
            ->setBeneficiaryDateOfBirth($dateOfBirth)
            ->setBeneficiaryIdentificationType("Z")
            ->setBeneficiaryIdentificationValue("AA")
            ->setBeneficiaryExternalReference("AB")
            ->setPaymentTypes(["regular"]);

        $entryPoint = new BeneficiariesEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'POST',
            'beneficiaries/create',
            [],
            [
                'currency' => 'C',
                'on_behalf_of' => 'V',
                'bank_country' => 'B',
                'beneficiary_country' => 'H',
                'account_number' => 'I',
                'routing_code_type_1' => 'J',
                'routing_code_value_1' => 'K',
                'routing_code_type_2' => 'L',
                'routing_code_value_2' => 'M',
                'bic_swift' => 'N',
                'iban' => 'O',
                'bank_address' => ["P", "P1", "P2"],
                'bank_name' => 'Q',
                'default_beneficiary' => 'true',
                'bank_account_type' => 'R',
                'beneficiary_entity_type' => 'S',
                'beneficiary_company_name' => 'T',
                'beneficiary_address' => 'G',
                'beneficiary_first_name' => 'U',
                'beneficiary_last_name' => 'V',
                'beneficiary_city' => 'W',
                'beneficiary_postcode' => 'X',
                'beneficiary_state_or_province' => 'Y',
                'beneficiary_date_of_birth' => $dateOfBirth->format('Y-m-d'),
                'beneficiary_identification_type' => 'Z',
                'beneficiary_identification_value' => 'AA',
                'payment_types' => ["regular"],
                'bank_account_holder_name' => 'A',
                'name' => 'D',
                'email' => 'F',
                'beneficiary_external_reference' => 'AB',
                'creator_contact_id' => null
            ]
        ));

        $item = $entryPoint->create($beneficiary, 'V');

        $this->validateObjectStrictName($item, json_decode($data, true));
    }

    /**
     * @test
     */
    public function canDelete()
    {
        $data = '{"id": "f79ef1cd-de72-445c-9fc5-027810082bac","bank_account_holder_name": "My Test Account Holder","name": "My Test Beneficiary 610a7a00b693d","email": null,"payment_types": [    "regular"],"beneficiary_address": [],"beneficiary_country": null,"beneficiary_entity_type": null,"beneficiary_company_name": null,"beneficiary_first_name": null,"beneficiary_last_name": null,"beneficiary_city": null,"beneficiary_postcode": null,"beneficiary_state_or_province": null,"beneficiary_date_of_birth": null,"beneficiary_identification_type": null,"beneficiary_identification_value": null,"bank_country": "GB","bank_name": "TEST BANK NAME","bank_account_type": null,"currency": "GBP","account_number": "32847346","routing_code_type_1": "sort_code","routing_code_value_1": "101193","routing_code_type_2": null,"routing_code_value_2": null,"bic_swift": null,"iban": null,"default_beneficiary": "false","creator_contact_id": "a66ca63f-e668-47af-8bb9-74363240d781","bank_address": [    "TEST BANK ADDRESS",    " NOT USING EXTERNAL SERVICE",    " DEVELOPMENT ENVIRONMENT."],"created_at": "2021-08-04T11:29:20+00:00","updated_at": "2021-08-04T11:29:20+00:00","beneficiary_external_reference": null}';

        $entryPoint = new BeneficiariesEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'POST',
            'beneficiaries/hi/delete',
            [],
            ['on_behalf_of' => null]
        )
        );

        $beneficiary = new Beneficiary();
        $this->setIdProperty($beneficiary, 'hi');

        $beneficiary = $entryPoint->delete($beneficiary);

        $this->validateObjectStrictName($beneficiary, json_decode($data, true));
    }

    /**
     * @test
     */
    public function canDeleteWithOnBehalfOf()
    {
        $data = '{"id": "f79ef1cd-de72-445c-9fc5-027810082bac","bank_account_holder_name": "My Test Account Holder","name": "My Test Beneficiary 610a7a00b693d","email": null,"payment_types": [    "regular"],"beneficiary_address": [],"beneficiary_country": null,"beneficiary_entity_type": null,"beneficiary_company_name": null,"beneficiary_first_name": null,"beneficiary_last_name": null,"beneficiary_city": null,"beneficiary_postcode": null,"beneficiary_state_or_province": null,"beneficiary_date_of_birth": null,"beneficiary_identification_type": null,"beneficiary_identification_value": null,"bank_country": "GB","bank_name": "TEST BANK NAME","bank_account_type": null,"currency": "GBP","account_number": "32847346","routing_code_type_1": "sort_code","routing_code_value_1": "101193","routing_code_type_2": null,"routing_code_value_2": null,"bic_swift": null,"iban": null,"default_beneficiary": "false","creator_contact_id": "a66ca63f-e668-47af-8bb9-74363240d781","bank_address": [    "TEST BANK ADDRESS",    " NOT USING EXTERNAL SERVICE",    " DEVELOPMENT ENVIRONMENT."],"created_at": "2021-08-04T11:29:20+00:00","updated_at": "2021-08-04T11:29:20+00:00","beneficiary_external_reference": null}';

        $entryPoint = new BeneficiariesEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'POST',
            'beneficiaries/hi/delete',
            [],
            ['on_behalf_of' => 'yes']
        )
        );

        $beneficiary = new Beneficiary();
        $this->setIdProperty($beneficiary, 'hi');

        $beneficiary = $entryPoint->delete($beneficiary, 'yes');

        $this->validateObjectStrictName($beneficiary, json_decode($data, true));
    }

    /**
     * @test
     */
    public function canRetrieve()
    {
        $data = '{"id": "f79ef1cd-de72-445c-9fc5-027810082bac","bank_account_holder_name": "My Test Account Holder","name": "My Test Beneficiary 610a7a00b693d","email": null,"payment_types": [    "regular"],"beneficiary_address": [],"beneficiary_country": null,"beneficiary_entity_type": null,"beneficiary_company_name": null,"beneficiary_first_name": null,"beneficiary_last_name": null,"beneficiary_city": null,"beneficiary_postcode": null,"beneficiary_state_or_province": null,"beneficiary_date_of_birth": null,"beneficiary_identification_type": null,"beneficiary_identification_value": null,"bank_country": "GB","bank_name": "TEST BANK NAME","bank_account_type": null,"currency": "GBP","account_number": "32847346","routing_code_type_1": "sort_code","routing_code_value_1": "101193","routing_code_type_2": null,"routing_code_value_2": null,"bic_swift": null,"iban": null,"default_beneficiary": "false","creator_contact_id": "a66ca63f-e668-47af-8bb9-74363240d781","bank_address": [    "TEST BANK ADDRESS",    " NOT USING EXTERNAL SERVICE",    " DEVELOPMENT ENVIRONMENT."],"created_at": "2021-08-04T11:29:20+00:00","updated_at": "2021-08-04T11:29:20+00:00","beneficiary_external_reference": null}';

        $entryPoint = new BeneficiariesEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'GET',
            'beneficiaries/543477161-91de-012f-e284-1e0030c7f3123',
            [
                'on_behalf_of' => null,
            ]
        )
        );

        $beneficiary = new Beneficiary();
        $this->setIdProperty($beneficiary, '543477161-91de-012f-e284-1e0030c7f3123');

        $beneficiary = $entryPoint->retrieve('543477161-91de-012f-e284-1e0030c7f3123');

        $this->validateObjectStrictName($beneficiary, json_decode($data, true));
    }

    /**
     * @test
     */
    public function canRetrieveWithOnBehalfOf()
    {
        $data = '{"id": "f79ef1cd-de72-445c-9fc5-027810082bac","bank_account_holder_name": "My Test Account Holder","name": "My Test Beneficiary 610a7a00b693d","email": null,"payment_types": [    "regular"],"beneficiary_address": [],"beneficiary_country": null,"beneficiary_entity_type": null,"beneficiary_company_name": null,"beneficiary_first_name": null,"beneficiary_last_name": null,"beneficiary_city": null,"beneficiary_postcode": null,"beneficiary_state_or_province": null,"beneficiary_date_of_birth": null,"beneficiary_identification_type": null,"beneficiary_identification_value": null,"bank_country": "GB","bank_name": "TEST BANK NAME","bank_account_type": null,"currency": "GBP","account_number": "32847346","routing_code_type_1": "sort_code","routing_code_value_1": "101193","routing_code_type_2": null,"routing_code_value_2": null,"bic_swift": null,"iban": null,"default_beneficiary": "false","creator_contact_id": "a66ca63f-e668-47af-8bb9-74363240d781","bank_address": [    "TEST BANK ADDRESS",    " NOT USING EXTERNAL SERVICE",    " DEVELOPMENT ENVIRONMENT."],"created_at": "2021-08-04T11:29:20+00:00","updated_at": "2021-08-04T11:29:20+00:00","beneficiary_external_reference": null}';

        $entryPoint = new BeneficiariesEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'GET',
            'beneficiaries/hi',
            [
                'on_behalf_of' => 'yes',
            ]
        )
        );

        $beneficiary = new Beneficiary();
        $this->setIdProperty($beneficiary, 'hi');

        $beneficiary = $entryPoint->retrieve('hi', 'yes');

        $this->validateObjectStrictName($beneficiary, json_decode($data, true));
    }

    /**
     * @test
     */
  public function canUpdate()
    {
        $data = '{"id": "f79ef1cd-de72-445c-9fc5-027810082bac","bank_account_holder_name": "My Test Account Holder","name": "My Test Beneficiary 610a7a00b693d","email": null,"payment_types": [    "regular"],"beneficiary_address": [],"beneficiary_country": null,"beneficiary_entity_type": null,"beneficiary_company_name": null,"beneficiary_first_name": null,"beneficiary_last_name": null,"beneficiary_city": null,"beneficiary_postcode": null,"beneficiary_state_or_province": null,"beneficiary_date_of_birth": null,"beneficiary_identification_type": null,"beneficiary_identification_value": null,"bank_country": "GB","bank_name": "TEST BANK NAME","bank_account_type": null,"currency": "GBP","account_number": "32847346","routing_code_type_1": "sort_code","routing_code_value_1": "101193","routing_code_type_2": null,"routing_code_value_2": null,"bic_swift": null,"iban": null,"default_beneficiary": "false","creator_contact_id": "a66ca63f-e668-47af-8bb9-74363240d781","bank_address": [    "TEST BANK ADDRESS",    " NOT USING EXTERNAL SERVICE",    " DEVELOPMENT ENVIRONMENT."],"created_at": "2021-08-04T11:29:20+00:00","updated_at": "2021-08-04T11:29:20+00:00","beneficiary_external_reference": null}';

        $beneficiary = new Beneficiary();

        $entryPoint = new BeneficiariesEntryPoint($this->getMockedEntityManager($beneficiary, $beneficiary), $this->getMockedClient(
            json_decode($data),
            'POST',
            'beneficiaries/hi',
            [],
            [
                'bank_country' => null,
                'currency' => null,
                'bank_account_holder_name' => null,
                'name' => null,
                'beneficiary_country' => null,
                'account_number' => null,
                'routing_code_type_1' => null,
                'routing_code_value_1' => null,
                'routing_code_type_2' => null,
                'routing_code_value_2' => null,
                'bic_swift' => null,
                'iban' => null,
                'bank_address' => null,
                'bank_name' => null,
                'default_beneficiary' => null,
                'bank_account_type' => null,
                'beneficiary_entity_type' => null,
                'beneficiary_company_name' => null,
                'beneficiary_address' => null,
                'beneficiary_first_name' => null,
                'beneficiary_last_name' => null,
                'beneficiary_city' => null,
                'beneficiary_postcode' => null,
                'beneficiary_state_or_province' => null,
                'beneficiary_date_of_birth' => null,
                'beneficiary_identification_type' => null,
                'beneficiary_identification_value' => null,
                'payment_types' => null,
                'email' => null,
                'beneficiary_external_reference' => null,
                'on_behalf_of' => null
            ]
        )
        );

        $this->setIdProperty($beneficiary, 'hi');

        $beneficiary = $entryPoint->update($beneficiary);

        $this->validateObjectStrictName($beneficiary, json_decode($data, true));
    }

    /**
     * @test
     */
    public function canUpdateWithOnBehalfOf()
    {
        $data = '{"id": "f79ef1cd-de72-445c-9fc5-027810082bac","bank_account_holder_name": "My Test Account Holder","name": "My Test Beneficiary 610a7a00b693d","email": null,"payment_types": [    "regular"],"beneficiary_address": [],"beneficiary_country": null,"beneficiary_entity_type": null,"beneficiary_company_name": null,"beneficiary_first_name": null,"beneficiary_last_name": null,"beneficiary_city": null,"beneficiary_postcode": null,"beneficiary_state_or_province": null,"beneficiary_date_of_birth": null,"beneficiary_identification_type": null,"beneficiary_identification_value": null,"bank_country": "GB","bank_name": "TEST BANK NAME","bank_account_type": null,"currency": "GBP","account_number": "32847346","routing_code_type_1": "sort_code","routing_code_value_1": "101193","routing_code_type_2": null,"routing_code_value_2": null,"bic_swift": null,"iban": null,"default_beneficiary": "false","creator_contact_id": "a66ca63f-e668-47af-8bb9-74363240d781","bank_address": [    "TEST BANK ADDRESS",    " NOT USING EXTERNAL SERVICE",    " DEVELOPMENT ENVIRONMENT."],"created_at": "2021-08-04T11:29:20+00:00","updated_at": "2021-08-04T11:29:20+00:00","beneficiary_external_reference": null}';

        $beneficiary = new Beneficiary();

        $entryPoint = new BeneficiariesEntryPoint($this->getMockedEntityManager($beneficiary, $beneficiary), $this->getMockedClient(
            json_decode($data),
            'POST',
            'beneficiaries/hi',
            [],
            [
                'bank_country' => null,
                'currency' => null,
                'bank_account_holder_name' => null,
                'name' => null,
                'beneficiary_country' => null,
                'account_number' => null,
                'routing_code_type_1' => null,
                'routing_code_value_1' => null,
                'routing_code_type_2' => null,
                'routing_code_value_2' => null,
                'bic_swift' => null,
                'iban' => null,
                'bank_address' => null,
                'bank_name' => null,
                'default_beneficiary' => null,
                'bank_account_type' => null,
                'beneficiary_entity_type' => null,
                'beneficiary_company_name' => null,
                'beneficiary_address' => null,
                'beneficiary_first_name' => null,
                'beneficiary_last_name' => null,
                'beneficiary_city' => null,
                'beneficiary_postcode' => null,
                'beneficiary_state_or_province' => null,
                'beneficiary_date_of_birth' => null,
                'beneficiary_identification_type' => null,
                'beneficiary_identification_value' => null,
                'payment_types' => null,
                'email' => null,
                'beneficiary_external_reference' => null,
                'on_behalf_of' => "yes"
            ]
        )
        );

        $this->setIdProperty($beneficiary, 'hi');

        $beneficiary = $entryPoint->update($beneficiary,  'yes');

        $this->validateObjectStrictName($beneficiary, json_decode($data, true));
    }

    /**
     * @test
     */
    public function canFindWithDefaultValues()
    {
        $data = '{"beneficiaries": [ {"id": "90dffddc-795b-4f7a-bc6d-ea1e6d921517", "bank_account_holder_name": "My Test Account Holder", "name": "My Test Beneficiary 5bd6e16269c41", "email": null, "payment_types": [], "beneficiary_address": [], "beneficiary_country": null, "beneficiary_entity_type": null, "beneficiary_company_name": null, "beneficiary_first_name": null, "beneficiary_last_name": null, "beneficiary_city": null, "beneficiary_postcode": null, "beneficiary_state_or_province": null, "beneficiary_date_of_birth": null, "beneficiary_identification_type": null, "beneficiary_identification_value": null, "bank_country": "GB", "bank_name": "TEST BANK NAME", "bank_account_type": null, "currency": "GBP", "account_number": "3284734675", "routing_code_type_1": "sort_code", "routing_code_value_1": "101193", "routing_code_type_2": null, "routing_code_value_2": null, "bic_swift": null, "iban": null, "default_beneficiary": "false", "creator_contact_id": "a66ca63f-e668-47af-8bb9-74363240d781", "bank_address": [  "TEST BANK ADDRESS",  " NOT USING EXTERNAL SERVICE",  " DEVELOPMENT ENVIRONMENT." ], "created_at": "2018-10-29T10:31:06+00:00", "updated_at": "2018-10-29T10:31:06+00:00", "beneficiary_external_reference": null }],"pagination":  {"total_entries": 624, "total_pages": 25, "current_page": 1, "per_page": 25, "previous_page": -1, "next_page": 2, "order": "created_at", "order_asc_desc": "asc"}}';

        $entryPoint = new BeneficiariesEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'GET',
            'beneficiaries/find',
            [
                'bank_country' => null,
                'currency' => null,
                'bank_account_holder_name' => null,
                'name' => null,
                'beneficiary_country' => null,
                'account_number' => null,
                'routing_code_type_1' => null,
                'routing_code_value_1' => null,
                'routing_code_type_2' => null,
                'routing_code_value_2' => null,
                'bic_swift' => null,
                'iban' => null,
                'bank_address' => null,
                'bank_name' => null,
                'default_beneficiary' => null,
                'bank_account_type' => null,
                'beneficiary_entity_type' => null,
                'beneficiary_company_name' => null,
                'beneficiary_address' => null,
                'beneficiary_first_name' => null,
                'beneficiary_last_name' => null,
                'beneficiary_city' => null,
                'beneficiary_postcode' => null,
                'beneficiary_state_or_province' => null,
                'beneficiary_date_of_birth' => null,
                'beneficiary_identification_type' => null,
                'beneficiary_identification_value' => null,
                'payment_types' => null,
                'email' => null,
                'beneficiary_external_reference' => null,
                'creator_contact_id' => null,
                'on_behalf_of' => null,
                'page' => null,
                'per_page' => null,
                'order' => null,
                'order_asc_desc' => null
            ]
        )
        );

        $beneficiaries = $entryPoint->find();

        $this->assertInstanceOf(Beneficiaries::class, $beneficiaries);
        $list = $beneficiaries->getBeneficiaries();

        $this->assertArrayHasKey(0, $list);
        $this->assertCount(1, $list);

        $this->validateObjectStrictName($list[0], json_decode($data, true)['beneficiaries'][0]);
    }

    /**
     * @test
     */
    public function canFindWithSomeValues()
    {
        $data = '{"beneficiaries": [ {"id": "90dffddc-795b-4f7a-bc6d-ea1e6d921517", "bank_account_holder_name": "My Test Account Holder", "name": "My Test Beneficiary 5bd6e16269c41", "email": null, "payment_types": [], "beneficiary_address": [], "beneficiary_country": null, "beneficiary_entity_type": null, "beneficiary_company_name": null, "beneficiary_first_name": null, "beneficiary_last_name": null, "beneficiary_city": null, "beneficiary_postcode": null, "beneficiary_state_or_province": null, "beneficiary_date_of_birth": null, "beneficiary_identification_type": null, "beneficiary_identification_value": null, "bank_country": "GB", "bank_name": "TEST BANK NAME", "bank_account_type": null, "currency": "GBP", "account_number": "3284734675", "routing_code_type_1": "sort_code", "routing_code_value_1": "101193", "routing_code_type_2": null, "routing_code_value_2": null, "bic_swift": null, "iban": null, "default_beneficiary": "false", "creator_contact_id": "a66ca63f-e668-47af-8bb9-74363240d781", "bank_address": [  "TEST BANK ADDRESS",  " NOT USING EXTERNAL SERVICE",  " DEVELOPMENT ENVIRONMENT." ], "created_at": "2018-10-29T10:31:06+00:00", "updated_at": "2018-10-29T10:31:06+00:00", "beneficiary_external_reference": null }],"pagination":  {"total_entries": 624, "total_pages": 25, "current_page": 1, "per_page": 25, "previous_page": -1, "next_page": 2, "order": "created_at", "order_asc_desc": "asc"}}';

        $beneficiary = new Beneficiary();
        $beneficiary->setBeneficiaryExternalReference("A");


        $entryPoint = new BeneficiariesEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'GET',
            'beneficiaries/find',
            [
                'beneficiary_external_reference' => "A",
                'on_behalf_of' => "yes",

                'bank_country' => null,
                'currency' => null,
                'bank_account_holder_name' => null,
                'name' => null,
                'beneficiary_country' => null,
                'account_number' => null,
                'routing_code_type_1' => null,
                'routing_code_value_1' => null,
                'routing_code_type_2' => null,
                'routing_code_value_2' => null,
                'bic_swift' => null,
                'iban' => null,
                'bank_address' => null,
                'bank_name' => null,
                'default_beneficiary' => null,
                'bank_account_type' => null,
                'beneficiary_entity_type' => null,
                'beneficiary_company_name' => null,
                'beneficiary_address' => null,
                'beneficiary_first_name' => null,
                'beneficiary_last_name' => null,
                'beneficiary_city' => null,
                'beneficiary_postcode' => null,
                'beneficiary_state_or_province' => null,
                'beneficiary_date_of_birth' => null,
                'beneficiary_identification_type' => null,
                'beneficiary_identification_value' => null,
                'payment_types' => null,
                'email' => null,
                'creator_contact_id' => null,
                'page' => null,
                'per_page' => null,
                'order' => null,
                'order_asc_desc' => null
            ]
        )
        );

        $beneficiaries = $entryPoint->find($beneficiary, null,"yes");

        $this->assertInstanceOf(Beneficiaries::class, $beneficiaries);
        $list = $beneficiaries->getBeneficiaries();

        $this->assertArrayHasKey(0, $list);
        $this->assertCount(1, $list);

        $this->validateObjectStrictName($list[0], json_decode($data, true)['beneficiaries'][0]);
    }

}
