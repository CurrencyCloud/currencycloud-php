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


    /**
     * @test
     */
    public function canGetBankDetails()
    {
        $data = '{"identifier_value":"GB19TCCL00997901654515","identifier_type":"iban","account_number":"GB19TCCL00997901654515","bic_swift":"TCCLGB22XXX","bank_name":"THE CURRENCY CLOUD LIMITED","bank_branch":"","bank_address":"12 STEWARD STREET  THE STEWARD BUILDING FLOOR 0","bank_city":"LONDON","bank_state":"LONDON","bank_post_code":"E1 6FQ","bank_country":"UNITED KINGDOM","bank_country_ISO":"GB","currency":null}';


        $entryPoint = new ReferenceEntryPoint(
            $this->getMockedClient(
                json_decode($data),
                'GET',
                'reference/bank_details',
                [
                    'identifier_type' => 'iban',
                    'identifier_value' => 'GB19TCCL00997901654515',
                ]
            )
        );

        $details = $entryPoint->bankDetails('iban', 'GB19TCCL00997901654515');


        $this->assertSame('GB19TCCL00997901654515', $details->getIdentifierValue());
        $this->assertSame('iban', $details->getIdentifierType());
        $this->assertSame('GB19TCCL00997901654515', $details->getAccountNumber());
        $this->assertSame('TCCLGB22XXX', $details->getBicSwift());
        $this->assertSame('THE CURRENCY CLOUD LIMITED', $details->getBankName());
        $this->assertSame('', $details->getBankBranch());
        $this->assertSame('12 STEWARD STREET  THE STEWARD BUILDING FLOOR 0', $details->getBankAddress());
        $this->assertSame('LONDON', $details->getBankCity());
        $this->assertSame('LONDON', $details->getBankState());
        $this->assertSame('E1 6FQ', $details->getBankPostCode());
        $this->assertSame('UNITED KINGDOM', $details->getBankCountry());
        $this->assertSame('GB', $details->getBankCountryISO());
        $this->assertSame('', $details->getCurrency());


    }

    /**
     * @test
     */
    public function canGetPaymentFeeRules_noParamters()
    {
        $data = '{
               "payment_fee_rules": [
                  {
                    "payment_type": "priority",
                    "charge_type": "shared",
                    "fee_amount": "2.00",
                    "fee_currency": "AED"
                  },
                  {
                    "payment_type": "regular",
                    "charge_type": "shared",
                    "fee_amount": "12.00",
                    "fee_currency": "USD"
                  },
                  {
                    "payment_type": "priority",
                    "charge_type": "ours",
                    "fee_amount": "5.25",
                    "fee_currency": "GBP"
                   }
                ]
             }';

        $entryPoint = new ReferenceEntryPoint(
            $this->getMockedClient(
                json_decode($data),
                'GET',
                'reference/payment_fee_rules',
                [
                    'account_id' => null,
                    'payment_type' => null,
                    'charge_type' => null
                ]
            )
        );

        $rules = $entryPoint->paymentFeeRules();

        $this->assertSame(3, count($rules));
        $this->assertSame("priority", $rules[0]->getPaymentType());
        $this->assertSame("shared", $rules[0]->getChargeType());
        $this->assertSame("2.00", $rules[0]->getFeeAmount());
        $this->assertSame("AED", $rules[0]->getFeeCurrency());

        $this->assertSame("regular", $rules[1]->getPaymentType());
        $this->assertSame("shared", $rules[1]->getChargeType());
        $this->assertSame("12.00", $rules[1]->getFeeAmount());
        $this->assertSame("USD", $rules[1]->getFeeCurrency());

        $this->assertSame("priority", $rules[2]->getPaymentType());
        $this->assertSame("ours", $rules[2]->getChargeType());
        $this->assertSame("5.25", $rules[2]->getFeeAmount());
        $this->assertSame("GBP", $rules[2]->getFeeCurrency());
    }

    /**
     * @test
     */
    public function canGetPaymentFeeRules_paymentTypeFilter()
    {
        $data = '{
               "payment_fee_rules": [
                  {
                    "payment_type": "regular",
                    "charge_type": "shared",
                    "fee_amount": "12.00",
                    "fee_currency": "USD"
                  }
                ]
             }';

        $entryPoint = new ReferenceEntryPoint(
            $this->getMockedClient(
                json_decode($data),
                'GET',
                'reference/payment_fee_rules',
                [
                    'account_id' => null,
                    'payment_type' => "regular",
                    'charge_type' => null
                ]
            )
        );

        $rules = $entryPoint->paymentFeeRules(null,"regular");

        $this->assertSame(1, count($rules));

        $this->assertSame("regular", $rules[0]->getPaymentType());
        $this->assertSame("shared", $rules[0]->getChargeType());
        $this->assertSame("12.00", $rules[0]->getFeeAmount());
        $this->assertSame("USD", $rules[0]->getFeeCurrency());
    }

    /**
     * @test
     */
    public function canGetPaymentFeeRules_chargeTypeFilter()
    {
        $data = '{
               "payment_fee_rules": [
                  {
                   "payment_type": "priority",
                   "charge_type": "ours",
                   "fee_amount": "5.25",
                   "fee_currency": "GBP"
                  }
                ]
             }';

        $entryPoint = new ReferenceEntryPoint(
            $this->getMockedClient(
                json_decode($data),
                'GET',
                'reference/payment_fee_rules',
                [
                    'account_id' => null,
                    'payment_type' => null,
                    'charge_type' => "ours"
                ]
            )
        );

        $rules = $entryPoint->paymentFeeRules(null,null, "ours");

        $this->assertSame(1, count($rules));

        $this->assertSame("priority", $rules[0]->getPaymentType());
        $this->assertSame("ours", $rules[0]->getChargeType());
        $this->assertSame("5.25", $rules[0]->getFeeAmount());
        $this->assertSame("GBP", $rules[0]->getFeeCurrency());
    }

    /**
     * @test
     */
    public function canGetPaymenPurposeCode()
    {
        $data = '{
    "purpose_codes": [
        {
            "bank_account_country": "IN",
            "currency": "INR",
            "entity_type": "individual",
            "purpose_code": "travel",
            "purpose_description": "Travel"
        },
        {
            "bank_account_country": "IN",
            "currency": "INR",
            "entity_type": "individual",
            "purpose_code": "services",
            "purpose_description": "Information service charges"
        },
        {
            "bank_account_country": "IN",
            "currency": "INR",
            "entity_type": "individual",
            "purpose_code": "education",
            "purpose_description": "Education-related student expenses"
        },
        {
            "bank_account_country": "IN",
            "currency": "INR",
            "entity_type": "individual",
            "purpose_code": "office",
            "purpose_description": "Representative office expenses"
        },
        {
            "bank_account_country": "IN",
            "currency": "INR",
            "entity_type": "individual",
            "purpose_code": "delivery",
            "purpose_description": "Delivery fees for goods"
        },
        {
            "bank_account_country": "IN",
            "currency": "INR",
            "entity_type": "individual",
            "purpose_code": "goods",
            "purpose_description": "Trade settlement for goods and general goods trades"
        },
        {
            "bank_account_country": "IN",
            "currency": "INR",
            "entity_type": "individual",
            "purpose_code": "medical",
            "purpose_description": "Medical treatment and expenses"
        },
        {
            "bank_account_country": "IN",
            "currency": "INR",
            "entity_type": "individual",
            "purpose_code": "advisor_fees",
            "purpose_description": "Fees for advisory, technical, academic or specialist assistance"
        },
        {
            "bank_account_country": "IN",
            "currency": "INR",
            "entity_type": "individual",
            "purpose_code": "loan_repayment",
            "purpose_description": "Repayment of loans"
        },
        {
            "bank_account_country": "IN",
            "currency": "INR",
            "entity_type": "individual",
            "purpose_code": "insurance_claims",
            "purpose_description": "Insurance claims payment"
        },
        {
            "bank_account_country": "IN",
            "currency": "INR",
            "entity_type": "individual",
            "purpose_code": "construction",
            "purpose_description": "Construction costs/expenses"
        },
        {
            "bank_account_country": "IN",
            "currency": "INR",
            "entity_type": "individual",
            "purpose_code": "transfer",
            "purpose_description": "Transfer to own account"
        },
        {
            "bank_account_country": "IN",
            "currency": "INR",
            "entity_type": "individual",
            "purpose_code": "advertising",
            "purpose_description": "Advertising and public relations-related expenses"
        },
        {
            "bank_account_country": "IN",
            "currency": "INR",
            "entity_type": "individual",
            "purpose_code": "property_purchase",
            "purpose_description": "Purchase of residential property"
        },
        {
            "bank_account_country": "IN",
            "currency": "INR",
            "entity_type": "individual",
            "purpose_code": "exports",
            "purpose_description": "Payments for exported goods"
        },
        {
            "bank_account_country": "IN",
            "currency": "INR",
            "entity_type": "individual",
            "purpose_code": "insurance_premium",
            "purpose_description": "Insurance premium"
        },
        {
            "bank_account_country": "IN",
            "currency": "INR",
            "entity_type": "individual",
            "purpose_code": "share_investment",
            "purpose_description": "Investment in shares"
        },
        {
            "bank_account_country": "IN",
            "currency": "INR",
            "entity_type": "individual",
            "purpose_code": "hotel",
            "purpose_description": "Hotel accommodation"
        },
        {
            "bank_account_country": "IN",
            "currency": "INR",
            "entity_type": "individual",
            "purpose_code": "other_fees",
            "purpose_description": "Broker, front end, commitment, guarantee and custodian fees"
        },
        {
            "bank_account_country": "IN",
            "currency": "INR",
            "entity_type": "individual",
            "purpose_code": "utilities",
            "purpose_description": "Utility bills"
        },
        {
            "bank_account_country": "IN",
            "currency": "INR",
            "entity_type": "individual",
            "purpose_code": "family",
            "purpose_description": "Family maintenance"
        },
        {
            "bank_account_country": "IN",
            "currency": "INR",
            "entity_type": "individual",
            "purpose_code": "tax",
            "purpose_description": "Tax payment"
        },
        {
            "bank_account_country": "IN",
            "currency": "INR",
            "entity_type": "individual",
            "purpose_code": "transportation",
            "purpose_description": "Transportation fees for goods"
        },
        {
            "bank_account_country": "IN",
            "currency": "INR",
            "entity_type": "individual",
            "purpose_code": "fund_investment",
            "purpose_description": "Mutual fund investment"
        },
        {
            "bank_account_country": "IN",
            "currency": "INR",
            "entity_type": "individual",
            "purpose_code": "royalties",
            "purpose_description": "Royalty, trademark, patent and copyright fees"
        }
        ]
        }';

        $entryPoint = new ReferenceEntryPoint(
            $this->getMockedClient(
                json_decode($data),
                'GET',
                'reference/payment_purpose_codes',
                [
                    'currency' => "INR",
                    'entity_type' => "individual",
                    'bank_account_country' => "IN"
                ]
            )
        );

        $purposeCodes = $entryPoint->paymentPurposeCodes("INR", "individual", "IN");

        $this->assertSame(25, count($purposeCodes));

        $this->assertSame("INR", $purposeCodes[0]->getCurrency());
        $this->assertSame("individual", $purposeCodes[0]->getEntityType());
        $this->assertSame("travel", $purposeCodes[0]->getPurposeCode());
        $this->assertSame("Travel", $purposeCodes[0]->getPurposeDescription());
    }
}
