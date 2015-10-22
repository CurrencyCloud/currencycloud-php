<?php

namespace CurrencyCloud\Tests\VCR\Reference;

use CurrencyCloud\Tests\BaseCurrencyCloudTestCase;

class Test extends BaseCurrencyCloudTestCase
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
        $i = 0;
        foreach ($dummy['invalid_conversion_dates'] as $date => $description) {
            $this->assertArrayHasKey($i, $invalidConversionDates);
            $this->assertEquals($date, $invalidConversionDates[$i]->getDate()->format('Y-m-d'));
            $this->assertEquals($description, $invalidConversionDates[$i++]->getDescription());
        }
    }
}
