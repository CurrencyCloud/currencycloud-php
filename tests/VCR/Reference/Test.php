<?php

namespace CurrencyCloud\Tests\VCR\Reference;

use CurrencyCloud\Tests\BaseCurrencyCloudVCRTestCase;
use DateTime;

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
            "{
                  \"first_conversion_cutoff_datetime\": \"2020-11-10T15:30:00+00:00\",
                  \"first_conversion_date\": \"2020-11-10\",
                  \"default_conversion_date\": \"2020-11-12\",
                  \"optimize_liquidity_conversion_date\": \"2020-11-12\",
                  \"invalid_conversion_dates\": {
                    \"2020-11-11\": \"Veterans' Day\",
                    \"2020-11-14\": \"No trading on Saturday\",
                    \"2020-11-15\": \"No trading on Sunday\",
                    \"2020-11-21\": \"No trading on Saturday\",
                    \"2020-11-22\": \"No trading on Sunday\",
                    \"2020-11-26\": \"Thanksgiving\",
                    \"2020-11-28\": \"No trading on Saturday\",
                    \"2020-11-29\": \"No trading on Sunday\",
                    \"2020-12-05\": \"No trading on Saturday\",
                    \"2020-12-06\": \"No trading on Sunday\",
                    \"2020-12-12\": \"No trading on Saturday\",
                    \"2020-12-13\": \"No trading on Sunday\",
                    \"2020-12-19\": \"No trading on Saturday\",
                    \"2020-12-20\": \"No trading on Sunday\",
                    \"2020-12-25\": \"Christmas\",
                    \"2020-12-26\": \"No trading on Saturday\",
                    \"2020-12-27\": \"No trading on Sunday\",
                    \"2020-12-28\": \"Boxing Day OBS\",
                    \"2021-01-01\": \"New Year's Day\",
                    \"2021-01-02\": \"No trading on Saturday\",
                    \"2021-01-03\": \"No trading on Sunday\",
                    \"2021-01-09\": \"No trading on Saturday\",
                    \"2021-01-10\": \"No trading on Sunday\",
                    \"2021-01-16\": \"No trading on Saturday\",
                    \"2021-01-17\": \"No trading on Sunday\",
                    \"2021-01-18\": \"Martin Luther King Jr. Day\",
                    \"2021-01-23\": \"No trading on Saturday\",
                    \"2021-01-24\": \"No trading on Sunday\",
                    \"2021-01-30\": \"No trading on Saturday\",
                    \"2021-01-31\": \"No trading on Sunday\",
                    \"2021-02-06\": \"No trading on Saturday\",
                    \"2021-02-07\": \"No trading on Sunday\",
                    \"2021-02-13\": \"No trading on Saturday\",
                    \"2021-02-14\": \"No trading on Sunday\",
                    \"2021-02-15\": \"Presidents' Day\",
                    \"2021-02-20\": \"No trading on Saturday\",
                    \"2021-02-21\": \"No trading on Sunday\",
                    \"2021-02-27\": \"No trading on Saturday\",
                    \"2021-02-28\": \"No trading on Sunday\",
                    \"2021-03-06\": \"No trading on Saturday\",
                    \"2021-03-07\": \"No trading on Sunday\",
                    \"2021-03-13\": \"No trading on Saturday\",
                    \"2021-03-14\": \"No trading on Sunday\",
                    \"2021-03-20\": \"No trading on Saturday\",
                    \"2021-03-21\": \"No trading on Sunday\",
                    \"2021-03-27\": \"No trading on Saturday\",
                    \"2021-03-28\": \"No trading on Sunday\",
                    \"2021-04-02\": \"Good Friday\",
                    \"2021-04-03\": \"No trading on Saturday\",
                    \"2021-04-04\": \"No trading on Sunday\",
                    \"2021-04-05\": \"Easter Monday\",
                    \"2021-04-10\": \"No trading on Saturday\",
                    \"2021-04-11\": \"No trading on Sunday\",
                    \"2021-04-17\": \"No trading on Saturday\",
                    \"2021-04-18\": \"No trading on Sunday\",
                    \"2021-04-24\": \"No trading on Saturday\",
                    \"2021-04-25\": \"No trading on Sunday\",
                    \"2021-05-01\": \"No trading on Saturday\",
                    \"2021-05-02\": \"No trading on Sunday\",
                    \"2021-05-03\": \"Early May Bank Holiday\",
                    \"2021-05-08\": \"No trading on Saturday\",
                    \"2021-05-09\": \"No trading on Sunday\",
                    \"2021-05-15\": \"No trading on Saturday\",
                    \"2021-05-16\": \"No trading on Sunday\",
                    \"2021-05-22\": \"No trading on Saturday\",
                    \"2021-05-23\": \"No trading on Sunday\",
                    \"2021-05-29\": \"No trading on Saturday\",
                    \"2021-05-30\": \"No trading on Sunday\",
                    \"2021-05-31\": \"Memorial Day\",
                    \"2021-06-05\": \"No trading on Saturday\",
                    \"2021-06-06\": \"No trading on Sunday\",
                    \"2021-06-12\": \"No trading on Saturday\",
                    \"2021-06-13\": \"No trading on Sunday\",
                    \"2021-06-19\": \"No trading on Saturday\",
                    \"2021-06-20\": \"No trading on Sunday\",
                    \"2021-06-26\": \"No trading on Saturday\",
                    \"2021-06-27\": \"No trading on Sunday\",
                    \"2021-07-03\": \"No trading on Saturday\",
                    \"2021-07-04\": \"No trading on Sunday\",
                    \"2021-07-05\": \"Independence Day OBS\",
                    \"2021-07-10\": \"No trading on Saturday\",
                    \"2021-07-11\": \"No trading on Sunday\",
                    \"2021-07-17\": \"No trading on Saturday\",
                    \"2021-07-18\": \"No trading on Sunday\",
                    \"2021-07-24\": \"No trading on Saturday\",
                    \"2021-07-25\": \"No trading on Sunday\",
                    \"2021-07-31\": \"No trading on Saturday\",
                    \"2021-08-01\": \"No trading on Sunday\",
                    \"2021-08-07\": \"No trading on Saturday\",
                    \"2021-08-08\": \"No trading on Sunday\",
                    \"2021-08-14\": \"No trading on Saturday\",
                    \"2021-08-15\": \"No trading on Sunday\",
                    \"2021-08-21\": \"No trading on Saturday\",
                    \"2021-08-22\": \"No trading on Sunday\",
                    \"2021-08-28\": \"No trading on Saturday\",
                    \"2021-08-29\": \"No trading on Sunday\",
                    \"2021-08-30\": \"Summer Bank Holiday\",
                    \"2021-09-04\": \"No trading on Saturday\",
                    \"2021-09-05\": \"No trading on Sunday\",
                    \"2021-09-06\": \"Labor Day\",
                    \"2021-09-11\": \"No trading on Saturday\",
                    \"2021-09-12\": \"No trading on Sunday\",
                    \"2021-09-18\": \"No trading on Saturday\",
                    \"2021-09-19\": \"No trading on Sunday\",
                    \"2021-09-25\": \"No trading on Saturday\",
                    \"2021-09-26\": \"No trading on Sunday\",
                    \"2021-10-02\": \"No trading on Saturday\",
                    \"2021-10-03\": \"No trading on Sunday\",
                    \"2021-10-09\": \"No trading on Saturday\",
                    \"2021-10-10\": \"No trading on Sunday\",
                    \"2021-10-11\": \"Columbus Day\",
                    \"2021-10-16\": \"No trading on Saturday\",
                    \"2021-10-17\": \"No trading on Sunday\",
                    \"2021-10-23\": \"No trading on Saturday\",
                    \"2021-10-24\": \"No trading on Sunday\",
                    \"2021-10-30\": \"No trading on Saturday\",
                    \"2021-10-31\": \"No trading on Sunday\",
                    \"2021-11-06\": \"No trading on Saturday\",
                    \"2021-11-07\": \"No trading on Sunday\",
                    \"2021-11-11\": \"Veterans' Day\",
                    \"2021-11-13\": \"No trading on Saturday\",
                    \"2021-11-14\": \"No trading on Sunday\",
                    \"2021-11-20\": \"No trading on Saturday\",
                    \"2021-11-21\": \"No trading on Sunday\",
                    \"2021-11-25\": \"Thanksgiving\",
                    \"2021-11-27\": \"No trading on Saturday\",
                    \"2021-11-28\": \"No trading on Sunday\",
                    \"2021-12-04\": \"No trading on Saturday\",
                    \"2021-12-05\": \"No trading on Sunday\",
                    \"2021-12-11\": \"No trading on Saturday\",
                    \"2021-12-12\": \"No trading on Sunday\",
                    \"2021-12-18\": \"No trading on Saturday\",
                    \"2021-12-19\": \"No trading on Sunday\",
                    \"2021-12-25\": \"No trading on Saturday\",
                    \"2021-12-26\": \"No trading on Sunday\",
                    \"2021-12-27\": \"Christmas OBS\",
                    \"2021-12-28\": \"Boxing Day OBS\",
                    \"2022-01-01\": \"No trading on Saturday\",
                    \"2022-01-02\": \"No trading on Sunday\",
                    \"2022-01-03\": \"New Year's Day OBS\",
                    \"2022-01-08\": \"No trading on Saturday\",
                    \"2022-01-09\": \"No trading on Sunday\",
                    \"2022-01-15\": \"No trading on Saturday\",
                    \"2022-01-16\": \"No trading on Sunday\",
                    \"2022-01-17\": \"Martin Luther King Jr. Day\",
                    \"2022-01-22\": \"No trading on Saturday\",
                    \"2022-01-23\": \"No trading on Sunday\",
                    \"2022-01-29\": \"No trading on Saturday\",
                    \"2022-01-30\": \"No trading on Sunday\",
                    \"2022-02-05\": \"No trading on Saturday\",
                    \"2022-02-06\": \"No trading on Sunday\",
                    \"2022-02-12\": \"No trading on Saturday\",
                    \"2022-02-13\": \"No trading on Sunday\",
                    \"2022-02-19\": \"No trading on Saturday\",
                    \"2022-02-20\": \"No trading on Sunday\",
                    \"2022-02-21\": \"Presidents' Day\",
                    \"2022-02-26\": \"No trading on Saturday\",
                    \"2022-02-27\": \"No trading on Sunday\",
                    \"2022-03-05\": \"No trading on Saturday\",
                    \"2022-03-06\": \"No trading on Sunday\",
                    \"2022-03-12\": \"No trading on Saturday\",
                    \"2022-03-13\": \"No trading on Sunday\",
                    \"2022-03-19\": \"No trading on Saturday\",
                    \"2022-03-20\": \"No trading on Sunday\",
                    \"2022-03-26\": \"No trading on Saturday\",
                    \"2022-03-27\": \"No trading on Sunday\",
                    \"2022-04-02\": \"No trading on Saturday\",
                    \"2022-04-03\": \"No trading on Sunday\",
                    \"2022-04-09\": \"No trading on Saturday\",
                    \"2022-04-10\": \"No trading on Sunday\",
                    \"2022-04-15\": \"Good Friday\",
                    \"2022-04-16\": \"No trading on Saturday\",
                    \"2022-04-17\": \"No trading on Sunday\",
                    \"2022-04-18\": \"Easter Monday\",
                    \"2022-04-23\": \"No trading on Saturday\",
                    \"2022-04-24\": \"No trading on Sunday\",
                    \"2022-04-30\": \"No trading on Saturday\",
                    \"2022-05-01\": \"No trading on Sunday\",
                    \"2022-05-02\": \"Early May Bank Holiday\",
                    \"2022-05-07\": \"No trading on Saturday\",
                    \"2022-05-08\": \"No trading on Sunday\",
                    \"2022-05-14\": \"No trading on Saturday\",
                    \"2022-05-15\": \"No trading on Sunday\",
                    \"2022-05-21\": \"No trading on Saturday\",
                    \"2022-05-22\": \"No trading on Sunday\",
                    \"2022-05-28\": \"No trading on Saturday\",
                    \"2022-05-29\": \"No trading on Sunday\",
                    \"2022-05-30\": \"Memorial Day\",
                    \"2022-06-04\": \"No trading on Saturday\",
                    \"2022-06-05\": \"No trading on Sunday\",
                    \"2022-06-11\": \"No trading on Saturday\",
                    \"2022-06-12\": \"No trading on Sunday\",
                    \"2022-06-18\": \"No trading on Saturday\",
                    \"2022-06-19\": \"No trading on Sunday\",
                    \"2022-06-25\": \"No trading on Saturday\",
                    \"2022-06-26\": \"No trading on Sunday\",
                    \"2022-07-02\": \"No trading on Saturday\",
                    \"2022-07-03\": \"No trading on Sunday\",
                    \"2022-07-04\": \"Independence Day\",
                    \"2022-07-09\": \"No trading on Saturday\",
                    \"2022-07-10\": \"No trading on Sunday\",
                    \"2022-07-16\": \"No trading on Saturday\",
                    \"2022-07-17\": \"No trading on Sunday\",
                    \"2022-07-23\": \"No trading on Saturday\",
                    \"2022-07-24\": \"No trading on Sunday\",
                    \"2022-07-30\": \"No trading on Saturday\",
                    \"2022-07-31\": \"No trading on Sunday\",
                    \"2022-08-06\": \"No trading on Saturday\",
                    \"2022-08-07\": \"No trading on Sunday\",
                    \"2022-08-13\": \"No trading on Saturday\",
                    \"2022-08-14\": \"No trading on Sunday\",
                    \"2022-08-20\": \"No trading on Saturday\",
                    \"2022-08-21\": \"No trading on Sunday\",
                    \"2022-08-27\": \"No trading on Saturday\",
                    \"2022-08-28\": \"No trading on Sunday\",
                    \"2022-08-29\": \"Summer Bank Holiday\",
                    \"2022-09-03\": \"No trading on Saturday\",
                    \"2022-09-04\": \"No trading on Sunday\",
                    \"2022-09-05\": \"Labor Day\",
                    \"2022-09-10\": \"No trading on Saturday\",
                    \"2022-09-11\": \"No trading on Sunday\",
                    \"2022-09-17\": \"No trading on Saturday\",
                    \"2022-09-18\": \"No trading on Sunday\",
                    \"2022-09-24\": \"No trading on Saturday\",
                    \"2022-09-25\": \"No trading on Sunday\",
                    \"2022-10-01\": \"No trading on Saturday\",
                    \"2022-10-02\": \"No trading on Sunday\",
                    \"2022-10-08\": \"No trading on Saturday\",
                    \"2022-10-09\": \"No trading on Sunday\",
                    \"2022-10-10\": \"Columbus Day\",
                    \"2022-10-15\": \"No trading on Saturday\",
                    \"2022-10-16\": \"No trading on Sunday\",
                    \"2022-10-22\": \"No trading on Saturday\",
                    \"2022-10-23\": \"No trading on Sunday\",
                    \"2022-10-29\": \"No trading on Saturday\",
                    \"2022-10-30\": \"No trading on Sunday\",
                    \"2022-11-05\": \"No trading on Saturday\",
                    \"2022-11-06\": \"No trading on Sunday\",
                    \"2022-11-11\": \"Veterans' Day\",
                    \"2022-11-24\": \"Thanksgiving\",
                    \"2022-12-26\": \"Christmas OBS\",
                    \"2022-12-27\": \"Boxing Day OBS\"
                  }
                  }",
            true
        );
        $this->assertEquals($dummy['first_conversion_date'], $conversionDates->getFirstConversionDate()->format('Y-m-d'));
        $this->assertEquals($dummy['default_conversion_date'], $conversionDates->getDefaultConversionDate()->format('Y-m-d'));
        $this->assertEquals($dummy['first_conversion_cutoff_datetime'], $conversionDates->getFirstConversionCutoffDatetime()->format(DateTime::RFC3339));
        $this->assertEquals($dummy['optimize_liquidity_conversion_date'], $conversionDates->getOptimizeLiquidityConversionDate()->format('Y-m-d'));
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
            '{"currencies":[{"code":"AED","decimal_places":2,"name":"United Arab Emirates Dirham","online_trading":true,"can_buy":true,"can_sell":true},{"code":"AUD","decimal_places":2,"name":"Australian Dollar","online_trading":true,"can_buy":true,"can_sell":true},{"code":"BGN","decimal_places":2,"name":"Bulgarian Lev","online_trading":true,"can_buy":true,"can_sell":true},{"code":"BHD","decimal_places":2,"name":"Bahraini Dinar","online_trading":true,"can_buy":true,"can_sell":true},{"code":"CAD","decimal_places":2,"name":"Canadian Dollar","online_trading":true,"can_buy":true,"can_sell":true},{"code":"CHF","decimal_places":2,"name":"Swiss Franc","online_trading":true,"can_buy":true,"can_sell":true},{"code":"CNY","decimal_places":2,"name":"Chinese Yuan","online_trading":true,"can_buy":true,"can_sell":true},{"code":"CZK","decimal_places":2,"name":"Czech Koruna","online_trading":true,"can_buy":true,"can_sell":true},{"code":"DKK","decimal_places":2,"name":"Danish Krone","online_trading":true,"can_buy":true,"can_sell":true},{"code":"EUR","decimal_places":2,"name":"Euro","online_trading":true,"can_buy":true,"can_sell":true},{"code":"GBP","decimal_places":2,"name":"British Pound","online_trading":true,"can_buy":true,"can_sell":true},{"code":"HKD","decimal_places":2,"name":"Hong Kong Dollar","online_trading":true,"can_buy":true,"can_sell":true},{"code":"HRK","decimal_places":2,"name":"Croatian Kuna","online_trading":true,"can_buy":true,"can_sell":true},{"code":"HUF","decimal_places":2,"name":"Hungarian Forint","online_trading":true,"can_buy":true,"can_sell":true},{"code":"ILS","decimal_places":2,"name":"Israeli New Sheqel","online_trading":true,"can_buy":true,"can_sell":true},{"code":"INR","decimal_places":2,"name":"Indian Rupee","online_trading":true,"can_buy":true,"can_sell":false},{"code":"JPY","decimal_places":0,"name":"Japanese Yen","online_trading":true,"can_buy":true,"can_sell":true},{"code":"KES","decimal_places":2,"name":"Kenyan Shilling","online_trading":true,"can_buy":true,"can_sell":true},{"code":"KWD","decimal_places":2,"name":"Kuwaiti Dinar","online_trading":true,"can_buy":true,"can_sell":true},{"code":"MXN","decimal_places":2,"name":"Mexican Peso","online_trading":true,"can_buy":true,"can_sell":false},{"code":"NOK","decimal_places":2,"name":"Norwegian Krone","online_trading":true,"can_buy":true,"can_sell":true},{"code":"NZD","decimal_places":2,"name":"New Zealand Dollar","online_trading":true,"can_buy":true,"can_sell":true},{"code":"OMR","decimal_places":2,"name":"Omani Rial","online_trading":true,"can_buy":true,"can_sell":true},{"code":"PLN","decimal_places":2,"name":"Polish Zloty","online_trading":true,"can_buy":true,"can_sell":true},{"code":"QAR","decimal_places":2,"name":"Qatari Rial","online_trading":true,"can_buy":true,"can_sell":true},{"code":"RON","decimal_places":2,"name":"Romanian New Leu","online_trading":true,"can_buy":true,"can_sell":true},{"code":"SAR","decimal_places":2,"name":"Saudi Riyal","online_trading":true,"can_buy":true,"can_sell":true},{"code":"SEK","decimal_places":2,"name":"Swedish Krona","online_trading":true,"can_buy":true,"can_sell":true},{"code":"SGD","decimal_places":2,"name":"Singapore Dollar","online_trading":true,"can_buy":true,"can_sell":true},{"code":"THB","decimal_places":2,"name":"Thai Baht","online_trading":true,"can_buy":true,"can_sell":true},{"code":"TRY","decimal_places":2,"name":"Turkish Lira","online_trading":true,"can_buy":true,"can_sell":true},{"code":"UGX","decimal_places":0,"name":"Ugandan Shilling","online_trading":true,"can_buy":true,"can_sell":true},{"code":"USD","decimal_places":2,"name":"United States Dollar","online_trading":true,"can_buy":true,"can_sell":true},{"code":"ZAR","decimal_places":2,"name":"South African Rand","online_trading":true,"can_buy":true,"can_sell":true}]}',
            true
        );

        $this->assertEquals(count($dummy['currencies']), count($currencies));
        foreach ($dummy['currencies'] as $k => $currency) {
            $this->assertArrayHasKey($k, $currencies);
            $this->assertEquals($currency['code'], $currencies[$k]->getCode());
            $this->assertEquals($currency['decimal_places'], $currencies[$k]->getDecimalPlaces());
            $this->assertEquals($currency['name'], $currencies[$k]->getName());
            $this->assertEquals($currency['online_trading'], $currencies[$k]->getOnlineTrading());
            $this->assertEquals($currency['can_buy'], $currencies[$k]->getCanBuy());
            $this->assertEquals($currency['can_sell'], $currencies[$k]->getCanSell());
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
