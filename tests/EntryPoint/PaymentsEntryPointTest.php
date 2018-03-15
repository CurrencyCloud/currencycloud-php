<?php

namespace CurrencyCloud\Tests\EntryPoint;

use CurrencyCloud\Criteria\FindPaymentsCriteria;
use CurrencyCloud\EntryPoint\PaymentsEntryPoint;
use CurrencyCloud\Model\Payer;
use CurrencyCloud\Model\Payment;
use CurrencyCloud\Model\Payments;
use CurrencyCloud\SimpleEntityManager;
use CurrencyCloud\Tests\BaseCurrencyCloudTestCase;
use DateTime;

class PaymentsEntryPointTest extends BaseCurrencyCloudTestCase
{

    /**
     * @test
     */
    public function canCreateWithDefaultValues()
    {
        $data = '{"id":"543477161-91de-012f-e284-1e0030c7f3123","unique_request_id":null,"short_reference":"140416-GGJBNQ001","beneficiary_id":"543477161-91de-012f-e284-1e0030c7f352","conversion_id":"049bab6d-fe2a-42e1-be0f-531c59f838ea","amount":"1250000.00","currency":"GBP","status":"ready_to_send","payment_type":"regular","reference":"INVOICE 9876","reason":"Salary for March","payment_date":"2014-01-12T00:00:00+00:00","transferred_at":"2014-01-12T13:00:00+00:00","authorisation_steps_required":"0","creator_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","last_updater_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","failure_reason":"","payer_id":"","payer_details_source":"","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","failure_returned_amount":""}';

        $payment = Payment::create('A', 'B', 'C', 'D', 'E');

        $entryPoint = new PaymentsEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'POST',
            'payments/create',
            [],
            [
                'currency' => 'A',
                'beneficiary_id' => 'B',
                'amount' => 'C',
                'reason' => 'D',
                'reference' => 'E',
                'conversion_id' => null,
                'payment_date' => null,
                'payment_type' => null,
                'payer_entity_type' => null,
                'payer_company_name' => null,
                'payer_first_name' => null,
                'payer_last_name' => null,
                'payer_city' => null,
                'payer_address' => null,
                'payer_postcode' => null,
                'payer_state_or_province' => null,
                'payer_country' => null,
                'payer_date_of_birth' => null,
                'payer_identification_type' => null,
                'payer_identification_value' => null,
                'on_behalf_of' => null,
                'unique_request_id' => null
            ]
        ));

        $item = $entryPoint->create($payment);

        $this->validateObjectStrictName($item, json_decode($data, true));
    }

    /**
     * @test
     */
    public function createWithAllValues()
    {
        $data = '{"id":"543477161-91de-012f-e284-1e0030c7f3123","unique_request_id":null,"short_reference":"140416-GGJBNQ001","beneficiary_id":"543477161-91de-012f-e284-1e0030c7f352","conversion_id":"049bab6d-fe2a-42e1-be0f-531c59f838ea","amount":"1250000.00","currency":"GBP","status":"ready_to_send","payment_type":"regular","reference":"INVOICE 9876","reason":"Salary for March","payment_date":"2014-01-12T00:00:00+00:00","transferred_at":"2014-01-12T13:00:00+00:00","authorisation_steps_required":"0","creator_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","last_updater_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","failure_reason":"","payer_id":"","payer_details_source":"","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","failure_returned_amount":""}';

        $paymentDate = new DateTime();
        $dateOfBirth = new DateTime();

        $payment = Payment::create('A', 'B', 'C', 'D', 'E')
            ->setConversionId('F')
            ->setPaymentType('G')
            ->setPaymentDate($paymentDate);

        $payer = new Payer();
        $payer->setLegalEntityType('I')
            ->setCompanyName('J')
            ->setFirstName('K')
            ->setLastName('L')
            ->setCity('M')
            ->setAddress(['N', 'Z'])
            ->setPostcode('O')
            ->setStateOrProvince('P')
            ->setCountry('R')
            ->setDateOfBirth($dateOfBirth)
            ->setIdentificationType('T')
            ->setIdentificationValue('U');

        $entryPoint = new PaymentsEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'POST',
            'payments/create',
            [],
            [
                'currency' => 'A',
                'beneficiary_id' => 'B',
                'amount' => 'C',
                'reason' => 'D',
                'reference' => 'E',
                'conversion_id' => 'F',
                'payment_type' => 'G',
                'payment_date' => $paymentDate->format(DateTime::RFC3339),
                'payer_entity_type' => 'I',
                'payer_company_name' => 'J',
                'payer_first_name' => 'K',
                'payer_last_name' => 'L',
                'payer_city' => 'M',
                'payer_address' => 'N Z',
                'payer_postcode' => 'O',
                'payer_state_or_province' => 'P',
                'payer_country' => 'R',
                'payer_date_of_birth' => $dateOfBirth->format('Y-m-d'),
                'payer_identification_type' => 'T',
                'payer_identification_value' => 'U',
                'on_behalf_of' => 'V',
                'unique_request_id' => null
            ]
        ));

        $item = $entryPoint->create($payment, $payer, 'V');

        $this->validateObjectStrictName($item, json_decode($data, true));
    }

    /**
     * @test
     */
    public function canDelete()
    {
        $data = '{"id":"543477161-91de-012f-e284-1e0030c7f3123","unique_request_id":null,"short_reference":"140416-GGJBNQ001","beneficiary_id":"543477161-91de-012f-e284-1e0030c7f352","conversion_id":"049bab6d-fe2a-42e1-be0f-531c59f838ea","amount":"1250000.00","currency":"GBP","status":"ready_to_send","payment_type":"regular","reference":"INVOICE 9876","reason":"Salary for March","payment_date":"2014-01-12T00:00:00+00:00","transferred_at":"2014-01-12T13:00:00+00:00","authorisation_steps_required":"0","creator_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","last_updater_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","failure_reason":"","payer_id":"","payer_details_source":"","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","failure_returned_amount":""}';

        $entryPoint = new PaymentsEntryPoint(
            new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'POST',
            'payments/hi/delete',
            [],
            ['on_behalf_of' => null]
        )
        );

        $payment = new Payment();
        $this->setIdProperty($payment, 'hi');

        $payment = $entryPoint->delete($payment);

        $this->validateObjectStrictName($payment, json_decode($data, true));
    }

    /**
     * @test
     */
    public function canDeleteWithOnBehalfOf()
    {
        $data = '{"id":"543477161-91de-012f-e284-1e0030c7f3123","unique_request_id":null,"short_reference":"140416-GGJBNQ001","beneficiary_id":"543477161-91de-012f-e284-1e0030c7f352","conversion_id":"049bab6d-fe2a-42e1-be0f-531c59f838ea","amount":"1250000.00","currency":"GBP","status":"ready_to_send","payment_type":"regular","reference":"INVOICE 9876","reason":"Salary for March","payment_date":"2014-01-12T00:00:00+00:00","transferred_at":"2014-01-12T13:00:00+00:00","authorisation_steps_required":"0","creator_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","last_updater_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","failure_reason":"","payer_id":"","payer_details_source":"","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","failure_returned_amount":""}';

        $entryPoint = new PaymentsEntryPoint(
            new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'POST',
            'payments/hi/delete',
            [],
            ['on_behalf_of' => 'yes']
        )
        );

        $payment = new Payment();
        $this->setIdProperty($payment, 'hi');

        $payment = $entryPoint->delete($payment, 'yes');

        $this->validateObjectStrictName($payment, json_decode($data, true));
    }

    /**
     * @test
     */
    public function canRetrieve()
    {
        $data = '{"id":"543477161-91de-012f-e284-1e0030c7f3123","unique_request_id":null,"short_reference":"140416-GGJBNQ001","beneficiary_id":"543477161-91de-012f-e284-1e0030c7f352","conversion_id":"049bab6d-fe2a-42e1-be0f-531c59f838ea","amount":"1250000.00","currency":"GBP","status":"ready_to_send","payment_type":"regular","reference":"INVOICE 9876","reason":"Salary for March","payment_date":"2014-01-12T00:00:00+00:00","transferred_at":"2014-01-12T13:00:00+00:00","authorisation_steps_required":"0","creator_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","last_updater_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","failure_reason":"","payer_id":"","payer_details_source":"","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","failure_returned_amount":""}';

        $entryPoint = new PaymentsEntryPoint(
            new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'GET',
            'payments/hi',
            ['on_behalf_of' => null]
        )
        );

        $payment = new Payment();
        $this->setIdProperty($payment, 'hi');

        $payment = $entryPoint->retrieve('hi');

        $this->validateObjectStrictName($payment, json_decode($data, true));
    }

    /**
     * @test
     */
    public function canRetrieveWithOnBehalfOf()
    {
        $data = '{"id":"543477161-91de-012f-e284-1e0030c7f3123","unique_request_id":null,"short_reference":"140416-GGJBNQ001","beneficiary_id":"543477161-91de-012f-e284-1e0030c7f352","conversion_id":"049bab6d-fe2a-42e1-be0f-531c59f838ea","amount":"1250000.00","currency":"GBP","status":"ready_to_send","payment_type":"regular","reference":"INVOICE 9876","reason":"Salary for March","payment_date":"2014-01-12T00:00:00+00:00","transferred_at":"2014-01-12T13:00:00+00:00","authorisation_steps_required":"0","creator_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","last_updater_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","failure_reason":"","payer_id":"","payer_details_source":"","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","failure_returned_amount":""}';

        $entryPoint = new PaymentsEntryPoint(
            new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'GET',
            'payments/hi',
            ['on_behalf_of' => 'yes']
        )
        );

        $payment = new Payment();
        $this->setIdProperty($payment, 'hi');

        $payment = $entryPoint->retrieve('hi', 'yes');

        $this->validateObjectStrictName($payment, json_decode($data, true));
    }

    /**
     * @test
     */
  public function canUpdate()
    {
        $data = '{"id":"543477161-91de-012f-e284-1e0030c7f3123","unique_request_id":null,"short_reference":"140416-GGJBNQ001","beneficiary_id":"543477161-91de-012f-e284-1e0030c7f352","conversion_id":"049bab6d-fe2a-42e1-be0f-531c59f838ea","amount":"1250000.00","currency":"GBP","status":"ready_to_send","payment_type":"regular","reference":"INVOICE 9876","reason":"Salary for March","payment_date":"2014-01-12T00:00:00+00:00","transferred_at":"2014-01-12T13:00:00+00:00","authorisation_steps_required":"0","creator_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","last_updater_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","failure_reason":"","payer_id":"","payer_details_source":"","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","failure_returned_amount":""}';

        $payment = new Payment();

        $entryPoint = new PaymentsEntryPoint(
            $this->getMockedEntityManager($payment, $payment), $this->getMockedClient(
            json_decode($data),
            'POST',
            'payments/hi',
            [],
            [
                'currency' => null,
                'beneficiary_id' => null,
                'amount' => null,
                'reason' => null,
                'reference' => null,
                'conversion_id' => null,
                'payment_date' => null,
                'payment_type' => null,
                'payer_entity_type' => null,
                'payer_company_name' => null,
                'payer_first_name' => null,
                'payer_last_name' => null,
                'payer_city' => null,
                'payer_address' => null,
                'payer_postcode' => null,
                'payer_state_or_province' => null,
                'payer_country' => null,
                'payer_date_of_birth' => null,
                'payer_identification_type' => null,
                'payer_identification_value' => null,
                'on_behalf_of' => null,
                'unique_request_id' => null
            ]
        )
        );

        $this->setIdProperty($payment, 'hi');

        $payment = $entryPoint->update($payment);

        $this->validateObjectStrictName($payment, json_decode($data, true));
    }

    /**
     * @test
     */
    public function canUpdateWithOnBehalfOf()
    {
        $data = '{"id":"543477161-91de-012f-e284-1e0030c7f3123","unique_request_id":null,"short_reference":"140416-GGJBNQ001","beneficiary_id":"543477161-91de-012f-e284-1e0030c7f352","conversion_id":"049bab6d-fe2a-42e1-be0f-531c59f838ea","amount":"1250000.00","currency":"GBP","status":"ready_to_send","payment_type":"regular","reference":"INVOICE 9876","reason":"Salary for March","payment_date":"2014-01-12T00:00:00+00:00","transferred_at":"2014-01-12T13:00:00+00:00","authorisation_steps_required":"0","creator_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","last_updater_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","failure_reason":"","payer_id":"","payer_details_source":"","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","failure_returned_amount":""}';

        $payment = new Payment();

        $entryPoint = new PaymentsEntryPoint(
            $this->getMockedEntityManager($payment, $payment), $this->getMockedClient(
            json_decode($data),
            'POST',
            'payments/hi',
            [],
            [
                'currency' => null,
                'beneficiary_id' => null,
                'amount' => null,
                'reason' => null,
                'reference' => null,
                'conversion_id' => null,
                'payment_date' => null,
                'payment_type' => null,
                'payer_entity_type' => null,
                'payer_company_name' => null,
                'payer_first_name' => null,
                'payer_last_name' => null,
                'payer_city' => null,
                'payer_address' => null,
                'payer_postcode' => null,
                'payer_state_or_province' => null,
                'payer_country' => null,
                'payer_date_of_birth' => null,
                'payer_identification_type' => null,
                'payer_identification_value' => null,
                'on_behalf_of' => 'yes',
                'unique_request_id' => null
            ]
        )
        );

        $this->setIdProperty($payment, 'hi');

        $payment = $entryPoint->update($payment, null, 'yes');

        $this->validateObjectStrictName($payment, json_decode($data, true));
    }

    /**
     * @test
     */
    public function canFindWithDefaultValues()
    {
        $data = '{"payments":[{"id":"543477161-91de-012f-e284-1e0030c7f3123","unique_request_id":null,"short_reference":"140416-GGJBNQ001","beneficiary_id":"543477161-91de-012f-e284-1e0030c7f352","conversion_id":"049bab6d-fe2a-42e1-be0f-531c59f838ea","amount":"1250000.00","currency":"GBP","status":"ready_to_send","payment_type":"regular","reference":"INVOICE 9876","reason":"Salary for March","payment_date":"2014-01-12T00:00:00+00:00","payer_details_source":"","transferred_at":"2014-01-12T13:00:00+00:00","authorisation_steps_required":"0","creator_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","last_updater_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","failure_reason":"","payer_id":"","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","failure_returned_amount":""}],"pagination":{"total_entries":1,"total_pages":1,"current_page":1,"previous_page":-1,"next_page":-1,"per_page":25,"order":"created_at","order_asc_desc":"asc"}}';

        $entryPoint = new PaymentsEntryPoint(
            new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'GET',
            'payments/find',
            [
                'currency' => null,
                'amount' => null,
                'reason' => null,
                'beneficiary_id' => null,
                'conversion_id' => null,
                'short_reference' => null,
                'status' => null,
                'created_at_from' => null,
                'created_at_to' => null,
                'updated_at_from' => null,
                'updated_at_to' => null,
                'payment_date_from' => null,
                'payment_date_to' => null,
                'transferred_at_from' => null,
                'transferred_at_to' => null,
                'amount_from' => null,
                'amount_to' => null,
                'on_behalf_of' => null,
                'page' => null,
                'per_page' => null,
                'order' => null,
                'order_asc_desc' => null,
                'unique_request_id' => null
            ]
        )
        );

        $payments = $entryPoint->find();

        $this->assertInstanceOf(Payments::class, $payments);
        $list = $payments->getPayments();

        $this->assertArrayHasKey(0, $list);
        $this->assertCount(1, $list);

        $this->validateObjectStrictName($list[0], json_decode($data, true)['payments'][0]);
    }

    /**
     * @test
     */
    public function canFindWithSomeValues()
    {
        $data = '{"payments":[{"id":"543477161-91de-012f-e284-1e0030c7f3123","unique_request_id":null,"short_reference":"140416-GGJBNQ001","beneficiary_id":"543477161-91de-012f-e284-1e0030c7f352","conversion_id":"049bab6d-fe2a-42e1-be0f-531c59f838ea","amount":"1250000.00","currency":"GBP","status":"ready_to_send","payment_type":"regular","reference":"INVOICE 9876","reason":"Salary for March","payment_date":"2014-01-12T00:00:00+00:00","payer_details_source":"","transferred_at":"2014-01-12T13:00:00+00:00","authorisation_steps_required":"0","creator_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","last_updater_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","failure_reason":"","payer_id":"","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","failure_returned_amount":""}],"pagination":{"total_entries":1,"total_pages":1,"current_page":1,"previous_page":-1,"next_page":-1,"per_page":25,"order":"created_at","order_asc_desc":"asc"}}';

        $payment = new Payment();
        $payment->setCurrency('A')
            ->setAmount('B')
            ->setReason('C')
            ->setBeneficiaryId('D')
            ->setConversionId('E')
            ->setShortReference('F')
            ->setStatus('G');

        /* @var DateTime[] $dateTime */
        $dateTime = [
            new DateTime(),
            (new DateTime())->modify('-1 hour'),
            (new DateTime())->modify('-2 hour'),
            (new DateTime())->modify('-3 hour'),
            (new DateTime())->modify('-4 hour'),
            (new DateTime())->modify('-5 hour'),
            (new DateTime())->modify('-6 hour'),
            (new DateTime())->modify('-7 hour'),
        ];

        $criteria = new FindPaymentsCriteria();
        $criteria->setCreatedAtFrom($dateTime[0])
            ->setCreatedAtTo($dateTime[1])
            ->setUpdatedAtFrom($dateTime[2])
            ->setUpdatedAtTo($dateTime[3])
            ->setPaymentDateFrom($dateTime[4])
            ->setPaymentDateTo($dateTime[5])
            ->setTransferredAtFrom($dateTime[6])
            ->setTransferredAtTo($dateTime[7])
            ->setAmountFrom('H')
            ->setAmountTo('I');

        $entryPoint = new PaymentsEntryPoint(
            new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'GET',
            'payments/find',
            [
                'currency' => 'A',
                'amount' => 'B',
                'reason' => 'C',
                'beneficiary_id' => 'D',
                'conversion_id' => 'E',
                'short_reference' => 'F',
                'status' => 'G',
                'created_at_from' => $dateTime[0]->format(DateTime::RFC3339),
                'created_at_to' => $dateTime[1]->format(DateTime::RFC3339),
                'updated_at_from' => $dateTime[2]->format(DateTime::RFC3339),
                'updated_at_to' => $dateTime[3]->format(DateTime::RFC3339),
                'payment_date_from' => $dateTime[4]->format(DateTime::RFC3339),
                'payment_date_to' => $dateTime[5]->format(DateTime::RFC3339),
                'transferred_at_from' => $dateTime[6]->format(DateTime::RFC3339),
                'transferred_at_to' => $dateTime[7]->format(DateTime::RFC3339),
                'amount_from' => 'H',
                'amount_to' => 'I',
                'on_behalf_of' => 'J',
                'page' => null,
                'per_page' => null,
                'order' => null,
                'order_asc_desc' => null,
                'unique_request_id' => null
            ]
        )
        );

        $payments = $entryPoint->find($payment, $criteria, null, 'J');

        $this->assertInstanceOf(Payments::class, $payments);
        $list = $payments->getPayments();

        $this->assertArrayHasKey(0, $list);
        $this->assertCount(1, $list);

        $this->validateObjectStrictName($list[0], json_decode($data, true)['payments'][0]);
    }
}
