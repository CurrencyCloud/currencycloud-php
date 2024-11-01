<?php

namespace CurrencyCloud\Tests\EntryPoint;

use CurrencyCloud\EntryPoint\CollectionsScreeningEntryPoint;
use CurrencyCloud\Model\ScreeningResponse;
use CurrencyCloud\Model\Result;
use CurrencyCloud\Tests\BaseCurrencyCloudTestCase;

class CollectionsScreeningEntryPointTest extends BaseCurrencyCloudTestCase
{

    /**
     * @test
     */
    public function canCompleteScreening()
    {
        $transactionId = "2f944410-bfe3-4d25-a301-9048c260d2cc";
        $accepted = "true";
        $reason = "Accepted";

        //Mocking the client and setting the expected PUT request with headers
        $clientMock = $this->getMockedClient(
            json_decode(json_encode(
                [
                    "transaction_id" => $transactionId,
                    "account_id" => "7a116d7d-6310-40ae-8d54-0ffbe41dc1c9",
                    "house_account_id" => "7a116d7d-6310-40ae-8d54-0ffbe41dc1c9",
                    "result" => [
                        'accepted' => $accepted,
                        'reason' => $reason
                    ]
                ])), "PUT", sprintf('collections_screening/%s/complete', $transactionId),
            [],
            [
                'accepted' => $accepted,
                'reason' => $reason
            ]
        );

        $entryPoint = new CollectionsScreeningEntryPoint($clientMock);

        //Calling the method to be tested
        $screeningTransaction = $entryPoint->canCompleteScreening($transactionId, $accepted, $reason);

        //Asserting the response values
        $this->assertInstanceOf(ScreeningResponse::class, $screeningTransaction);
        $this->assertSame($transactionId, $screeningTransaction->getTransactionId());
        $this->assertSame("7a116d7d-6310-40ae-8d54-0ffbe41dc1c9", $screeningTransaction->getAccountId());
        $this->assertSame("7a116d7d-6310-40ae-8d54-0ffbe41dc1c9", $screeningTransaction->getHouseAccountId());
        $this->assertInstanceOf(Result::class, $screeningTransaction->getResult());
        $this->assertSame($accepted, $screeningTransaction->getResult()->getAccepted());
        $this->assertSame($reason, $screeningTransaction->getResult()->getReason());
    }
}
