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
}
