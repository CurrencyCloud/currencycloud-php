<?php

namespace CurrencyCloud\tests\VCR\Collections;

use CurrencyCloud\Tests\BaseCurrencyCloudVCRTestCase;
use VCR\VCR;

class Test extends BaseCurrencyCloudVCRTestCase
{
    /** @test */
    public function canCompleteScreening()
    {

        VCR::insertCassette('Collections/can_complete_screening.yaml');

        $screeningDetails = $this
            ->getAuthenticatedClient()
            ->collections()
            ->canCompleteScreening(
                "2f944410-bfe3-4d25-a301-9048c260d2cc",
                "038022bcd2f372cac7bab448db7b5c3q",
                true,
                "Accepted");

        $dummy = json_decode(json_encode(
            '{"transaction_id":"2f944410-bfe3-4d25-a301-9048c260d2cc","account_id":"7a116d7d-6310-40ae-8d54-0ffbe41dc1c9",
            "house_account_id":"7a116d7d-6310-40ae-8d54-0ffbe41dc1c9","result":{"accepted":true,"reason":"Accepted"}}', true));

        $this->assertSame($dummy['transaction_id'], $screeningDetails->getTransactionId());
        $this->assertSame($dummy['account_id'], $screeningDetails->getAccountId());
        $this->assertSame($dummy['house_account_id'], $screeningDetails->getHouseAccountId());
        $this->assertSame($dummy['result'], $screeningDetails->getResult());
    }
}
