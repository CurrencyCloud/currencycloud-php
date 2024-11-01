<?php

namespace CurrencyCloud\Tests\VCR\Collections;

use CurrencyCloud\Tests\BaseCurrencyCloudVCRTestCase;
use VCR\VCR;

class Test extends BaseCurrencyCloudVCRTestCase
{
    /** @test */
    public function canCompleteScreening()
    {
        VCR::configure()
            ->setCassettePath('tests/fixtures/Collections')
            ->enableRequestMatchers(['method', 'url', 'host']);

        VCR::turnOn();

        VCR::insertCassette('can_complete_screening.yaml');

        $screeningDetails = $this
            ->getAuthenticatedClient()
            ->collections()
            ->canCompleteScreening(
                "2f944410-bfe3-4d25-a301-9048c260d2cc",
                true,
                "Accepted");

        $dummy = json_decode(
            '{"transaction_id":"2f944410-bfe3-4d25-a301-9048c260d2cc","account_id":"7a116d7d-6310-40ae-8d54-0ffbe41dc1c9",
            "house_account_id":"7a116d7d-6310-40ae-8d54-0ffbe41dc1c9","result":{"accepted":true,"reason":"Accepted"}}', true);

        $this->assertSame($dummy['transaction_id'], $screeningDetails->getTransactionId());
        $this->assertSame($dummy['account_id'], $screeningDetails->getAccountId());
        $this->assertSame($dummy['house_account_id'], $screeningDetails->getHouseAccountId());
        $this->assertSame($dummy['result']['accepted'], $screeningDetails->getResult()->getAccepted());
        $this->assertSame($dummy['result']['reason'], $screeningDetails->getResult()->getReason());
        VCR::eject();
    }
}
