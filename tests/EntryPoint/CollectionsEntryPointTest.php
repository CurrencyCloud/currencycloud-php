<?php

namespace CurrencyCloud\Tests\EntryPoint;

use CurrencyCloud\EntryPoint\CollectionsEntryPoint;
use CurrencyCloud\Tests\BaseCurrencyCloudTestCase;

class CollectionsEntryPointTest extends BaseCurrencyCloudTestCase
{

    /**
     * @test
     */
    public function canCompleteScreeningAccepted()
    {
        $data = '{
            "transaction_id": "bdcca5e6-32fe-45f6-9476-6f8f518e6270",
            "account_id": "7a116d7d-6310-40ae-8d54-0ffbe41dc1c9",
            "house_account_id": "7a116d7d-6310-40ae-8d54-0ffbe41dc1c9",
            "result": {
                "reason": "accepted",
                "accepted": true
            }
        }';

        $entryPoint = new CollectionsEntryPoint(
            $this->getMockedClient(
                json_decode($data),
                'PUT',
                'collections_screening/bdcca5e6-32fe-45f6-9476-6f8f518e6270/complete',
                [],
                [
                    'accepted' => true,
                    'reason' => 'accepted'
                ]
            )
        );

        $response = $entryPoint->completeScreening('bdcca5e6-32fe-45f6-9476-6f8f518e6270', true, 'accepted');

        $this->assertSame("bdcca5e6-32fe-45f6-9476-6f8f518e6270", $response->getTransactionId());
        $this->assertSame("7a116d7d-6310-40ae-8d54-0ffbe41dc1c9", $response->getAccountId());
        $this->assertSame("7a116d7d-6310-40ae-8d54-0ffbe41dc1c9", $response->getHouseAccountId());

        $result = $response->getResult();
        $this->assertSame("accepted", $result->getReason());
        $this->assertTrue($result->getAccepted());
    }

    /**
     * @test
     */
    public function canCompleteScreeningRejected()
    {
        $data = '{
            "transaction_id": "bdcca5e6-32fe-45f6-9476-6f8f518e6270",
            "account_id": "7a116d7d-6310-40ae-8d54-0ffbe41dc1c9",
            "house_account_id": "7a116d7d-6310-40ae-8d54-0ffbe41dc1c9",
            "result": {
                "reason": "suspected_fraud",
                "accepted": false
            }
        }';

        $entryPoint = new CollectionsEntryPoint(
            $this->getMockedClient(
                json_decode($data),
                'PUT',
                'collections_screening/bdcca5e6-32fe-45f6-9476-6f8f518e6270/complete',
                [],
                [
                    'accepted' => false,
                    'reason' => 'suspected_fraud'
                ]
            )
        );

        $response = $entryPoint->completeScreening('bdcca5e6-32fe-45f6-9476-6f8f518e6270', false, 'suspected_fraud');

        $this->assertSame("bdcca5e6-32fe-45f6-9476-6f8f518e6270", $response->getTransactionId());
        $this->assertSame("7a116d7d-6310-40ae-8d54-0ffbe41dc1c9", $response->getAccountId());
        $this->assertSame("7a116d7d-6310-40ae-8d54-0ffbe41dc1c9", $response->getHouseAccountId());

        $result = $response->getResult();
        $this->assertSame("suspected_fraud", $result->getReason());
        $this->assertFalse($result->getAccepted());
    }
}
