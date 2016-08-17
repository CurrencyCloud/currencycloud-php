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
            '{"currencies":[{"code":"AED","name":"United Arab Emirates Dirham","online_trading":true,"decimal_places":2},{"code":"AUD","name":"Australian Dollar","online_trading":true,"decimal_places":2},{"code":"BGN","name":"Bulgarian Lev","online_trading":true,"decimal_places":2},{"code":"BHD","name":"Bahraini Dinar","online_trading":false,"decimal_places":2},{"code":"CAD","name":"Canadian Dollar","online_trading":true,"decimal_places":2},{"code":"CHF","name":"Swiss Franc","online_trading":true,"decimal_places":2},{"code":"CNY","name":"Chinese Yuan","online_trading":true,"decimal_places":1},{"code":"CZK","name":"Czech Koruna","online_trading":true,"decimal_places":2},{"code":"DKK","name":"Danish Krone","online_trading":true,"decimal_places":2},{"code":"EUR","name":"Euro","online_trading":true,"decimal_places":2},{"code":"GBP","name":"Pound Sterling","online_trading":true,"decimal_places":2},{"code":"HKD","name":"Hong Kong Dollar","online_trading":true,"decimal_places":2},{"code":"HRK","name":"Croatian Kuna","online_trading":false,"decimal_places":2},{"code":"HUF","name":"Hungarian Forint","online_trading":true,"decimal_places":2},{"code":"ILS","name":"Israeli New Sheqel","online_trading":true,"decimal_places":2},{"code":"JMD","name":"Jamaican Dollar","online_trading":false,"decimal_places":2},{"code":"JPY","name":"Japanese Yen","online_trading":true,"decimal_places":0},{"code":"KES","name":"Kenyan Shilling","online_trading":false,"decimal_places":2},{"code":"KWD","name":"Kuwaiti Dinar","online_trading":false,"decimal_places":2},{"code":"MXN","name":"Mexican Peso","online_trading":true,"decimal_places":2},{"code":"NOK","name":"Norwegian Krone","online_trading":true,"decimal_places":2},{"code":"NZD","name":"New Zealand Dollar","online_trading":true,"decimal_places":2},{"code":"OMR","name":"Omani Rial","online_trading":false,"decimal_places":2},{"code":"PLN","name":"Polish Zloty","online_trading":true,"decimal_places":2},{"code":"QAR","name":"Qatari Rial","online_trading":true,"decimal_places":2},{"code":"RON","name":"Romanian New Leu","online_trading":true,"decimal_places":2},{"code":"SAR","name":"Saudi Riyal","online_trading":true,"decimal_places":2},{"code":"SEK","name":"Swedish Krona","online_trading":true,"decimal_places":2},{"code":"SGD","name":"Singapore Dollar","online_trading":true,"decimal_places":2},{"code":"THB","name":"Thai Baht","online_trading":true,"decimal_places":2},{"code":"TRY","name":"Turkish Lira","online_trading":true,"decimal_places":2},{"code":"UGX","name":"Ugandan Shilling","online_trading":false,"decimal_places":0},{"code":"USD","name":"United States Dollar","online_trading":true,"decimal_places":2},{"code":"ZAR","name":"South African Rand","online_trading":true,"decimal_places":2}]}',
            true
        );

        $this->assertEquals(count($dummy['currencies']), count($currencies));
        foreach ($dummy['currencies'] as $k => $currency) {
            $this->assertArrayHasKey($k, $currencies);
            $this->assertEquals($currency['code'], $currencies[$k]->getCode());
            $this->assertEquals($currency['decimal_places'], $currencies[$k]->getDecimalPlaces());
            $this->assertEquals($currency['name'], $currencies[$k]->getName());
            $this->assertEquals((bool)$currency['online_trading'], $currencies[$k]->getOnlineTrading());
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
}
