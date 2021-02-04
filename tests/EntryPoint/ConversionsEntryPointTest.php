<?php

namespace CurrencyCloud\Tests\EntryPoint;

use CurrencyCloud\Criteria\ConversionProfitLossCriteria;
use CurrencyCloud\Criteria\FindConversionsCriteria;
use CurrencyCloud\EntryPoint\ConversionsEntryPoint;
use CurrencyCloud\Model\Conversion;
use CurrencyCloud\Model\ConversionDateChanged;
use CurrencyCloud\Model\CancelledConversion;
use CurrencyCloud\Model\ConversionSplit;
use CurrencyCloud\Model\Pagination;
use CurrencyCloud\Tests\BaseCurrencyCloudTestCase;
use DateTime;

class ConversionsEntryPointTest extends BaseCurrencyCloudTestCase
{

    /**
     * @test
     */
    public function canFindWhenAllParamsAreNull()
    {
        $data = '{"conversions":[{"id":"c9b6b851-10f9-4bbf-881e-1d8a49adf7d8","unique_request_id":null,"account_id":"0386e472-8d2b-45a8-9c14-a393dce5bf3a","creator_contact_id":"ac743762-5860-4b78-9c6a-82c5bca68867","short_reference":"20140507-VRTNFC","settlement_date":"2014-05-21T14:00:00Z","conversion_date":"2014-05-21T14:00:00Z","status":"awaiting_funds","currency_pair":"GBPUSD","buy_currency":"GBP","sell_currency":"USD","fixed_side":"buy","partner_buy_amount":"1000.00","partner_sell_amount":"1587.80","client_buy_amount":"1000.00","client_sell_amount":"1594.90","mid_market_rate":"1.5868","core_rate":"1.5871","partner_rate":"1.5878","client_rate":"1.5949","deposit_required":true,"deposit_amount":"47.85","deposit_currency":"GBP","deposit_status":"awaiting_deposit","deposit_required_at":"2013-05-09T14:00:00Z","payment_ids":["b934794f-d810-4b4a-b360-5a0f47b7126e"],"created_at":"2014-01-12T00:00:00+00:00","updated_at":"2014-01-12T00:00:00+00:00"}],"pagination":{"total_entries":1,"total_pages":1,"current_page":1,"per_page":25,"previous_page":-1,"next_page":2,"order":"created_at","order_asc_desc":"asc"}}';


        $entryPoint = new ConversionsEntryPoint($this->getMockedClient(
            json_decode($data),
            'GET',
            'conversions/find',
            [
                'short_reference' => null,
                'status' => null,
                'buy_currency' => null,
                'sell_currency' => null,
                'conversion_ids' => null,
                'created_at_from' => null,
                'created_at_to' => null,
                'updated_at_from' => null,
                'updated_at_to' => null,
                'currency_pair' => null,
                'partner_buy_amount_from' => null,
                'partner_buy_amount_to' => null,
                'partner_sell_amount_from' =>  null,
                'partner_sell_amount_to' =>  null,
                'buy_amount_from' =>  null,
                'buy_amount_to' =>  null,
                'sell_amount_from' =>  null,
                'sell_amount_to' =>  null,
                'on_behalf_of' => null,
                'unique_request_id' => null
            ]
        ));

        $items = $entryPoint->find();

        $this->assertArrayHasKey(0, $items->getConversions());
        $this->assertInstanceOf(Conversion::class, $items->getConversions()[0]);
    }

    /**
     * @test
     */
    public function canFindWhenAllParamsAreNonNull()
    {
        $data = '{"conversions":[{"id":"c9b6b851-10f9-4bbf-881e-1d8a49adf7d8","unique_request_id":null,"account_id":"0386e472-8d2b-45a8-9c14-a393dce5bf3a","creator_contact_id":"ac743762-5860-4b78-9c6a-82c5bca68867","short_reference":"20140507-VRTNFC","settlement_date":"2014-05-21T14:00:00Z","conversion_date":"2014-05-21T14:00:00Z","status":"awaiting_funds","currency_pair":"GBPUSD","buy_currency":"GBP","sell_currency":"USD","fixed_side":"buy","partner_buy_amount":"1000.00","partner_sell_amount":"1587.80","client_buy_amount":"1000.00","client_sell_amount":"1594.90","mid_market_rate":"1.5868","core_rate":"1.5871","partner_rate":"1.5878","client_rate":"1.5949","deposit_required":true,"deposit_amount":"47.85","deposit_currency":"GBP","deposit_status":"awaiting_deposit","deposit_required_at":"2013-05-09T14:00:00Z","payment_ids":["b934794f-d810-4b4a-b360-5a0f47b7126e"],"created_at":"2014-01-12T00:00:00+00:00","updated_at":"2014-01-12T00:00:00+00:00"}],"pagination":{"total_entries":1,"total_pages":1,"current_page":1,"per_page":25,"previous_page":-1,"next_page":2,"order":"created_at","order_asc_desc":"asc"}}';

        $createdAtFrom = (new DateTime())->modify('-1 hour');
        $createdAtTo = (new DateTime())->modify('-2 hour');
        $updatedAtFrom = (new DateTime())->modify('-3 hour');
        $updatedAtTo = (new DateTime())->modify('-4 hour');

        $criteria = (new FindConversionsCriteria())
            ->setShortReference('A')
            ->setStatus('P')
            ->setParentStatus('B')
            ->setBuyCurrency('C')
            ->setSellCurrency('D')
            ->setConversionIds(['E', 'F'])
            ->setCreatedAtFrom($createdAtFrom)
            ->setCreatedAtTo($createdAtTo)
            ->setUpdatedAtFrom($updatedAtFrom)
            ->setUpdatedAtTo($updatedAtTo)
            ->setCurrencyPair('G')
            ->setPartnerSellAmountFrom('H')
            ->setPartnerSellAmountTo('I')
            ->setPartnerBuyAmountFrom('J')
            ->setPartnerBuyAmountTo('K')
            ->setBuyAmountFrom('L')
            ->setBuyAmountTo('M')
            ->setSellAmountFrom('N')
            ->setSellAmountTo('O');

        $entryPoint = new ConversionsEntryPoint($this->getMockedClient(
            json_decode($data),
            'GET',
            'conversions/find',
            [
                'short_reference' => 'A',
                'status' => 'P',
                'buy_currency' => 'C',
                'sell_currency' => 'D',
                'conversion_ids' => 'E,F',
                'created_at_from' => $createdAtFrom->format(DateTime::ISO8601),
                'created_at_to' => $createdAtTo->format(DateTime::ISO8601),
                'updated_at_from' => $updatedAtFrom->format(DateTime::ISO8601),
                'updated_at_to' => $updatedAtTo->format(DateTime::ISO8601),
                'currency_pair' => 'G',
                'partner_sell_amount_from' =>  'H',
                'partner_sell_amount_to' =>  'I',
                'partner_buy_amount_from' => 'J',
                'partner_buy_amount_to' => 'K',
                'buy_amount_from' =>  'L',
                'buy_amount_to' =>  'M',
                'sell_amount_from' =>  'N',
                'sell_amount_to' =>  'O',
                'on_behalf_of' => null,
                'unique_request_id' => null
            ]
        ));
        $entryPoint->find($criteria);
    }

    /**
     * @test
     */
    public function canRetrieve()
    {
        $data = '{"id":"c9b6b851-10f9-4bbf-881e-1d8a49adf7d8","unique_request_id":null,"account_id":"0386e472-8d2b-45a8-9c14-a393dce5bf3a","creator_contact_id":"ac743762-5860-4b78-9c6a-82c5bca68867","short_reference":"20140507-VRTNFC","settlement_date":"2014-05-21T14:00:00Z","conversion_date":"2014-05-21T14:00:00Z","status":"awaiting_funds","currency_pair":"GBPUSD","buy_currency":"GBP","sell_currency":"USD","fixed_side":"buy","partner_buy_amount":"1000.00","partner_sell_amount":"1587.80","client_buy_amount":"1000.00","client_sell_amount":"1594.90","mid_market_rate":"1.5868","core_rate":"1.5871","partner_rate":"1.5878","client_rate":"1.5949","deposit_required":true,"deposit_amount":"47.85","deposit_currency":"GBP","deposit_status":"awaiting_deposit","deposit_required_at":"2013-05-09T14:00:00Z","payment_ids":["b934794f-d810-4b4a-b360-5a0f47b7126e"],"created_at":"2014-01-12T00:00:00+00:00","updated_at":"2014-01-12T00:00:00+00:00"}';


        $entryPoint = new ConversionsEntryPoint($this->getMockedClient(
            json_decode($data),
            'GET',
            'conversions/hi',
            [
                'on_behalf_of' => null
            ]
        ));

        $item = $entryPoint->retrieve('hi');

        $this->validateObjectStrictName($item, json_decode($data, true));
    }


    /**
     * @test
     */
    public function canCancel()
    {
        $data = '{"account_id":"f054ef5d-3cfa-4d2c-ad84-caee50e5fc83","contact_id":"0ff0ea60-d976-4c7f-ad7f-3eb94da68452","event_account_id":"f054ef5d-3cfa-4d2c-ad84-caee50e5fc83","event_contact_id":"0ff0ea60-d976-4c7f-ad7f-3eb94da68452","conversion_id":"740a64c5-fd0a-47d4-b690-51310501f470","event_type":"self_service_cancellation","amount":"-1.00","currency":"GBP","notes":"Cancelduetoveryimportantreason","event_date_time":"2018-05-01T09:22:11+00:00"}';

        $entryPoint = new ConversionsEntryPoint($this->getMockedClient(
            json_decode($data),
            'POST',
            'conversions/0ff0ea60-d976-4c7f-ad7f-3eb94da68452/cancel',
            [],
            [
                'notes' => 'Cancelduetoveryimportantreason'
            ]
        ));
        $dummyData = json_decode($data, true);

        $conversionCancellation = $entryPoint->cancel('0ff0ea60-d976-4c7f-ad7f-3eb94da68452', 'Cancelduetoveryimportantreason');

        $this->assertInstanceOf(CancelledConversion::class, $conversionCancellation);
        $this->assertSame($dummyData['account_id'], $conversionCancellation->getAccountId());
        $this->assertSame($dummyData['contact_id'], $conversionCancellation->getContactId());
        $this->assertSame($dummyData['event_account_id'], $conversionCancellation->getEventAccountId());
        $this->assertSame($dummyData['event_contact_id'], $conversionCancellation->getEventContactId());
        $this->assertSame($dummyData['conversion_id'], $conversionCancellation->getConversionId());
        $this->assertSame($dummyData['event_type'], $conversionCancellation->getEventType());
        $this->assertSame($dummyData['amount'], $conversionCancellation->getAmount());
        $this->assertSame($dummyData['currency'], $conversionCancellation->getCurrency());
        $this->assertSame($dummyData['notes'], $conversionCancellation->getNotes());
        $this->assertSame($dummyData['event_date_time'], $conversionCancellation->getEventDateTime()->format(DATE_RFC3339));
    }


    /**
     * @test
     */
    public function canDateChange()
    {
        $data = '{"conversion_id":"13909849-1dbd-45c1-83c7-25930132f02c","amount":"19.12","currency":"GBP","new_conversion_date":"2018-05-14T00:00:00+00:00","new_settlement_date":"2018-05-14T15:30:00+00:00","old_conversion_date":"2018-05-03T00:00:00+00:00","old_settlement_date":"2018-05-03T15:30:00+00:00","event_date_time":"2018-05-01T14:08:17+00:00"}';

        $entryPoint = new ConversionsEntryPoint($this->getMockedClient(
            json_decode($data),
            'POST',
            'conversions/13909849-1dbd-45c1-83c7-25930132f02c/date_change',
            [
                'new_settlement_date' => '2028-05-12'
            ]
        ));

        $conversionDateChanged = $entryPoint->date_change('13909849-1dbd-45c1-83c7-25930132f02c', '2028-05-12');

        $this->assertInstanceOf(ConversionDateChanged::class, $conversionDateChanged);
    }


    /**
     * @test
     */
    public function canSplit()
    {
        $data = '{"parent_conversion":{"id":"13909849-1dbd-45c1-83c7-25930132f02c","short_reference":"20180501-JLWFFS","sell_amount":"7031.75","sell_currency":"GBP","buy_amount":"9900.00","buy_currency":"USD","settlement_date":"2018-05-14T15:30:00+00:00","conversion_date":"2018-05-14T00:00:00+00:00","status":"awaiting_funds"},"child_conversion":{"id":"bd054ea4-0e81-48de-bb49-b0373ae34180","short_reference":"20180501-XGYQDR","sell_amount":"71.03","sell_currency":"GBP","buy_amount":"100.00","buy_currency":"USD","settlement_date":"2018-05-14T15:30:00+00:00","conversion_date":"2018-05-14T00:00:00+00:00","status":"awaiting_funds"}}';

        $entryPoint = new ConversionsEntryPoint($this->getMockedClient(
            json_decode($data),
            'POST',
            'conversions/13909849-1dbd-45c1-83c7-25930132f02c/split',
            [
                'amount' => '100'
            ]
        ));

        $conversionSplit = $entryPoint->split('13909849-1dbd-45c1-83c7-25930132f02c', '100');

        $this->assertInstanceOf(ConversionSplit::class, $conversionSplit);
    }

    /**
     * @test
     */
    public function canRetrieveConversionProfitLoss()
    {
        $data = '{
            "conversion_profit_and_losses": [
                {
                    "account_id": "72970a7c-7921-431c-b95f-3438724ba16f",
                    "contact_id": "a66ca63f-e668-47af-8bb9-74363240d781",
                    "event_account_id": null,
                    "event_contact_id": null,
                    "conversion_id": "515eaa18-0756-42b9-9899-49bfea5d3e8a",
                    "event_type": "self_service_cancellation",
                    "amount": "-0.01",
                    "currency": "GBP",
                    "notes": "",
                    "event_date_time": "2018-06-19T15:55:15+00:00"
                },
                {
                    "account_id": "72970a7c-7921-431c-b95f-3438724ba16f",
                    "contact_id": "a66ca63f-e668-47af-8bb9-74363240d781",
                    "event_account_id": null,
                    "event_contact_id": null,
                    "conversion_id": "10c79aba-a9ee-41c2-b0ce-89a0941a8599",
                    "event_type": "self_service_cancellation",
                    "amount": "-0.01",
                    "currency": "GBP",
                    "notes": "",
                    "event_date_time": "2018-06-19T16:20:45+00:00"
                },
                {
                    "account_id": "72970a7c-7921-431c-b95f-3438724ba16f",
                    "contact_id": "a66ca63f-e668-47af-8bb9-74363240d781",
                    "event_account_id": null,
                    "event_contact_id": null,
                    "conversion_id": "bb95fa2e-52f7-4219-8710-110e60e1ed91",
                    "event_type": "self_service_cancellation",
                    "amount": "-0.01",
                    "currency": "GBP",
                    "notes": "",
                    "event_date_time": "2018-06-19T16:29:32+00:00"
                }
            ],
            "pagination": {
                "total_entries": 3,
                "total_pages": 1,
                "current_page": 1,
                "per_page": 25,
                "previous_page": -1,
                "next_page": -1,
                "order": "event_date_time",
                "order_asc_desc": "asc"
            }
        }';

        $entryPoint = new ConversionsEntryPoint($this->getMockedClient(
            json_decode($data),
            'GET',
            'conversions/profit_and_loss',
            [
                'account_id' => null,
                'contact_id' => null,
                'conversion_id' => null,
                'event_type' => null,
                'event_date_time_from' => null,
                'event_date_time_to' => null,
                'amount_from' => null,
                'amount_to' => null,
                'currency' => null,
                'scope' => null,
                'page' => null,
                'per_page' => null,
                'order' => null,
                'order_asc_desc' => null
            ]
        ));

        $conversionProfitLossCriteria = new ConversionProfitLossCriteria();
        $pagination = new Pagination();
        $conversionProfitLossCollection = $entryPoint->retrieveProfitLoss($conversionProfitLossCriteria, $pagination);

        $dummy = json_decode($data, true);

        foreach($dummy['conversion_profit_and_losses'] as $key => $value){
            $this->assertSame($dummy['conversion_profit_and_losses'][$key]['account_id'],
                $conversionProfitLossCollection->getConversionsProfitLoss()[$key]->getAccountId());
            $this->assertSame($dummy['conversion_profit_and_losses'][$key]['contact_id'],
                $conversionProfitLossCollection->getConversionsProfitLoss()[$key]->getContactId());
            $this->assertSame($dummy['conversion_profit_and_losses'][$key]['event_type'],
                $conversionProfitLossCollection->getConversionsProfitLoss()[$key]->getEventType());
            $this->assertSame($dummy['conversion_profit_and_losses'][$key]['amount'],
                $conversionProfitLossCollection->getConversionsProfitLoss()[$key]->getAmount());
            $this->assertSame($dummy['conversion_profit_and_losses'][$key]['currency'],
                $conversionProfitLossCollection->getConversionsProfitLoss()[$key]->getCurrency());
        }

        $this->assertSame($dummy['pagination']['total_entries'], $conversionProfitLossCollection->getPagination()->getTotalEntries());
    }

    /**
     * @test
     */
    public function canRetrieveConversionDateChangeQuote()
    {
        $data = '{
            "conversion_id": "cef197c6-2192-4970-a2cf-d45ee046ae8c",
            "amount": "0.14",
            "currency": "GBP",
            "new_conversion_date": "2018-11-06T00:00:00+00:00",
            "new_settlement_date": "2018-11-06T16:30:00+00:00",
            "old_conversion_date": "2018-11-01T00:00:00+00:00",
            "old_settlement_date": "2018-11-01T16:30:00+00:00",
            "event_date_time": "2018-10-30T16:19:55+00:00"
        }';

        $entryPoint = new ConversionsEntryPoint($this->getMockedClient(
            json_decode($data),
            'GET',
            'conversions/cef197c6-2192-4970-a2cf-d45ee046ae8c/date_change_quote',
            [
                'new_settlement_date' => '2018-11-06'
            ]
        ));

        $conversionConversionDateChangeQuote = $entryPoint->retrieveDateChangeQuote('cef197c6-2192-4970-a2cf-d45ee046ae8c', '2018-11-06');

        $dummy = json_decode($data, true);

        $this->assertSame($dummy['conversion_id'],
            $conversionConversionDateChangeQuote->getConversionId());
        $this->assertSame($dummy['amount'],
            $conversionConversionDateChangeQuote->getAmount());
        $this->assertSame($dummy['currency'],
            $conversionConversionDateChangeQuote->getCurrency());
        $this->assertSame($dummy['new_conversion_date'],
            $conversionConversionDateChangeQuote->getNewConversionDate()->format(DateTime::RFC3339));
        $this->assertSame($dummy['new_settlement_date'],
            $conversionConversionDateChangeQuote->getNewSettlementDate()->format(DateTime::RFC3339));
    }

    /**
     * @test
     */
    public function canRetrieveConversionSplitPreview()
    {
        $data = '{
            "parent_conversion": {
                "id": "b401a1bc-ba02-4bd6-920e-8bf6fd97282b",
                "short_reference": "20180622-XCRNWB",
                "sell_amount": "70.93",
                "sell_currency": "GBP",
                "buy_amount": "100.00",
                "buy_currency": "USD",
                "settlement_date": "2018-07-02T15:30:00+00:00",
                "conversion_date": "2018-07-02T00:00:00+00:00",
                "status": "awaiting_funds"
            },
            "child_conversion": {
                "id": "13575890-f1a3-466d-81ce-f9444d2816a7",
                "short_reference": "20180622-GXWQPV",
                "sell_amount": "35.46",
                "sell_currency": "GBP",
                "buy_amount": "50.00",
                "buy_currency": "USD",
                "settlement_date": "2018-07-02T15:30:00+00:00",
                "conversion_date": "2018-07-02T00:00:00+00:00",
                "status": "awaiting_funds"
            }
        }';

        $entryPoint = new ConversionsEntryPoint($this->getMockedClient(
            json_decode($data),
            'GET',
            'conversions/cef197c6-2192-4970-a2cf-d45ee046ae8c/split_preview',
            [
                'amount' => '35.46'
            ]
        ));

        $conversionConversionSplitPreview = $entryPoint->retrieveSplitPreview('cef197c6-2192-4970-a2cf-d45ee046ae8c', '35.46');

        $dummy = json_decode($data, true);

        $this->assertSame($dummy['parent_conversion']['id'], $conversionConversionSplitPreview->getParentConversion()->getId());
        $this->assertSame($dummy['parent_conversion']['short_reference'], $conversionConversionSplitPreview->getParentConversion()->getShortReference());
        $this->assertSame($dummy['parent_conversion']['sell_amount'], $conversionConversionSplitPreview->getParentConversion()->getClientSellAmount());
        $this->assertSame($dummy['parent_conversion']['sell_currency'], $conversionConversionSplitPreview->getParentConversion()->getSellCurrency());
        $this->assertSame($dummy['parent_conversion']['buy_amount'], $conversionConversionSplitPreview->getParentConversion()->getClientBuyAmount());
        $this->assertSame($dummy['parent_conversion']['buy_currency'], $conversionConversionSplitPreview->getParentConversion()->getBuyCurrency());
        $this->assertSame($dummy['parent_conversion']['status'], $conversionConversionSplitPreview->getParentConversion()->getStatus());

        $this->assertSame($dummy['child_conversion']['id'], $conversionConversionSplitPreview->getChildConversion()->getId());
        $this->assertSame($dummy['child_conversion']['short_reference'], $conversionConversionSplitPreview->getChildConversion()->getShortReference());
        $this->assertSame($dummy['child_conversion']['sell_amount'], $conversionConversionSplitPreview->getChildConversion()->getClientSellAmount());
        $this->assertSame($dummy['child_conversion']['sell_currency'], $conversionConversionSplitPreview->getChildConversion()->getSellCurrency());
        $this->assertSame($dummy['child_conversion']['buy_amount'], $conversionConversionSplitPreview->getChildConversion()->getClientBuyAmount());
        $this->assertSame($dummy['child_conversion']['buy_currency'], $conversionConversionSplitPreview->getChildConversion()->getBuyCurrency());
        $this->assertSame($dummy['child_conversion']['status'], $conversionConversionSplitPreview->getChildConversion()->getStatus());
    }

    /**
     * @test
     */
    public function canRetrieveConversionSplitHistory()
    {
        $data = '{
            "parent_conversion": {
                "id": "24d2ee7f-c7a3-4181-979e-9c58dbace992",
                "short_reference": "20180716-XMXMMS",
                "sell_amount": "2417.10",
                "sell_currency": "GBP",
                "buy_amount": "3000.00",
                "buy_currency": "EUR",
                "settlement_date": "2018-06-28T13:00:00+00:00",
                "conversion_date": "2018-06-28T00:00:00+00:00",
                "status": "awaiting_funds"
            },
            "origin_conversion": {
                "id": "9d7919b5-c72d-41e1-9745-d2d5dc35e338",
                "short_reference": "20180626-YVRVTT",
                "sell_amount": "3222.80",
                "sell_currency": "GBP",
                "buy_amount": "4000.00",
                "buy_currency": "EUR",
                "settlement_date": "2018-06-28T13:00:00+00:00",
                "conversion_date": "2018-06-28T00:00:00+00:00",
                "status": "awaiting_funds"
            },
            "child_conversions": [
                {
                    "id": "c8a323d8-7366-4bf3-b7c5-a6590e07eda3",
                    "short_reference": "20180716-KWQYDK",
                    "sell_amount": "1208.55",
                    "sell_currency": "GBP",
                    "buy_amount": "1500.00",
                    "buy_currency": "EUR",
                    "settlement_date": "2018-06-28T13:00:00+00:00",
                    "conversion_date": "2018-06-28T00:00:00+00:00",
                    "status": "awaiting_funds"
                },
                {
                    "id": "615227c4-a955-4a6c-a415-68accc3ae47f",
                    "short_reference": "20180716-EARWAY",
                    "sell_amount": "1208.55",
                    "sell_currency": "GBP",
                    "buy_amount": "1500.00",
                    "buy_currency": "EUR",
                    "settlement_date": "2018-06-28T13:00:00+00:00",
                    "conversion_date": "2018-06-28T00:00:00+00:00",
                    "status": "awaiting_funds"
                }
            ]
        }';

        $entryPoint = new ConversionsEntryPoint($this->getMockedClient(
            json_decode($data),
            'GET',
            'conversions/24d2ee7f-c7a3-4181-979e-9c58dbace992/split_history',
            []
        ));

        $conversionConversionSplitHistory = $entryPoint->retrieveSplitHistory('24d2ee7f-c7a3-4181-979e-9c58dbace992');

        $dummy = json_decode($data, true);

        $this->assertSame($dummy['parent_conversion']['id'], $conversionConversionSplitHistory->getParentConversion()->getId());
        $this->assertSame($dummy['parent_conversion']['short_reference'], $conversionConversionSplitHistory->getParentConversion()->getShortReference());
        $this->assertSame($dummy['parent_conversion']['sell_amount'], $conversionConversionSplitHistory->getParentConversion()->getClientSellAmount());
        $this->assertSame($dummy['parent_conversion']['sell_currency'], $conversionConversionSplitHistory->getParentConversion()->getSellCurrency());
        $this->assertSame($dummy['parent_conversion']['buy_amount'], $conversionConversionSplitHistory->getParentConversion()->getClientBuyAmount());
        $this->assertSame($dummy['parent_conversion']['buy_currency'], $conversionConversionSplitHistory->getParentConversion()->getBuyCurrency());
        $this->assertSame($dummy['parent_conversion']['status'], $conversionConversionSplitHistory->getParentConversion()->getStatus());

        $this->assertSame($dummy['origin_conversion']['id'], $conversionConversionSplitHistory->getOriginConversion()->getId());
        $this->assertSame($dummy['origin_conversion']['short_reference'], $conversionConversionSplitHistory->getOriginConversion()->getShortReference());
        $this->assertSame($dummy['origin_conversion']['sell_amount'], $conversionConversionSplitHistory->getOriginConversion()->getClientSellAmount());
        $this->assertSame($dummy['origin_conversion']['sell_currency'], $conversionConversionSplitHistory->getOriginConversion()->getSellCurrency());
        $this->assertSame($dummy['origin_conversion']['buy_amount'], $conversionConversionSplitHistory->getOriginConversion()->getClientBuyAmount());
        $this->assertSame($dummy['origin_conversion']['buy_currency'], $conversionConversionSplitHistory->getOriginConversion()->getBuyCurrency());
        $this->assertSame($dummy['origin_conversion']['status'], $conversionConversionSplitHistory->getOriginConversion()->getStatus());

        foreach($dummy['child_conversions'] as $key => $value){
            $this->assertSame($value['id'], $conversionConversionSplitHistory->getChildConversions()[$key]->getId());
            $this->assertSame($value['short_reference'], $conversionConversionSplitHistory->getChildConversions()[$key]->getShortReference());
            $this->assertSame($value['sell_amount'], $conversionConversionSplitHistory->getChildConversions()[$key]->getClientSellAmount());
            $this->assertSame($value['sell_currency'], $conversionConversionSplitHistory->getChildConversions()[$key]->getSellCurrency());
            $this->assertSame($value['buy_amount'], $conversionConversionSplitHistory->getChildConversions()[$key]->getClientBuyAmount());
            $this->assertSame($value['buy_currency'], $conversionConversionSplitHistory->getChildConversions()[$key]->getBuyCurrency());
            $this->assertSame($value['status'], $conversionConversionSplitHistory->getChildConversions()[$key]->getStatus());
        }
    }

    /**
     * @test
     */
    public function canRetrieveConversionCancellationQuote(){
        $data = '{
            "amount": "-0.06",
            "currency": "GBP",
            "event_date_time": "2018-11-02T07:32:54+00:00"
        }';

        $entryPoint = new ConversionsEntryPoint($this->getMockedClient(
            json_decode($data),
            'GET',
            'conversions/9b29e56d-6a67-4470-a291-ee72b6371c32/cancellation_quote',
            []
        ));

        $conversionConversionCancellationQuote = $entryPoint->retrieveCancellationQuote('9b29e56d-6a67-4470-a291-ee72b6371c32');
        $dummy = json_decode($data, true);

        $this->assertSame($dummy['amount'], $conversionConversionCancellationQuote->getAmount());
        $this->assertSame($dummy['currency'], $conversionConversionCancellationQuote->getCurrency());
    }


    /**
     * @test
     */
    public function canCreateConversionWithConversionDatePreference()
    {

        $data = '{
               "id": "d56d7553-19ab-4cde-b44b-79cac86989cb",
               "settlement_date": "2020-05-19T13:30:00+00:00",
               "conversion_date": "2020-05-19T00:00:00+00:00",
               "short_reference": "20200519-XYLXJL",
               "creator_contact_id": "42a6af4a-65b8-4721-43d9-7f395da2551e",
               "account_id": "3f22044f-ae21-42a1-bc4f-cd0370b008a5",
               "currency_pair": "EURGBP",
               "status": "awaiting_funds",
               "buy_currency": "EUR",
               "sell_currency": "GBP",
               "client_buy_amount": "1000.00",
               "client_sell_amount": "805.90",
               "fixed_side": "buy",
               "core_rate": "0.8059",
               "partner_rate": "",
               "partner_buy_amount": "0.00",
               "partner_sell_amount": "0.00",
               "client_rate": "0.8059",
               "deposit_required": false,
               "deposit_amount": "0.00",
               "deposit_currency": "",
               "deposit_status": "not_required",
               "deposit_required_at": "",
               "payment_ids": [],
               "unallocated_funds": "1000.00",
               "unique_request_id": null,
               "created_at": "2020-05-19T12:31:43+00:00",
               "updated_at": "2020-05-19T12:31:43+00:00",
               "mid_market_rate": "0.8058"
           }';

        $entryPoint = new ConversionsEntryPoint($this->getMockedClient(
            json_decode($data),
            'POST',
            'conversions/create',
            [],
            [
                'buy_currency' => 'EUR',
                'sell_currency' => 'GBP',
                'fixed_side' => 'buy',
                'amount' => '1000',
                'term_agreement' => 'true',
                'conversion_date_preference' => 'earliest',
                'reason' => null,
                'conversion_date' => null,
                'client_buy_amount' => null,
                'client_sell_amount' => null,
                'unique_request_id' => null,
                'on_behalf_of' => null

            ]
        ));

        $conversion = Conversion::create('EUR', 'GBP', 'buy')->setConversionDatePreference('earliest');
        $createdConversion = $entryPoint->create($conversion, 1000, null, true);

        $this->assertTrue($createdConversion instanceof Conversion);
        $this->assertSame('805.90', $createdConversion->getClientSellAmount());
        $this->assertSame('2020-05-19T13:30:00+00:00', $createdConversion->getSettlementDate()->format(DateTime::RFC3339));

    }
}
