<?php

namespace CurrencyCloud\Tests\EntryPoint;

use CurrencyCloud\EntryPoint\ReferenceEntryPoint;
use CurrencyCloud\Tests\BaseCurrencyCloudTestCase;
use DateTime;

class ReferencesEntryPointTest extends BaseCurrencyCloudTestCase
{

    /**
     * @test
     */
    public function canGetPaymentDates()
    {
        $data = '{"invalid_payment_dates":{"2013-04-18":"Good Friday","2013-04-19":"No trading on Saturday"},"first_payment_date":"2013-04-15"}';

        $date = new DateTime();

        $entryPoint = new ReferenceEntryPoint(
            $this->getMockedClient(
            json_decode($data),
            'GET',
            'reference/payment_dates',
            [
                'currency' => 'EUR',
                'start_date' => $date->format(DateTime::ISO8601),
            ]
        )
        );

        $payments = $entryPoint->paymentDates('EUR', $date);

        $invalid = $payments->getInvalidPaymentDates();
        $first = $payments->getFirstPaymentDay();

        $this->assertSame('2013-04-15', $first->format('Y-m-d'));

        $temp = json_decode($data, true)['invalid_payment_dates'];

        $this->assertSame(count($temp), count($invalid));

        foreach ($invalid as $single) {
            $k = $single->getDate()->format('Y-m-d');
            $this->assertArrayHasKey($k, $temp);
            $this->assertSame($temp[$k], $single->getDescription());
        }
    }

    /**
     * @test
     */
    public function canGetPayerRequirementDetails()
    {
        $data = '{
            "details": [
                {
                    "payer_entity_type": "company",
                    "payment_type": "priority",
                    "required_fields": [
                        {
                            "name": "payer_country",
                            "validation_rule": "^[A-z]{2}$"
                        },
                        {
                            "name": "payer_city",
                            "validation_rule": "^.{1,255}"
                        },
                        {
                            "name": "payer_address",
                            "validation_rule": "^.{1,255}"
                        },
                        {
                            "name": "payer_company_name",
                            "validation_rule": "^.{1,255}"
                        },
                        {
                            "name": "payer_identification_value",
                            "validation_rule": "^.{1,255}"
                        }
                    ],
                    "payer_identification_type": "incorporation_number"
                },
                {
                    "payer_entity_type": "individual",
                    "payment_type": "priority",
                    "required_fields": [
                        {
                            "name": "payer_country",
                            "validation_rule": "^[A-z]{2}$"
                        },
                        {
                            "name": "payer_city",
                            "validation_rule": "^.{1,255}"
                        },
                        {
                            "name": "payer_address",
                            "validation_rule": "^.{1,255}"
                        },
                        {
                            "name": "payer_first_name",
                            "validation_rule": "^.{1,255}"
                        },
                        {
                            "name": "payer_last_name",
                            "validation_rule": "^.{1,255}"
                        },
                        {
                            "name": "payer_date_of_birth",
                            "validation_rule": "/A([+-]?d{4}(?!d{2}\b))((-?)((0[1-9]|1[0-2])(\u0003([12]d|0[1-9]|3[01]))?|W([0-4]d|5[0-2])(-?[1-7])?|(00[1-9]|0[1-9]d|[12]d{2}|3([0-5]d|6[1-6])))([T ]((([01]d|2[0-3])((:?)[0-5]d)?|24:?00)([.,]d+(?!:))?)?(\u000f[0-5]d([.,]d+)?)?([zZ]|([+-])([01]d|2[0-3]):?([0-5]d)?)?)?)?Z/"
                        }
                    ]
                },
                {
                    "payer_entity_type": "company",
                    "payment_type": "regular",
                    "required_fields": [
                        {
                            "name": "payer_country",
                            "validation_rule": "^[A-z]{2}$"
                        },
                        {
                            "name": "payer_city",
                            "validation_rule": "^.{1,255}"
                        },
                        {
                            "name": "payer_address",
                            "validation_rule": "^.{1,255}"
                        },
                        {
                            "name": "payer_company_name",
                            "validation_rule": "^.{1,255}"
                        }
                    ]
                },
                {
                    "payer_entity_type": "individual",
                    "payment_type": "regular",
                    "required_fields": [
                        {
                            "name": "payer_country",
                            "validation_rule": "^[A-z]{2}$"
                        },
                        {
                            "name": "payer_city",
                            "validation_rule": "^.{1,255}"
                        },
                        {
                            "name": "payer_address",
                            "validation_rule": "^.{1,255}"
                        },
                        {
                            "name": "payer_first_name",
                            "validation_rule": "^.{1,255}"
                        },
                        {
                            "name": "payer_last_name",
                            "validation_rule": "^.{1,255}"
                        },
                        {
                            "name": "payer_date_of_birth",
                            "validation_rule": "/A([+-]?d{4}(?!d{2}\b))((-?)((0[1-9]|1[0-2])(\u0003([12]d|0[1-9]|3[01]))?|W([0-4]d|5[0-2])(-?[1-7])?|(00[1-9]|0[1-9]d|[12]d{2}|3([0-5]d|6[1-6])))([T ]((([01]d|2[0-3])((:?)[0-5]d)?|24:?00)([.,]d+(?!:))?)?(\u000f[0-5]d([.,]d+)?)?([zZ]|([+-])([01]d|2[0-3]):?([0-5]d)?)?)?)?Z/"
                        }
                    ]
                }
            ]
        }';

        $entryPoint = new ReferenceEntryPoint(
            $this->getMockedClient(
                json_decode($data),
                'GET',
                'reference/payer_required_details',
                [
                    'payer_country' => 'GB',
                    'payer_entity_type' => null,
                    'payment_type' => null
                ]
            )
        );

        $payerRequiredDetails = $entryPoint->payerRequiredDetails('GB', "", "");

        $dummy = json_decode($data, true);

        $this->assertSame(count($dummy['details']), count($payerRequiredDetails->getPayerDetails()));

        $payerDetails = $payerRequiredDetails->getPayerDetails();

        foreach ($payerDetails as $key => $value) {
            $this->assertSame($dummy['details'][$key]['payer_entity_type'], $payerDetails[$key]->getPayerEntityType());
            $this->assertSame($dummy['details'][$key]['payment_type'], $payerDetails[$key]->getPaymentType());

            foreach($dummy['details'][$key]['required_fields'] as $innerKey => $innerValue){
                $this->assertSame($innerValue['name'], $payerDetails[$key]->getRequiredFields()[$innerKey]->getName());
                $this->assertSame($innerValue['validation_rule'], $payerDetails[$key]->getRequiredFields()[$innerKey]->getValidationRule());
            }
        }
    }
}
