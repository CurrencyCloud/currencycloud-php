<?php
namespace CurrencyCloud\Tests\VCR\Payers;

use CurrencyCloud\Tests\BaseCurrencyCloudVCRTestCase;
use DateTime;

class Test extends BaseCurrencyCloudVCRTestCase {

    /**
     * @vcr Payers/can_get_payers.yaml
     * @test
     */
    public function canGetPayer(){
        $payer = $this->getAuthenticatedClient()->payers()->retrieve("fa0b6125-6f81-4fc1-8861-544d7d5c9cdf");
        $this->assertSame("fa0b6125-6f81-4fc1-8861-544d7d5c9cdf",$payer->getId());
        $this->assertSame("individual",$payer->getLegalEntityType());
        $this->assertSame(null,$payer->getCompanyName());
        $this->assertSame("John",$payer->getFirstName());
        $this->assertSame("Test-Payer",$payer->getLastName());
        $this->assertSame("123 Big Street",$payer->getAddress());
        $this->assertSame("London",$payer->getCity());
        $this->assertSame(null,$payer->getStateOrProvince());
        $this->assertSame("GB",$payer->getCountry());
        $this->assertSame("W12",$payer->getPostcode());
        $this->assertSame("1969-12-31",$payer->getDateOfBirth()->format("Y-m-d"));
        $this->assertSame(null,$payer->getIdentificationType());
        $this->assertSame(null,$payer->getIdentificationValue());
        $this->assertSame("2020-06-16T16:57:14+00:00",$payer->getCreatedAt()->format(DateTime::RFC3339));
        $this->assertSame("2020-06-16T16:57:14+00:00",$payer->getUpdatedAt()->format(DateTime::RFC3339));
    }
}