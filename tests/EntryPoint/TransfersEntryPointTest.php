<?php
namespace CurrencyCloud\Tests\EntryPoint;

use CurrencyCloud\Criteria\FindTransferCriteria;
use CurrencyCloud\EntryPoint\TransfersEntryPoint;
use CurrencyCloud\Model\Pagination;
use CurrencyCloud\SimpleEntityManager;
use CurrencyCloud\Tests\BaseCurrencyCloudTestCase;

class TransfersEntryPointTest extends BaseCurrencyCloudTestCase {

    /**
     * @test
     */
    public function canGetTransfer(){
        $data = '{
            "id": "dbc1b2c3-fc83-439a-8ce9-5cdfc2cb321a",
            "short_reference": "BT-20180426-GKCRMN",
            "source_account_id": "72970a7c-7921-431c-b95f-3438724ba16f",
            "destination_account_id": "22ed17b5-b90c-424e-aa78-d24928b1778e",
            "currency": "EUR",
            "amount": "1000.00",
            "status": "completed",
            "reason": "Transfer Test",
            "created_at": "2018-04-26T15:47:46+00:00",
            "updated_at": "2018-04-26T15:47:46+00:00",
            "completed_at": "2018-04-26T15:47:46+00:00",
            "creator_account_id": "72970a7c-7921-431c-b95f-3438724ba16f",
            "creator_contact_id": "a66ca63f-e668-47af-8bb9-74363240d781",
            "unique_request_id":"12346534"
        }';

        $entrypoint = new TransfersEntryPoint(
            new SimpleEntityManager(),
            $this->getMockedClient(
                json_decode($data),
                'GET',
                'transfers/dbc1b2c3-fc83-439a-8ce9-5cdfc2cb321a',
                [
                    'on_behalf_of' => null
                ]
            )
        );

        $transfer = $entrypoint->retrieve('dbc1b2c3-fc83-439a-8ce9-5cdfc2cb321a');

        $dummy = json_decode($data,true);

        $this->assertSame($dummy['id'], $transfer->getId());
        $this->assertSame($dummy['short_reference'], $transfer->getShortReference());
        $this->assertSame($dummy['source_account_id'], $transfer->getSourceAccountId());
        $this->assertSame($dummy['destination_account_id'], $transfer->getDestinationAccountId());
        $this->assertSame($dummy['currency'], $transfer->getCurrency());
        $this->assertSame($dummy['amount'], $transfer->getAmount());
        $this->assertSame($dummy['status'], $transfer->getStatus());
        $this->assertSame($dummy['reason'], $transfer->getReason());
        $this->assertSame($dummy['unique_request_id'], $transfer->getUniqueRequestId());
    }

    /**
     * @test
     */
    public function canFindTransfers(){
        $data = '{
                "transfers": [
                {
                    "id": "dbc1b2c3-fc83-439a-8ce9-5cdfc2cb321a",
                    "short_reference": "BT-20180426-GKCRMN",
                    "source_account_id": "72970a7c-7921-431c-b95f-3438724ba16f",
                    "destination_account_id": "22ed17b5-b90c-424e-aa78-d24928b1778e",
                    "currency": "EUR",
                    "amount": "1000.00",
                    "status": "completed",
                    "reason": "Transfer Test",
                    "created_at": "2018-04-26T15:47:46+00:00",
                    "updated_at": "2018-04-26T15:47:46+00:00",
                    "completed_at": "2018-04-26T15:47:46+00:00",
                    "creator_account_id": "72970a7c-7921-431c-b95f-3438724ba16f",
                    "creator_contact_id": "a66ca63f-e668-47af-8bb9-74363240d781",
                    "unique_request_id":"1"
                },
                {
                    "id": "0594f892-7894-499d-9853-7cec86e27157",
                    "short_reference": "BT-20180427-BHNWDG",
                    "source_account_id": "cf28b2d8-5afa-4d7f-9a26-7b45bf616a11",
                    "destination_account_id": "22ed17b5-b90c-424e-aa78-d24928b1778e",
                    "currency": "GBP",
                    "amount": "100.00",
                    "status": "pending",
                    "reason": "",
                    "created_at": "2018-04-27T10:49:35+00:00",
                    "updated_at": "2018-04-27T10:49:35+00:00",
                    "completed_at": "",
                    "creator_account_id": "72970a7c-7921-431c-b95f-3438724ba16f",
                    "creator_contact_id": "a66ca63f-e668-47af-8bb9-74363240d781",
                    "unique_request_id":"2"
                },
                {
                    "id": "adda16ef-a754-4b86-a3cd-0bf9de7673d0",
                    "short_reference": "BT-20180427-CGRZWJ",
                    "source_account_id": "cf28b2d8-5afa-4d7f-9a26-7b45bf616a11",
                    "destination_account_id": "22ed17b5-b90c-424e-aa78-d24928b1778e",
                    "currency": "GBP",
                    "amount": "100.00",
                    "status": "pending",
                    "reason": "",
                    "created_at": "2018-04-27T10:56:00+00:00",
                    "updated_at": "2018-04-27T10:56:00+00:00",
                    "completed_at": "",
                    "creator_account_id": "72970a7c-7921-431c-b95f-3438724ba16f",
                    "creator_contact_id": "a66ca63f-e668-47af-8bb9-74363240d781",
                    "unique_request_id":"3"
                }
            ],
            "pagination": {
                "total_entries": 3,
                "total_pages": 1,
                "current_page": 1,
                "per_page": 25,
                "previous_page": -1,
                "next_page": -1,
                "order": "created_at",
                "order_asc_desc": "asc"
            }
        }';

        $entrypoint = new TransfersEntryPoint(
            new SimpleEntityManager(),
            $this->getMockedClient(
                json_decode($data),
                'GET',
                'transfers/find',
                [
                    'short_reference' => null,
                    'source_account_id' => null,
                    'destination_account_id' => null,
                    'status' => null,
                    'currency' => null,
                    'amount_from' => null,
                    'amount_to' => null,
                    'created_at_from' => null,
                    'created_at_to' => null,
                    'updated_at_from' => null,
                    'updated_at_to' => null,
                    'completed_at_from' => null,
                    'completed_at_to' => null,
                    'creator_account_id' => null,
                    'creator_contact_id' => null,
                    'page' => null,
                    'per_page' => null,
                    'order' => null,
                    'order_asc_desc' => null,
                    'on_behalf_of' => null,
                    'unique_request_id' => null
                ]
            )
        );

        $findTransfersCriteria = new FindTransferCriteria();
        $pagination = new Pagination();

        $transfers = $entrypoint->find($findTransfersCriteria, $pagination);

        $dummy = json_decode($data,true);

        $this->assertSame($dummy['pagination']['total_entries'], $transfers->getPagination()->getTotalEntries());

        foreach ($dummy['transfers'] as $key => $value){
            $this->assertSame($value['id'], $transfers->getTransfers()[$key]->getId());
            $this->assertSame($value['short_reference'], $transfers->getTransfers()[$key]->getShortReference());
            $this->assertSame($value['source_account_id'], $transfers->getTransfers()[$key]->getSourceAccountId());
            $this->assertSame($value['destination_account_id'], $transfers->getTransfers()[$key]->getDestinationAccountId());
            $this->assertSame($value['currency'], $transfers->getTransfers()[$key]->getCurrency());
            $this->assertSame($value['amount'], $transfers->getTransfers()[$key]->getAmount());
            $this->assertSame($value['status'], $transfers->getTransfers()[$key]->getStatus());
            $this->assertSame($value['reason'], $transfers->getTransfers()[$key]->getReason());
        }
    }

    /**
     * @test
     */
    public function canCreateTransfer(){
        $data = '{
            "id": "d7b775da-ab7c-4584-82f8-e036dbc2dafb",
            "short_reference": "BT-20181030-KVMTTT",
            "source_account_id": "cf28b2d8-5afa-4d7f-9a26-7b45bf616a11",
            "destination_account_id": "22ed17b5-b90c-424e-aa78-d24928b1778e",
            "currency": "GBP",
            "amount": "100.00",
            "status": "pending",
            "reason": null,
            "created_at": "2018-10-30T16:20:18+00:00",
            "updated_at": "2018-10-30T16:20:18+00:00",
            "completed_at": null,
            "creator_account_id": "72970a7c-7921-431c-b95f-3438724ba16f",
            "creator_contact_id": "a66ca63f-e668-47af-8bb9-74363240d781",
            "unique_request_id": null
        }';

        $entrypoint = new TransfersEntryPoint(
            new SimpleEntityManager(),
            $this->getMockedClient(
                json_decode($data),
                'POST',
                'transfers/create',
                [],
                [
                    'source_account_id' => 'cf28b2d8-5afa-4d7f-9a26-7b45bf616a11',
                    'destination_account_id' => '22ed17b5-b90c-424e-aa78-d24928b1778e',
                    'currency' => 'GBP',
                    'amount' => '100',
                    'reason' => null,
                    "unique_request_id" => null
                ]
            )
        );

        $transfer = $entrypoint->create(
            'cf28b2d8-5afa-4d7f-9a26-7b45bf616a11',
            '22ed17b5-b90c-424e-aa78-d24928b1778e',
            'GBP',
            '100'
        );

        $dummy = json_decode($data,true);

        $this->assertSame($dummy['id'], $transfer->getId());
        $this->assertSame($dummy['short_reference'], $transfer->getShortReference());
        $this->assertSame($dummy['source_account_id'], $transfer->getSourceAccountId());
        $this->assertSame($dummy['destination_account_id'], $transfer->getDestinationAccountId());
        $this->assertSame($dummy['currency'], $transfer->getCurrency());
        $this->assertSame($dummy['amount'], $transfer->getAmount());
        $this->assertSame($dummy['status'], $transfer->getStatus());
        $this->assertSame($dummy['reason'], $transfer->getReason());
    }
}