<?php
namespace CurrencyCloud\Tests\VCR\Payers;

use CurrencyCloud\Model\Pagination;
use CurrencyCloud\Tests\BaseCurrencyCloudVCRTestCase;

class Test extends BaseCurrencyCloudVCRTestCase {

    /**
     * @vcr Payers/can_get_payers.yaml
     * @test
     */
    public function canGetPayers(){

        $vansCollection = $this->getAuthenticatedClient()->payers()->retrieve("fa0b6125-6f81-4fc1-8861-544d7d5c9cdf");

    }
}