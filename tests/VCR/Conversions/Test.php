<?php
namespace CurrencyCloud\tests\VCR\Conversions;

use CurrencyCloud\Criteria\ConversionProfitLossCriteria;
use CurrencyCloud\Model\Conversion;
use CurrencyCloud\Model\Pagination;
use CurrencyCloud\Tests\BaseCurrencyCloudVCRTestCase;
use DateTime;
use VCR\VCR;

class Test extends BaseCurrencyCloudVCRTestCase {

    /** @test */
    public function canRetrieveConversionProfitLoss()
    {
        VCR::insertCassette('Conversions/can_retrieve_conversion_profit_loss.yaml');

        $conversionProfitLossCriteria = new ConversionProfitLossCriteria();
        $pagination = new Pagination();

        $conversionProfitLossCollection = $this->getAuthenticatedClient()->conversions()->retrieveProfitLoss($conversionProfitLossCriteria, $pagination);

        $dummy = json_decode(
            '{"conversion_profit_and_losses":[{"account_id":"72970a7c-7921-431c-b95f-3438724ba16f","contact_id":"a66ca63f-e668-47af-8bb9-74363240d781","event_account_id":null,"event_contact_id":null,"conversion_id":"515eaa18-0756-42b9-9899-49bfea5d3e8a","event_type":"self_service_cancellation","amount":"-0.01","currency":"GBP","notes":"","event_date_time":"2018-06-19T15:55:15+00:00"},{"account_id":"72970a7c-7921-431c-b95f-3438724ba16f","contact_id":"a66ca63f-e668-47af-8bb9-74363240d781","event_account_id":null,"event_contact_id":null,"conversion_id":"10c79aba-a9ee-41c2-b0ce-89a0941a8599","event_type":"self_service_cancellation","amount":"-0.01","currency":"GBP","notes":"","event_date_time":"2018-06-19T16:20:45+00:00"},{"account_id":"72970a7c-7921-431c-b95f-3438724ba16f","contact_id":"a66ca63f-e668-47af-8bb9-74363240d781","event_account_id":null,"event_contact_id":null,"conversion_id":"bb95fa2e-52f7-4219-8710-110e60e1ed91","event_type":"self_service_cancellation","amount":"-0.01","currency":"GBP","notes":"","event_date_time":"2018-06-19T16:29:32+00:00"}],"pagination":{"total_entries":3,"total_pages":1,"current_page":1,"per_page":25,"previous_page":-1,"next_page":-1,"order":"event_date_time","order_asc_desc":"asc"}}',
        true);

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

    /** @test */
    public function canRetrieveConversionDateChangeQuote()
    {
        VCR::insertCassette('Conversions/can_retrieve_conversion_date_change_quote.yaml');

        $conversionDateChangeQuote = $this->getAuthenticatedClient()->conversions()->retrieveDateChangeQuote('cef197c6-2192-4970-a2cf-d45ee046ae8c','2018-11-06');

        $dummy = json_decode(
            '{"conversion_id":"cef197c6-2192-4970-a2cf-d45ee046ae8c","amount":"0.14","currency":"GBP","new_conversion_date":"2018-11-06T00:00:00+00:00","new_settlement_date":"2018-11-06T16:30:00+00:00","old_conversion_date":"2018-11-01T00:00:00+00:00","old_settlement_date":"2018-11-01T16:30:00+00:00","event_date_time":"2018-10-30T16:19:55+00:00"}',
            true);

        $this->assertSame($dummy['conversion_id'],
            $conversionDateChangeQuote->getConversionId());
        $this->assertSame($dummy['amount'],
            $conversionDateChangeQuote->getAmount());
        $this->assertSame($dummy['currency'],
            $conversionDateChangeQuote->getCurrency());
        $this->assertSame($dummy['new_conversion_date'],
            $conversionDateChangeQuote->getNewConversionDate()->format(DateTime::RFC3339));
        $this->assertSame($dummy['new_settlement_date'],
            $conversionDateChangeQuote->getNewSettlementDate()->format(DateTime::RFC3339));
    }

    /** @test */
    public function canRetrieveConversionSplitPreview()
    {
        VCR::insertCassette('Conversions/can_retrieve_conversion_split_preview.yaml');

        $conversionConversionSplitPreview = $this->getAuthenticatedClient()->conversions()->retrieveSplitPreview('cef197c6-2192-4970-a2cf-d45ee046ae8c','35.46');

        $dummy = json_decode(
            '{"parent_conversion":{"id":"b401a1bc-ba02-4bd6-920e-8bf6fd97282b","short_reference":"20180622-XCRNWB","sell_amount":"70.93","sell_currency":"GBP","buy_amount":"100.00","buy_currency":"USD","settlement_date":"2018-07-02T15:30:00+00:00","conversion_date":"2018-07-02T00:00:00+00:00","status":"awaiting_funds"},"child_conversion":{"id":"13575890-f1a3-466d-81ce-f9444d2816a7","short_reference":"20180622-GXWQPV","sell_amount":"35.46","sell_currency":"GBP","buy_amount":"50.00","buy_currency":"USD","settlement_date":"2018-07-02T15:30:00+00:00","conversion_date":"2018-07-02T00:00:00+00:00","status":"awaiting_funds"}}',
            true);

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

    /** @test */
    public function canRetrieveConversionSplitHistory()
    {
        VCR::insertCassette('Conversions/can_retrieve_conversion_split_history.yaml');

        $conversionConversionSplitHistory = $this->getAuthenticatedClient()->conversions()->retrieveSplitHistory('24d2ee7f-c7a3-4181-979e-9c58dbace992');

        $dummy = json_decode(
            '{"parent_conversion":{"id":"24d2ee7f-c7a3-4181-979e-9c58dbace992","short_reference":"20180716-XMXMMS","sell_amount":"2417.10","sell_currency":"GBP","buy_amount":"3000.00","buy_currency":"EUR","settlement_date":"2018-06-28T13:00:00+00:00","conversion_date":"2018-06-28T00:00:00+00:00","status":"awaiting_funds"},"origin_conversion":{"id":"9d7919b5-c72d-41e1-9745-d2d5dc35e338","short_reference":"20180626-YVRVTT","sell_amount":"3222.80","sell_currency":"GBP","buy_amount":"4000.00","buy_currency":"EUR","settlement_date":"2018-06-28T13:00:00+00:00","conversion_date":"2018-06-28T00:00:00+00:00","status":"awaiting_funds"},"child_conversions":[{"id":"c8a323d8-7366-4bf3-b7c5-a6590e07eda3","short_reference":"20180716-KWQYDK","sell_amount":"1208.55","sell_currency":"GBP","buy_amount":"1500.00","buy_currency":"EUR","settlement_date":"2018-06-28T13:00:00+00:00","conversion_date":"2018-06-28T00:00:00+00:00","status":"awaiting_funds"},{"id":"615227c4-a955-4a6c-a415-68accc3ae47f","short_reference":"20180716-EARWAY","sell_amount":"1208.55","sell_currency":"GBP","buy_amount":"1500.00","buy_currency":"EUR","settlement_date":"2018-06-28T13:00:00+00:00","conversion_date":"2018-06-28T00:00:00+00:00","status":"awaiting_funds"}]}',
            true);

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

    /** @test */
    public function canRetrieveConversionCancellationQuote()
    {
        VCR::insertCassette('Conversions/can_retrieve_conversion_cancellation_quote.yaml');

        $conversionCancellationQuote = $this->getAuthenticatedClient()->conversions()->retrieveCancellationQuote('9b29e56d-6a67-4470-a291-ee72b6371c32');

        $dummy = json_decode(
            '{"amount":"-0.06","currency":"GBP","event_date_time":"2018-11-02T07:32:54+00:00"}',
            true);

        $this->assertSame($dummy['amount'], $conversionCancellationQuote->getAmount());
        $this->assertSame($dummy['currency'], $conversionCancellationQuote->getCurrency());
    }

}
