<?php

namespace CurrencyCloud\Tests\EntryPoint;

use CurrencyCloud\Criteria\FindSettlementsCriteria;
use CurrencyCloud\EntryPoint\SettlementsEntryPoint;
use CurrencyCloud\EntryPoint\TransactionsEntryPoint;
use CurrencyCloud\Model\Settlement;
use CurrencyCloud\Model\Settlements;
use CurrencyCloud\Model\Transaction;
use CurrencyCloud\Model\Transactions;
use CurrencyCloud\SimpleEntityManager;
use CurrencyCloud\Tests\BaseCurrencyCloudTestCase;
use DateTime;

class TransactionsEntryPointTest extends BaseCurrencyCloudTestCase
{

    /**
     * @test
     */
    public function canRetrieve()
    {
        $data = '{"id":"c5a990eb-d4d7-482f-bfb1-695261fb1e4d","balance_id":"c5f1f54e-d6d8-4140-8110-f5b99bbc80c3","account_id":"7b9757a8-eee9-4572-86e6-77f4d711eaa6","currency":"USD","amount":"1000.00","balance_amount":"2000.00","type":"credit","action":"conversion","related_entity_type":"conversion","related_entity_id":"ConversionUUID","related_entity_short_reference":"140416-GGJBNQ001","status":"completed","reason":"Reason for Transaction","settles_at":"2014-01-12T12:24:19+00:00","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","completed_at":"2014-01-12T12:24:19+00:00"}';

        $entryPoint = new TransactionsEntryPoint(
            $this->getMockedClient(
            json_decode($data),
            'GET',
            'transactions/hi',
            [
                'on_behalf_of' => null
            ]
        )
        );

        $entity = $entryPoint->retrieve('hi');

        $temp = json_decode($data, true);

        $this->validateObjectStrictName($entity, $temp);
    }

    /**
     * @test
     */
    public function canRetrieveWithOnBehalfOf()
    {
        $data = '{"id":"c5a990eb-d4d7-482f-bfb1-695261fb1e4d","balance_id":"c5f1f54e-d6d8-4140-8110-f5b99bbc80c3","account_id":"7b9757a8-eee9-4572-86e6-77f4d711eaa6","currency":"USD","amount":"1000.00","balance_amount":"2000.00","type":"credit","action":"conversion","related_entity_type":"conversion","related_entity_id":"ConversionUUID","related_entity_short_reference":"140416-GGJBNQ001","status":"completed","reason":"Reason for Transaction","settles_at":"2014-01-12T12:24:19+00:00","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","completed_at":"2014-01-12T12:24:19+00:00"}';

        $entryPoint = new TransactionsEntryPoint(
            $this->getMockedClient(
            json_decode($data),
            'GET',
            'transactions/hi',
            [
                'on_behalf_of' => 'me'
            ]
        )
        );

        $entity = $entryPoint->retrieve('hi', 'me');

        $temp = json_decode($data, true);

        $this->validateObjectStrictName($entity, $temp);
    }

    /**
     * @test
     */
    public function canFind()
    {
        $data = '{"transactions":[{"id":"c5a990eb-d4d7-482f-bfb1-695261fb1e4d","balance_id":"c5f1f54e-d6d8-4140-8110-f5b99bbc80c3","account_id":"7b9757a8-eee9-4572-86e6-77f4d711eaa6","currency":"USD","amount":"1000.00","balance_amount":"2000.00","type":"credit","action":"conversion","related_entity_type":"conversion","related_entity_id":"e93e322f-93aa-4d31-b050-449da723db0b","related_entity_short_reference":"140416-GGJBNQ001","status":"completed","reason":"Reason for Transaction","settles_at":"2014-01-12T12:24:19+00:00","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","completed_at":"2014-01-12T12:24:19+00:00"}],"pagination":{"total_entries":1,"total_pages":1,"current_page":1,"previous_page":-1,"next_page":-1,"per_page":25,"order":"created_at","order_asc_desc":"asc"}}';

        $entryPoint = new TransactionsEntryPoint(
            $this->getMockedClient(
            json_decode($data),
            'GET',
            'transactions/find',
            [
                'currency' => null,
                'amount' => null,
                'action' => null,
                'related_entity_type' => null,
                'related_entity_id' => null,
                'related_entity_short_reference' => null,
                'status' => null,
                'type' => null,
                'reason' => null,
                'on_behalf_of' => null,
                'amount_from' => null,
                'amount_to' => null,
                'settles_at_from' => null,
                'settles_at_to' => null,
                'created_at_from' => null,
                'created_at_to' => null,
                'updated_at_from' => null,
                'updated_at_to' => null,
                'completed_at_from' => null,
                'completed_at_to' => null,
                'page' => null,
                'per_page' => null,
                'order' => null,
                'order_asc_desc' => null,
                'scope' => null
            ]
        )
        );

        $transactions = $entryPoint->find();

        $this->assertInstanceOf(Transactions::class, $transactions);
        $list = $transactions->getTransactions();

        $this->assertArrayHasKey(0, $list);
        $this->assertCount(1, $list);

        $this->validateObjectStrictName($list[0], json_decode($data, true)['transactions'][0]);
    }

    /**
     * @test
     */
    public function canFindWithAllParams()
    {
        $data = '{"transactions":[{"id":"c5a990eb-d4d7-482f-bfb1-695261fb1e4d","balance_id":"c5f1f54e-d6d8-4140-8110-f5b99bbc80c3","account_id":"7b9757a8-eee9-4572-86e6-77f4d711eaa6","currency":"USD","amount":"1000.00","balance_amount":"2000.00","type":"credit","action":"conversion","related_entity_type":"conversion","related_entity_id":"e93e322f-93aa-4d31-b050-449da723db0b","related_entity_short_reference":"140416-GGJBNQ001","status":"completed","reason":"Reason for Transaction","settles_at":"2014-01-12T12:24:19+00:00","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","completed_at":"2014-01-12T12:24:19+00:00"}],"pagination":{"total_entries":1,"total_pages":1,"current_page":1,"previous_page":-1,"next_page":-1,"per_page":25,"order":"created_at","order_asc_desc":"asc"}}';

        /* @var DateTime[] $dateTimes */
        $dateTimes = [
            new DateTime(),
            (new DateTime())->modify('-1 hour'),
            (new DateTime())->modify('-2 hour'),
            (new DateTime())->modify('-3 hour'),
            (new DateTime())->modify('-4 hour'),
            (new DateTime())->modify('-5 hour'),
            (new DateTime())->modify('-6 hour'),
            (new DateTime())->modify('-7 hour'),
        ];

        $entryPoint = new TransactionsEntryPoint(
            $this->getMockedClient(
            json_decode($data),
            'GET',
            'transactions/find',
            [
                'currency' => 'C',
                'amount' => 'D',
                'action' => 'E',
                'related_entity_type' => 'F',
                'related_entity_id' => 'G',
                'related_entity_short_reference' => 'H',
                'status' => 'I',
                'type' => 'J',
                'reason' => 'K',
                'on_behalf_of' => 'L',
                'amount_from' => 'A',
                'amount_to' => 'B',
                'settles_at_from' => $dateTimes[0]->format(TransactionsEntryPoint::DATE_FORMAT),
                'settles_at_to' => $dateTimes[1]->format(TransactionsEntryPoint::DATE_FORMAT),
                'created_at_from' => $dateTimes[2]->format(TransactionsEntryPoint::DATE_FORMAT),
                'created_at_to' => $dateTimes[3]->format(TransactionsEntryPoint::DATE_FORMAT),
                'updated_at_from' => $dateTimes[4]->format(TransactionsEntryPoint::DATE_FORMAT),
                'updated_at_to' => $dateTimes[5]->format(TransactionsEntryPoint::DATE_FORMAT),
                'completed_at_from' => $dateTimes[6]->format(TransactionsEntryPoint::DATE_FORMAT),
                'completed_at_to' => $dateTimes[7]->format(TransactionsEntryPoint::DATE_FORMAT),
                'page' => null,
                'per_page' => null,
                'order' => null,
                'order_asc_desc' => null,
                'scope' => null
            ]
        )
        );

        $transaction = new Transaction();
        $transaction->setCurrency('C')
            ->setAmount('D')
            ->setAction('E')
            ->setRelatedEntityType('F')
            ->setRelatedEntityId('G')
            ->setRelatedEntityShortReference('H')
            ->setStatus('I')
            ->setType('J')
            ->setReason('K');


        $transactions = $entryPoint->find(
            $transaction,
            'A',
            'B',
            $dateTimes[0],
            $dateTimes[1],
            $dateTimes[2],
            $dateTimes[3],
            $dateTimes[4],
            $dateTimes[5],
            'L',
            null,
            $dateTimes[6],
            $dateTimes[7]
        );

        $this->assertInstanceOf(Transactions::class, $transactions);
        $list = $transactions->getTransactions();

        $this->assertArrayHasKey(0, $list);
        $this->assertCount(1, $list);

        $this->validateObjectStrictName($list[0], json_decode($data, true)['transactions'][0]);
    }

    /**
     * @test
     */
    public function canRetrieveSenderDetails(){
        $data = '{
            "id": "e68301d3-5b04-4c1d-8f8b-13a9b8437040",
            "amount": "1701.51",
            "currency": "EUR",
            "additional_information": "USTRD-0001",
            "value_date": "2018-07-04T00:00:00+00:00",
            "sender": "FR7615589290001234567890113, CMBRFR2BARK, Debtor, FR, Centre ville",
            "receiving_account_number": null,
            "receiving_account_iban": "GB99OXPH94665099600083",
            "created_at": "2018-07-04T14:57:38+00:00",
            "updated_at": "2018-07-04T14:57:39+00:00"
        }';

        $entryPoint = new TransactionsEntryPoint($this->getMockedClient(
            json_decode($data),
            'GET',
            'transactions/sender/12345678-abcd-1234-abcd-123456789012',
            [
                'on_behalf_of' => null
            ]
        ));

        $transactionSender = $entryPoint->retrieveSender('12345678-abcd-1234-abcd-123456789012');

        $dummy = json_decode($data, true);

        $this->assertSame($dummy['id'], $transactionSender->getId());
        $this->assertSame($dummy['amount'], $transactionSender->getAmount());
        $this->assertSame($dummy['currency'], $transactionSender->getCurrency());
        $this->assertSame($dummy['additional_information'], $transactionSender->getAdditionalInformation());
        $this->assertSame($dummy['sender'], $transactionSender->getSender());
        $this->assertSame($dummy['receiving_account_number'], $transactionSender->getReceivingAcountNumber());
        $this->assertSame($dummy['receiving_account_iban'], $transactionSender->getReceivingAcountIban());
    }
}
