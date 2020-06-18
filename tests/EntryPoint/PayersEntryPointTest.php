<?php

namespace CurrencyCloud\Tests\EntryPoint;

use CurrencyCloud\EntryPoint\PayersEntryPoint;
use CurrencyCloud\Tests\BaseCurrencyCloudTestCase;

class PayersEntryPointTest extends BaseCurrencyCloudTestCase
{

    /**
     * @test
     */
    public function canRetrieveWithoutOnBehalfOf()
    {
        $data = '{"id":"543477161-91de-012f-e284-1e0030c7f3123","legal_entity_type":"company","company_name":"Acme Corporation","first_name":"","last_name":"","address":"164 Bishopsgate,London","city":"London","state_or_province":"","country":"GB","identification_type":"incorporation_number","identification_value":"123123","postcode":"EC2M 4LX","date_of_birth":"2014-01-12T12:24:19+00:00","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00"}';
        $data2 = '{"id":"543477161-91de-012f-e284-1e0030c7f3123","legal_entity_type":"company","company_name":"Acme Corporation","first_name":"","last_name":"","address":["164 Bishopsgate,London"],"city":"London","state_or_province":"","country":"GB","identification_type":"incorporation_number","identification_value":"123123","postcode":"EC2M 4LX","date_of_birth":"2014-01-12T12:24:19+00:00","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00"}';


        $entryPoint = new PayersEntryPoint($this->getMockedClient(
            json_decode($data),
            'GET',
            'payers/hi',
            [
                'on_behalf_of' => null
            ]
        ));

        $item = $entryPoint->retrieve('hi');

        $this->validateObjectStrictName($item, json_decode($data2, true));
    }

    /**
     * @test
     */
    public function canRetrieveWithOnBehalfOf()
    {
        $data = '{"id":"543477161-91de-012f-e284-1e0030c7f3123","legal_entity_type":"company","company_name":"Acme Corporation","first_name":"","last_name":"","address":"164 Bishopsgate,London","city":"London","state_or_province":"","country":"GB","identification_type":"incorporation_number","identification_value":"123123","postcode":"EC2M 4LX","date_of_birth":"2014-01-12T12:24:19+00:00","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00"}';
        $data2 = '{"id":"543477161-91de-012f-e284-1e0030c7f3123","legal_entity_type":"company","company_name":"Acme Corporation","first_name":"","last_name":"","address":["164 Bishopsgate,London"],"city":"London","state_or_province":"","country":"GB","identification_type":"incorporation_number","identification_value":"123123","postcode":"EC2M 4LX","date_of_birth":"2014-01-12T12:24:19+00:00","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00"}';


        $entryPoint = new PayersEntryPoint($this->getMockedClient(
            json_decode($data),
            'GET',
            'payers/hi',
            [
                'on_behalf_of' => 'test'
            ]
        ));

        $item = $entryPoint->retrieve('hi', 'test');

        $this->validateObjectStrictName($item, json_decode($data2, true));
    }
}
