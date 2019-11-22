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
        $data = '{"id":"543477161-91de-012f-e284-1e0030c7f3123","unique_request_id":null,"short_reference":"140416-GGJBNQ001","beneficiary_id":"543477161-91de-012f-e284-1e0030c7f352","conversion_id":"049bab6d-fe2a-42e1-be0f-531c59f838ea","amount":"1250000.00","currency":"GBP","status":"ready_to_send","payment_type":"regular","reference":"INVOICE 9876","reason":"Salary for March","payment_date":"2014-01-12T00:00:00+00:00","transferred_at":"2014-01-12T13:00:00+00:00","authorisation_steps_required":"0","creator_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","last_updater_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","failure_reason":"","payer_id":"","payer_details_source":"","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","failure_returned_amount":"", "purpose_code": null, "charge_type": null, "fee_amount": null, "fee_currency": null}';

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
                'unique_request_id' => null,
                'purpose_code' => null,
                'charge_type' => null,
                'fee_amount' => null,
                'fee_currency' => null
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
        $data = '{"id":"543477161-91de-012f-e284-1e0030c7f3123","unique_request_id":null,"short_reference":"140416-GGJBNQ001","beneficiary_id":"543477161-91de-012f-e284-1e0030c7f352","conversion_id":"049bab6d-fe2a-42e1-be0f-531c59f838ea","amount":"1250000.00","currency":"GBP","status":"ready_to_send","payment_type":"regular","reference":"INVOICE 9876","reason":"Salary for March","payment_date":"2014-01-12T00:00:00+00:00","transferred_at":"2014-01-12T13:00:00+00:00","authorisation_steps_required":"0","creator_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","last_updater_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","failure_reason":"","payer_id":"","payer_details_source":"","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","failure_returned_amount":"", "purpose_code": null, "charge_type": null, "fee_amount": "12.34", "fee_currency": "GBP"}';

        $paymentDate = new DateTime();
        $dateOfBirth = new DateTime();

        $payment = Payment::create('A', 'B', 'C', 'D', 'E')
            ->setConversionId('F')
            ->setPaymentType('G')
            ->setPaymentDate($paymentDate)
            ->setFeeAmount("12.34")
            ->setFeeCurrency("GBP");

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
                'unique_request_id' => null,
                'purpose_code' => null,
                'charge_type' => null,
                'fee_amount' => '12.34',
                'fee_currency' => 'GBP'
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
        $data = '{"id":"543477161-91de-012f-e284-1e0030c7f3123","unique_request_id":null,"short_reference":"140416-GGJBNQ001","beneficiary_id":"543477161-91de-012f-e284-1e0030c7f352","conversion_id":"049bab6d-fe2a-42e1-be0f-531c59f838ea","amount":"1250000.00","currency":"GBP","status":"ready_to_send","payment_type":"regular","reference":"INVOICE 9876","reason":"Salary for March","payment_date":"2014-01-12T00:00:00+00:00","transferred_at":"2014-01-12T13:00:00+00:00","authorisation_steps_required":"0","creator_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","last_updater_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","failure_reason":"","payer_id":"","payer_details_source":"","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","failure_returned_amount":"", "purpose_code": null, "charge_type": null, "fee_amount": null, "fee_currency": null}';

        $entryPoint = new PaymentsEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
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
        $data = '{"id":"543477161-91de-012f-e284-1e0030c7f3123","unique_request_id":null,"short_reference":"140416-GGJBNQ001","beneficiary_id":"543477161-91de-012f-e284-1e0030c7f352","conversion_id":"049bab6d-fe2a-42e1-be0f-531c59f838ea","amount":"1250000.00","currency":"GBP","status":"ready_to_send","payment_type":"regular","reference":"INVOICE 9876","reason":"Salary for March","payment_date":"2014-01-12T00:00:00+00:00","transferred_at":"2014-01-12T13:00:00+00:00","authorisation_steps_required":"0","creator_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","last_updater_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","failure_reason":"","payer_id":"","payer_details_source":"","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","failure_returned_amount":"", "purpose_code": null, "charge_type": null, "fee_amount": null, "fee_currency": null}';

        $entryPoint = new PaymentsEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
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
        $data = '{"id":"543477161-91de-012f-e284-1e0030c7f3123","unique_request_id":null,"short_reference":"140416-GGJBNQ001","beneficiary_id":"543477161-91de-012f-e284-1e0030c7f352","conversion_id":"049bab6d-fe2a-42e1-be0f-531c59f838ea","amount":"1250000.00","currency":"GBP","status":"ready_to_send","payment_type":"regular","reference":"INVOICE 9876","reason":"Salary for March","payment_date":"2014-01-12T00:00:00+00:00","transferred_at":"2014-01-12T13:00:00+00:00","authorisation_steps_required":"0","creator_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","last_updater_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","failure_reason":"","payer_id":"","payer_details_source":"","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","failure_returned_amount":"","purpose_code": null, "charge_type": null, "fee_amount": null, "fee_currency": null}';

        $entryPoint = new PaymentsEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'GET',
            'payments/543477161-91de-012f-e284-1e0030c7f3123',
            [
                'on_behalf_of' => null,
                'with_deleted' => null,
                'purpose_code' => null
                ]
        )
        );

        $payment = new Payment();
        $this->setIdProperty($payment, '543477161-91de-012f-e284-1e0030c7f3123');

        $payment = $entryPoint->retrieve('543477161-91de-012f-e284-1e0030c7f3123');

        $this->validateObjectStrictName($payment, json_decode($data, true));
    }

    /**
     * @test
     */
    public function canRetrieveWithOnBehalfOf()
    {
        $data = '{"id":"543477161-91de-012f-e284-1e0030c7f3123","unique_request_id":null,"short_reference":"140416-GGJBNQ001","beneficiary_id":"543477161-91de-012f-e284-1e0030c7f352","conversion_id":"049bab6d-fe2a-42e1-be0f-531c59f838ea","amount":"1250000.00","currency":"GBP","status":"ready_to_send","payment_type":"regular","reference":"INVOICE 9876","reason":"Salary for March","payment_date":"2014-01-12T00:00:00+00:00","transferred_at":"2014-01-12T13:00:00+00:00","authorisation_steps_required":"0","creator_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","last_updater_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","failure_reason":"","payer_id":"","payer_details_source":"","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","failure_returned_amount":"", "purpose_code": null, "charge_type": null, "fee_amount": null, "fee_currency": null}';

        $entryPoint = new PaymentsEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'GET',
            'payments/hi',
            [
                'on_behalf_of' => 'yes',
                'with_deleted' => null,
                'purpose_code' => null
            ]
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
        $data = '{"id":"543477161-91de-012f-e284-1e0030c7f3123","unique_request_id":null,"short_reference":"140416-GGJBNQ001","beneficiary_id":"543477161-91de-012f-e284-1e0030c7f352","conversion_id":"049bab6d-fe2a-42e1-be0f-531c59f838ea","amount":"1250000.00","currency":"GBP","status":"ready_to_send","payment_type":"regular","reference":"INVOICE 9876","reason":"Salary for March","payment_date":"2014-01-12T00:00:00+00:00","transferred_at":"2014-01-12T13:00:00+00:00","authorisation_steps_required":"0","creator_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","last_updater_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","failure_reason":"","payer_id":"","payer_details_source":"","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","failure_returned_amount":"", "purpose_code": null, "charge_type": null, "fee_amount": null, "fee_currency": null}';

        $payment = new Payment();

        $entryPoint = new PaymentsEntryPoint($this->getMockedEntityManager($payment, $payment), $this->getMockedClient(
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
                'unique_request_id' => null,
                'purpose_code' => null,
                'charge_type' => null,
                'fee_amount' => null,
                'fee_currency' => null
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
        $data = '{"id":"543477161-91de-012f-e284-1e0030c7f3123","unique_request_id":null,"short_reference":"140416-GGJBNQ001","beneficiary_id":"543477161-91de-012f-e284-1e0030c7f352","conversion_id":"049bab6d-fe2a-42e1-be0f-531c59f838ea","amount":"1250000.00","currency":"GBP","status":"ready_to_send","payment_type":"regular","reference":"INVOICE 9876","reason":"Salary for March","payment_date":"2014-01-12T00:00:00+00:00","transferred_at":"2014-01-12T13:00:00+00:00","authorisation_steps_required":"0","creator_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","last_updater_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","failure_reason":"","payer_id":"","payer_details_source":"","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","failure_returned_amount":"", "purpose_code": null, "charge_type": null, "fee_amount": null, "fee_currency": null}';

        $payment = new Payment();

        $entryPoint = new PaymentsEntryPoint($this->getMockedEntityManager($payment, $payment), $this->getMockedClient(
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
                'unique_request_id' => null,
                'purpose_code' => null,
                'charge_type' => null,
                'fee_amount' => null,
                'fee_currency' => null
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
        $data = '{"payments":[{"id":"543477161-91de-012f-e284-1e0030c7f3123","unique_request_id":null,"short_reference":"140416-GGJBNQ001","beneficiary_id":"543477161-91de-012f-e284-1e0030c7f352","conversion_id":"049bab6d-fe2a-42e1-be0f-531c59f838ea","amount":"1250000.00","currency":"GBP","status":"ready_to_send","payment_type":"regular","reference":"INVOICE 9876","reason":"Salary for March","payment_date":"2014-01-12T00:00:00+00:00","payer_details_source":"","transferred_at":"2014-01-12T13:00:00+00:00","authorisation_steps_required":"0","creator_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","last_updater_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","failure_reason":"","payer_id":"","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","failure_returned_amount":"", "purpose_code": null, "charge_type": null, "fee_amount": null, "fee_currency": null}],"pagination":{"total_entries":1,"total_pages":1,"current_page":1,"previous_page":-1,"next_page":-1,"per_page":25,"order":"created_at","order_asc_desc":"asc"}}';

        $entryPoint = new PaymentsEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
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
                'unique_request_id' => null,
                'purpose_code' => null,
                'charge_type' => null,
                'fee_amount' => null,
                'fee_currency' => null
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
        $data = '{"payments":[{"id":"543477161-91de-012f-e284-1e0030c7f3123","unique_request_id":null,"short_reference":"140416-GGJBNQ001","beneficiary_id":"543477161-91de-012f-e284-1e0030c7f352","conversion_id":"049bab6d-fe2a-42e1-be0f-531c59f838ea","amount":"1250000.00","currency":"GBP","status":"ready_to_send","payment_type":"regular","reference":"INVOICE 9876","reason":"Salary for March","payment_date":"2014-01-12T00:00:00+00:00","payer_details_source":"","transferred_at":"2014-01-12T13:00:00+00:00","authorisation_steps_required":"0","creator_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","last_updater_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","failure_reason":"","payer_id":"","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","failure_returned_amount":"", "purpose_code": null, "charge_type": null, "fee_amount": null, "fee_currency": null}],"pagination":{"total_entries":1,"total_pages":1,"current_page":1,"previous_page":-1,"next_page":-1,"per_page":25,"order":"created_at","order_asc_desc":"asc"}}';

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

        $entryPoint = new PaymentsEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
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
                'unique_request_id' => null,
                'purpose_code' => null,
                'charge_type' => null,
                'purpose_code' => null,
                'charge_type' => null,
                'fee_amount' => null,
                'fee_currency' => null
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

    /**
     * @test
     */
    public function canAuthorisePayment()
    {
        $data = '{
            "authorisations": [
                {
                    "payment_id": "2416c8fe-0486-4fc3-82d9-4dc9a44eba9a",
                    "payment_status": "authorised",
                    "updated": true,
                    "error": null,
                    "auth_steps_taken": 1,
                    "auth_steps_required": 1,
                    "short_reference": "181108-WRMWLR001"
                },
                {
                    "payment_id": "abf2ebe7-cdc9-460b-b64e-3652297b629e",
                    "payment_status": "authorised",
                    "updated": true,
                    "error": null,
                    "auth_steps_taken": 1,
                    "auth_steps_required": 1,
                    "short_reference": "181108-BHJNQM001"
                }
            ]
        }';

        $entryPoint = new PaymentsEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'POST',
            'payments/authorise',
            [],
            [
                'payment_ids' => [
                    '2416c8fe-0486-4fc3-82d9-4dc9a44eba9a',
                    'abf2ebe7-cdc9-460b-b64e-3652297b629e'

                ]
            ]
        )
        );

        $dummy = json_decode($data, true);

        $authorisations = $entryPoint->authorise([
            '2416c8fe-0486-4fc3-82d9-4dc9a44eba9a',
            'abf2ebe7-cdc9-460b-b64e-3652297b629e'
            ]);

        $this->assertSame(count($dummy['authorisations']), $authorisations->count());

        foreach ($dummy['authorisations'] as $key => $value) {
            $this->assertSame($value['payment_id'], $authorisations->getAuthorisations()[$key]->getPaymentId());
            $this->assertSame($value['payment_status'], $authorisations->getAuthorisations()[$key]->getPaymentStatus());
            $this->assertSame($value['updated'], $authorisations->getAuthorisations()[$key]->getUpdated());
            $this->assertSame($value['auth_steps_taken'], $authorisations->getAuthorisations()[$key]->getAuthSteptsTaken());
            $this->assertSame($value['auth_steps_required'], $authorisations->getAuthorisations()[$key]->getAuthSteptsRequired());
            $this->assertSame($value['short_reference'], $authorisations->getAuthorisations()[$key]->getShortReference());
        }
    }

    /**
     * @test
     */
    public function canGetPaymentSubmission(){
        $data = '{
            "mt103": "{1:F01TCCLGB20AXXX0090000004}{2:I103BARCGB22XXXXN}{4: :20:20160617-ZSYWVY :23B:CRED :32A:160617GBP3000,0 :33B:GBP3000,0 :50K:/150618-00026 PCOMAPNY address New-York Province 555222 GB :53B:/20060513071472 :57C://SC200605 :59:/200605000 First Name Last Name e03036bf6c325dd12c58 London GB :70:test reference Test reason Payment group: 0160617-ZSYWVY :71A:SHA -}",
            "status": "pending",
            "submission_ref": "MXGGYAGJULIIQKDV"
        }';

        $entryPoint = new PaymentsEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'GET',
            'payments/48e707c9-43e3-4b07-a1d1-bee38f9c95a1/submission',
            [
                'on_behalf_of' => null
            ]
        )
        );

        $paymentSubmission = $entryPoint->retrieveSubmission('48e707c9-43e3-4b07-a1d1-bee38f9c95a1');

        $dummy = json_decode($data, true);

        $this->assertSame($dummy['status'], $paymentSubmission->getStatus());
        $this->assertSame($dummy['mt103'], $paymentSubmission->getMt103());
        $this->assertSame($dummy['submission_ref'], $paymentSubmission->getSubmissionRef());
    }

    /**
     * @test
     */
    public function canGetPaymentConfirmation(){
        $data = '{
            "id": "d7d5c073-7aac-415a-b2cd-f3f4942ca164",
            "payment_id": "3c66de91-0083-4e8f-aff7-a2b5250f6aa8",
            "account_id": "bf5b1007-b364-43cc-b3d6-9f2d1be75297",
            "short_reference": "PC-9387530-VFDXNJ",
            "status": "completed",
            "confirmation_url": "https://ccycloud-payment-confirmations-prod-demo1.s3.eu-west-1.amazonaws.com/payment_confirmations/d7d5c073-7aac-415a-b2cd-f3f4942ca164/181102-XYJHCH001.pdf?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=abcxyz12345&X-Amz-Date=20181102T121904Z&X-Amz-Expires=172800&X-Amz-SignedHeaders=host&X-Amz-Security-Token=wxyzabc123&X-Amz-Signature=abcdef1234",
            "created_at": "2018-11-02T09:02:57+00:00",
            "updated_at": "2018-11-02T09:02:58+00:00",
            "expires_at": "2018-11-04T00:00:00+00:00"
        }';

        $entryPoint = new PaymentsEntryPoint(new SimpleEntityManager(),
            $this->getMockedClient(
                json_decode($data),
                'GET',
                'payments/796e0d7d-bae6-4d8a-b217-3cf9ee80a350/confirmation',
                [
                    'on_behalf_of' => null
                ]
            )
        );

        $paymentConfirmation = $entryPoint->retrieveConfirmation('796e0d7d-bae6-4d8a-b217-3cf9ee80a350');
        $dummy = json_decode($data, true);

        $this->assertSame($dummy['payment_id'], $paymentConfirmation->getPaymentId());
        $this->assertSame($dummy['account_id'], $paymentConfirmation->getAccountId());
        $this->assertSame($dummy['short_reference'], $paymentConfirmation->getShortReference());
        $this->assertSame($dummy['status'], $paymentConfirmation->getStatus());
    }

    /**
     * @test
     */
    public function canGetPaymentDeliveryDate()
    {
        $data = '{"payment_date":"2019-06-07","payment_delivery_date":"2019-06-07T00:00:00+00:00","payment_cutoff_time":"2019-06-07T14:30:00+00:00","payment_type":"regular","currency":"GBP","bank_country":"GB"}';
        $entryPoint = new PaymentsEntryPoint(new SimpleEntityManager(),
            $this->getMockedClient(
                json_decode($data),
                'GET',
                'payments/payment_delivery_date',
                [
                    "payment_date" => "2019-06-07",
                    "payment_type" => "regular",
                    "currency" => "GBP",
                    "bank_country" => "GB"
                ]
            )
        );
        $deliveryDate = $entryPoint->paymentDeliveryDate(new DateTime("2019-06-07"), 'regular', 'GBP', 'GB');
        $this->assertSame('2019-06-07', $deliveryDate->getPaymentDate()->format('Y-m-d'));
        $this->assertSame('2019-06-07T00:00:00+00:00', $deliveryDate->getPaymentDeliveryDate()->format(DateTime::RFC3339));
        $this->assertSame('2019-06-07T14:30:00+00:00', $deliveryDate->getPaymentCutoffTime()->format(DateTime::RFC3339));
        $this->assertSame('regular', $deliveryDate->getPaymentType());
        $this->assertSame('GBP', $deliveryDate->getCurrency());
        $this->assertSame('GB', $deliveryDate->getBankCountry());
    }

    /**
     * @test
     */
    public function canGetQuotePaymentFee()
    {
        $data = '{
               "account_id": "0534aaf2-2egg-0134-2f36-10b11cd33cfb",
               "payment_currency": "USD",
               "payment_destination_country": "US",
               "payment_type": "regular",
               "charge_type": null,
               "fee_amount": "10.00",
               "fee_currency": "EUR"
             }';

        $entryPoint = new PaymentsEntryPoint(new SimpleEntityManager(),
            $this->getMockedClient(
                json_decode($data),
                'GET',
                'payments/quote_payment_fee',
                [
                    "payment_currency"=>"USD",
                    "payment_destination_country"=>"US",
                    "payment_type"=>"regular",
                    "charge_type"=>null,
                    "account_id"=>null
                ]
            )
        );
        $quotePaymentFee = $entryPoint->getQuotePaymentFee("USD","US","regular");
        $this->assertSame('0534aaf2-2egg-0134-2f36-10b11cd33cfb', $quotePaymentFee->getAccountId());
        $this->assertSame('USD', $quotePaymentFee->getPaymentCurrency());
        $this->assertSame('US', $quotePaymentFee->getPaymentDestinationCurrency());
        $this->assertSame('regular', $quotePaymentFee->getPaymentType());
        $this->assertSame('10.00', $quotePaymentFee->getFeeAmount());
        $this->assertSame('EUR', $quotePaymentFee->getFeeCurrency());
        $this->assertNull($quotePaymentFee->getChargeType());
    }
}
