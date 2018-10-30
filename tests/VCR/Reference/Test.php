<?php

namespace CurrencyCloud\Tests\VCR\Reference;

use CurrencyCloud\Tests\BaseCurrencyCloudVCRTestCase;

class Test extends BaseCurrencyCloudVCRTestCase
{
    /**
     * @vcr Reference/can_retrieve_beneficiary_required_details.yaml
     * @test
     */
    public function canRetrieveBeneficiaryRequiredDetails()
    {

        $requiredDetails = $this->getAuthenticatedClient()->reference()->beneficiaryRequiredDetails('GBP', 'GB', 'GB');

        $dummy = json_decode(
            '{"details":[{"payment_type":"priority","beneficiary_entity_type":"individual","beneficiary_address":"^.{1,255}","beneficiary_city":"^.{1,255}","beneficiary_country":"^[A-z]{2}$","beneficiary_first_name":"^.{1,255}","beneficiary_last_name":"^.{1,255}","acct_number":"^[0-9A-Z]{1,50}$","sort_code":"^\\\\d{6}$"},{"payment_type":"priority","beneficiary_entity_type":"company","beneficiary_address":"^.{1,255}","beneficiary_city":"^.{1,255}","beneficiary_country":"^[A-z]{2}$","beneficiary_company_name":"^.{1,255}","acct_number":"^[0-9A-Z]{1,50}$","sort_code":"^\\\\d{6}$"},{"payment_type":"regular","acct_number":"^[0-9A-Z]{1,50}$","sort_code":"^\\\\d{6}$","beneficiary_entity_type":"individual"},{"payment_type":"regular","acct_number":"^[0-9A-Z]{1,50}$","sort_code":"^\\\\d{6}$","beneficiary_entity_type":"company"},{"payment_type":"priority","beneficiary_entity_type":"individual","beneficiary_address":"^.{1,255}","beneficiary_city":"^.{1,255}","beneficiary_country":"^[A-z]{2}$","beneficiary_first_name":"^.{1,255}","beneficiary_last_name":"^.{1,255}","iban":"^[0-9A-Z]{1,34}$","bic_swift":"^[0-9A-Z]{8}$|^[0-9A-Z]{11}$"},{"payment_type":"priority","beneficiary_entity_type":"company","beneficiary_address":"^.{1,255}","beneficiary_city":"^.{1,255}","beneficiary_country":"^[A-z]{2}$","beneficiary_company_name":"^.{1,255}","iban":"^[0-9A-Z]{1,34}$","bic_swift":"^[0-9A-Z]{8}$|^[0-9A-Z]{11}$"}]}',
            true
        );
        foreach ($dummy['details'] as $k => $detail) {
            $this->assertArrayHasKey($k, $requiredDetails);
            $this->assertTrue($detail == (array) $requiredDetails[$k]);
        }
    }

    /**
     * @vcr Reference/can_retrieve_conversion_dates.yaml
     * @test
     */
    public function canRetrieveConversionDates()
    {

        $conversionDates = $this->getAuthenticatedClient()->reference()->conversionDates('GBPUSD');

        $dummy = json_decode(
            '{"invalid_conversion_dates":{"2015-05-02":"No trading on Saturday","2015-05-03":"No trading on Sunday","2015-05-04":"Early May bank holiday","2015-05-09":"No trading on Saturday","2015-05-10":"No trading on Sunday","2015-05-16":"No trading on Saturday","2015-05-17":"No trading on Sunday","2015-05-23":"No trading on Saturday","2015-05-24":"No trading on Sunday","2015-05-25":"Spring bank holiday","2015-05-30":"No trading on Saturday","2015-05-31":"No trading on Sunday","2015-06-06":"No trading on Saturday","2015-06-07":"No trading on Sunday","2015-06-13":"No trading on Saturday","2015-06-14":"No trading on Sunday","2015-06-20":"No trading on Saturday","2015-06-21":"No trading on Sunday","2015-06-27":"No trading on Saturday","2015-06-28":"No trading on Sunday"},"first_conversion_date":"2015-04-30","default_conversion_date":"2015-04-30"}',
            true
        );
        $this->assertEquals($dummy['first_conversion_date'], $conversionDates->getFirstConversionDate()->format('Y-m-d'));
        $this->assertEquals($dummy['default_conversion_date'], $conversionDates->getDefaultConversionDate()->format('Y-m-d'));
        $invalidConversionDates = $conversionDates->getInvalidConversionDates();
        $this->assertEquals(count($dummy['invalid_conversion_dates']), count($invalidConversionDates));
        $i = 0;
        foreach ($dummy['invalid_conversion_dates'] as $date => $description) {
            $this->assertArrayHasKey($i, $invalidConversionDates);
            $this->assertEquals($date, $invalidConversionDates[$i]->getDate()->format('Y-m-d'));
            $this->assertEquals($description, $invalidConversionDates[$i++]->getDescription());
        }
    }

    /**
     * @vcr Reference/can_retrieve_currencies.yaml
     * @test
     */
    public function canRetrieveCurrencies()
    {

        $currencies = $this->getAuthenticatedClient()->reference()->availableCurrencies();

        $dummy = json_decode(
            '{"currencies":[{"code":"AED","decimal_places":2,"name":"United Arab Emirates Dirham"},{"code":"AUD","decimal_places":2,"name":"Australian Dollar"},{"code":"CAD","decimal_places":2,"name":"Canadian Dollar"},{"code":"CHF","decimal_places":2,"name":"Swiss Franc"},{"code":"CZK","decimal_places":2,"name":"Czech Koruna"},{"code":"DKK","decimal_places":2,"name":"Danish Krone"},{"code":"EUR","decimal_places":2,"name":"Euro"},{"code":"GBP","decimal_places":2,"name":"Pound Sterling"},{"code":"HKD","decimal_places":2,"name":"Hong Kong Dollar"},{"code":"HUF","decimal_places":2,"name":"Hungarian Forint"},{"code":"ILS","decimal_places":2,"name":"Israeli New Sheqel"},{"code":"JPY","decimal_places":0,"name":"Japanese Yen"},{"code":"MXN","decimal_places":2,"name":"Mexican Peso"},{"code":"NOK","decimal_places":2,"name":"Norwegian Krone"},{"code":"NZD","decimal_places":2,"name":"New Zealand Dollar"},{"code":"PLN","decimal_places":2,"name":"Polish Zloty"},{"code":"RON","decimal_places":2,"name":"Romanian New Leu"},{"code":"SEK","decimal_places":2,"name":"Swedish Krona"},{"code":"SGD","decimal_places":2,"name":"Singapore Dollar"},{"code":"THB","decimal_places":2,"name":"Thai Baht"},{"code":"TRY","decimal_places":2,"name":"Turkish Lira"},{"code":"USD","decimal_places":2,"name":"United States Dollar"},{"code":"ZAR","decimal_places":2,"name":"South African Rand"}]}',
            true
        );

        $this->assertEquals(count($dummy['currencies']), count($currencies));
        foreach ($dummy['currencies'] as $k => $currency) {
            $this->assertArrayHasKey($k, $currencies);
            $this->assertEquals($currency['code'], $currencies[$k]->getCode());
            $this->assertEquals($currency['decimal_places'], $currencies[$k]->getDecimalPlaces());
            $this->assertEquals($currency['name'], $currencies[$k]->getName());
        }
    }

    /**
     * @vcr Reference/can_retrieve_settlement_accounts.yaml
     * @test
     */
    public function canRetrieveSettlementAccounts()
    {

        $settlementAccounts = $this->getAuthenticatedClient()->reference()->settlementAccounts('GBP');

        $dummy = json_decode(
            '{"settlement_accounts":[{"bank_account_holder_name":"The Currency Cloud GBP - Client Seg A/C","beneficiary_address":"","beneficiary_country":"","bank_name":"Barclays Bank plc","bank_address":[],"bank_country":"","currency":"GBP","bic_swift":"BARCGB22","iban":"GB06 BARC 2006 0513 0714 72","account_number":"13071472","routing_code_type_1":"sort_code","routing_code_value_1":"200605","routing_code_type_2":"","routing_code_value_2":""}]}',
            true
        );

        $this->assertEquals(count($dummy['settlement_accounts']), count($settlementAccounts));
        foreach ($dummy['settlement_accounts'] as $k => $settlementAccount) {
            $this->assertArrayHasKey($k, $settlementAccounts);
            $this->validateObjectStrictName($settlementAccounts[$k], $settlementAccount);
        }
    }

    /**
     * @vcr Reference/can_get_payer_required_details.yaml
     * @test
     */
    public function canGetPayerRequiredDetails()
    {
        $dummy = json_decode(
            '{"details":[{"payer_entity_type":"company","payment_type":"priority","required_fields":[{"name":"payer_country","validation_rule":"^[A-z]{2}$"},{"name":"payer_city","validation_rule":"^.{1,255}"},{"name":"payer_address","validation_rule":"^.{1,255}"},{"name":"payer_company_name","validation_rule":"^.{1,255}"},{"name":"payer_identification_value","validation_rule":"^.{1,255}"}],"payer_identification_type":"incorporation_number"},{"payer_entity_type":"individual","payment_type":"priority","required_fields":[{"name":"payer_country","validation_rule":"^[A-z]{2}$"},{"name":"payer_city","validation_rule":"^.{1,255}"},{"name":"payer_address","validation_rule":"^.{1,255}"},{"name":"payer_first_name","validation_rule":"^.{1,255}"},{"name":"payer_last_name","validation_rule":"^.{1,255}"},{"name":"payer_date_of_birth","validation_rule":"/A([+-]?d{4}(?!d{2}\b))((-?)((0[1-9]|1[0-2])(\u0003([12]d|0[1-9]|3[01]))?|W([0-4]d|5[0-2])(-?[1-7])?|(00[1-9]|0[1-9]d|[12]d{2}|3([0-5]d|6[1-6])))([T ]((([01]d|2[0-3])((:?)[0-5]d)?|24:?00)([.,]d+(?!:))?)?(\u000f[0-5]d([.,]d+)?)?([zZ]|([+-])([01]d|2[0-3]):?([0-5]d)?)?)?)?Z/"}]},{"payer_entity_type":"company","payment_type":"regular","required_fields":[{"name":"payer_country","validation_rule":"^[A-z]{2}$"},{"name":"payer_city","validation_rule":"^.{1,255}"},{"name":"payer_address","validation_rule":"^.{1,255}"},{"name":"payer_company_name","validation_rule":"^.{1,255}"}]},{"payer_entity_type":"individual","payment_type":"regular","required_fields":[{"name":"payer_country","validation_rule":"^[A-z]{2}$"},{"name":"payer_city","validation_rule":"^.{1,255}"},{"name":"payer_address","validation_rule":"^.{1,255}"},{"name":"payer_first_name","validation_rule":"^.{1,255}"},{"name":"payer_last_name","validation_rule":"^.{1,255}"},{"name":"payer_date_of_birth","validation_rule":"/A([+-]?d{4}(?!d{2}\b))((-?)((0[1-9]|1[0-2])(\u0003([12]d|0[1-9]|3[01]))?|W([0-4]d|5[0-2])(-?[1-7])?|(00[1-9]|0[1-9]d|[12]d{2}|3([0-5]d|6[1-6])))([T ]((([01]d|2[0-3])((:?)[0-5]d)?|24:?00)([.,]d+(?!:))?)?(\u000f[0-5]d([.,]d+)?)?([zZ]|([+-])([01]d|2[0-3]):?([0-5]d)?)?)?)?Z/"}]}]        }',
            true
        );

        $payerRequiredDetails = $this->getAuthenticatedClient()->reference()->payerRequiredDetails('GB');
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
